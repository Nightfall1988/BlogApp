<?php

namespace App\Http\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function store($request)
    {
        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id
        ]);
    }
}
