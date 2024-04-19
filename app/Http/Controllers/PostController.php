<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Services\CommentService;
use App\Http\Services\PostService;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

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
        $categories = Category::all();
        $post = Post::with('comments', 'categories')->findOrFail($postId);
        return view('view-post', ['post' => $post, 'categories' => $categories]);
    }

    public function store(CreatePostRequest $request)
    {   
        // NEEDS VALIDATION
        $this->postService->store($request);
        return redirect()->route('list');
    }

    public function update(CreatePostRequest $request) 
    {
        $post = Post::with('categories')->findOrFail($request->postId);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return  redirect('view-post/' . $request->postId);

    }
    public function saveComment(Request $request) {
        // NEEDS VALIDATION
        $user = User::where('name', $request->userName)->first();
        $comment = new Comment;
        $comment->post_id = $request->postId;
        $comment->user_id = $user->id;
        $comment->body = $request->comment;
        $comment->save();
        
    }

    public function edit($id) {
        $categories = Category::all();
        $post = Post::where('id', $id)->first();
        return view('add-post', ['post' => $post, 'categories' => $categories]);
    }


    public function delete($id) {
        
        if (Post::destroy($id)) {
            return 1;
        } else {
            return 'error';
        }
    }

}
