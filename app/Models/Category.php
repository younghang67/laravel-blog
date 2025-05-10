<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description'];


    public static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function userPosts()
    {
        $userId = Auth::id();
        return $this->hasMany(Post::class)->where('user_id', $userId);
    }

}
