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
use Throwable;

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
        try {
            $posts = Post::with('user')->get();
            return view('list', ['posts' => $posts]);
        } catch (Throwable $e) {
            // MAKE A PROPER EXCEPTION MESSAGE
            dd($e);
        }
    }

    public function createPost()
    {  
        $categories = Category::all();
        return view('add-post', ['categories' => $categories]);
    }

    public function showPost($postId)
    {  
        try {
            $categories = Category::all();
            $post = Post::with('comments', 'categories')->findOrFail($postId);
            return view('view-post', ['post' => $post, 'categories' => $categories]);
        } catch (Throwable $e) {
            // MAKE A PROPER EXCEPTION MESSAGE
            dd($e);
        }

    }

    public function store(CreatePostRequest $request)
    {           
        $this->postService->store($request);
        return redirect()->route('list');
    }

    public function update(CreatePostRequest $request) 
    {
        try {
            $post = Post::with('categories')->findOrFail($request->postId);
            $post->title = $request->title;
            $post->content = $request->content;
            $post->categories()->attach($request->categories);
            // $post->categories()->dettach([]); FOR NOT IN THE LIST
            $post->save();
            return  redirect('view-post/' . $request->postId);
        } catch (Trowable $e) {
            // MAKE A PROPER EXCEPTION MESSAGE
            dd($e);
        }

    }
    public function saveComment(Request $request) 
    {
        try {
            // NEEDS VALIDATION
            $user = User::where('name', $request->userName)->first();
            $comment = new Comment;
            $comment->post_id = $request->postId;
            $comment->user_id = $user->id;
            $comment->body = $request->comment;
            $comment->save();
        } catch (Trowable $e) {
            // MAKE A PROPER EXCEPTION MESSAGE
            dd($e);
        }
        
    }

    public function edit($id) {

        try {
            // NEEDS VALIDATION
            $categories = Category::all();
            $post = Post::where('id', $id)->first();
            return view('add-post', ['post' => $post, 'categories' => $categories]);
        } catch (Trowable $e) {
            // MAKE A PROPER EXCEPTION MESSAGE
            dd($e);
        }
    }


    public function delete($id) {
        
        if (Post::destroy($id)) {
            return 1;
        } else {
            return 'error';
        }
    }

    public function addCategory($postId, $categoryId) {
        try {
            $post = Post::where('id', $postId)->first();
            $post->categories()->attach($categoryId);
            return 1;
        } catch (Trowable $e) {
            // MAKE A PROPER EXCEPTION MESSAGE
            dd($e);
        }
    }

    public function removeCategory($postId, $categoryId) {
        try {
            $post = Post::where('id', $postId)->first();
            $post->categories()->detach($categoryId);
            return json_encode(['postcategories' => $post->categories, 'allcategories' => Category::all()]);
        } catch (Trowable $e) {
            // MAKE A PROPER EXCEPTION MESSAGE
            dd($e);
        }
    }

}
