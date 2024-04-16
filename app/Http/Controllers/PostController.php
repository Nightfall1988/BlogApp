<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Services\CommentService;
use App\Http\Services\PostService;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    private PostService $postService;
    private CommentService $commentService;

    public function __construct(PostService $postService, CommentService $commentService)
    {
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    public function index()
    {
        $posts = Post::with('user')->get();
        return view('list', ['posts' => $posts]);
    }

    public function createPost()
    {  
        return view('add-post');
    }

    public function showPost($postId)
    {  
        $post = Post::with('comments', 'categories')->findOrFail($postId);
        return view('view-post', ['post' => $post]);
    }

    public function store(CreatePostRequest $request)
    {  
        $this->postService->store($request);
    }
}
