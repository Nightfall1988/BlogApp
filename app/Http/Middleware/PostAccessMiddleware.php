<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Post;

class PostAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $postId = $request->route('id');
        $post = Post::find($postId);

        if (!$post) {
            abort(404, 'Post not found');
        }

        if ($request->user()->id !== $post->user_id) {
            abort(403, 'Unauthorized action');
        }

        return $next($request);
    }
}
