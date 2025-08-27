<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

trait GeneralHelpers
{
    /**
     * Generate a unique slug for a model.
     *
     * @param string $modelClass The model class (e.g., Post::class).
     * @param string $title The title from which the slug is derived.
     * @param string $column The column name to check for uniqueness.
     * @return string The generated unique slug.
     */
    public function generateSlug(string $modelClass, string $title, string $column = 'slug'): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        // Keep checking until a unique slug is found
        while (
            $modelClass::query()
                ->where($column, $slug)
                ->where('user_id', Auth::id())
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
}
