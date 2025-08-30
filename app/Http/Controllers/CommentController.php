<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnCallback;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
        ]);

        $comment->load('user');

        return response()->json([
            'message' => 'Comment added successfully!',
            'comment' => $comment
        ]);
    }

    public function update(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'id' => 'required|exists:comments,id',
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::findOrFail($validated['id']);

        if ($comment->post_id != $validated['post_id']) {
            return response()->json(['error' => 'Comment does not belong to this post.'], 400);
        }

        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()
                ->withFragment('comment')
                ->with('error', 'You are not authorized to update this comment.');
        }

        $comment->comment = $validated['comment'];
        $comment->parent_id = $validated['parent_id'] ?? null;
        $comment->save();

        return redirect()->back()
            ->withFragment('comment')
            ->with('success', 'Comment updated successfully!');
    }




    public function destroy(Comment $comment)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $comment->user_id !== $user->id) {
            return redirect()->back()
                ->withFragment('comment')
                ->with('error', 'You are not authorized to delete this comment.');
        }

        try {
            $comment->delete();

            return redirect()->back()
                ->withFragment('comment')
                ->with('success', 'Comment deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withFragment('comment')
                ->with('error', 'Failed to delete the comment.');
        }
    }


}
