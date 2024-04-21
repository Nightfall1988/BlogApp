<?php

namespace App\Http\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function store($request)
    {
        $selectedCategories = json_decode($request->selectedCategories);

        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;
        $post->save();

        foreach ($selectedCategories as $categoryId) {
            $post->categories()->attach($categoryId);
        }
    }
}
