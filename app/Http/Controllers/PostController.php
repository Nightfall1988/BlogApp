<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Throwable;

class PostController extends Controller
{
    private PostService $service;

    public function __construct(PostService $postService)
    {
        $this->service = $postService;
    }

    public function index()
    {
        try {
            $posts = $this->service->getAllPosts();
            return view('list', ['posts' => $posts]);
        } catch (Throwable $e) {
            abort(500, 'Server Error');
        }
    }
    

    public function create()
    {  
        try {
            $categories = $this->service->getAllCategories();
            return view('add-post', ['categories' => $categories]); 
        } catch (Throwable $e) {
            abort(500, 'Server Error');
        }
    }

    public function show($postId)
    {  
        try {
            $categories = $this->service->getAllCategories();
            $post = $this->service->findPost($postId);
            return view('view-post', ['post' => $post, 'categories' => $categories]);
        } catch (Throwable $e) {
            abort(500, 'Server Error');
        }

    }

    public function store(CreatePostRequest $request)
    {           
        $this->service->store($request);
        return redirect()->route('list');
    }

    public function update(CreatePostRequest $request) 
    {
        try {
            $this->service->updatePost($request);
            return  redirect('view-post/' . $request->postId);
        } catch (Throwable $e) {
            abort(500, 'Server Error');
        }
    }

    public function edit($id) 
    {
        try {
            $data = $this->service->editPost($id);
            $post = $data[0];
            $categories = $data[1];
            return view('add-post', ['post' => $post, 'categories' => $categories]);
        } catch (Throwable $e) {
            abort(500, 'Server Error');
        }
    }


    public function delete($id)
    {
        if ($this->service->deletePost($id)) {
            return 1;
        } else {
            return 'error';
        }
    }

    public function saveComment(CreateCommentRequest $request) 
    {
        try {
            $this->service->saveComment($request);
        } catch (Throwable $e) {
            abort(500, 'Server Error');
        }
        
    }

    public function deleteComment($id)
    {
        if (Comment::destroy($id)) {
            return 1;
        } else {
            return 'error';
        }
    }

    public function addCategory($postId, $categoryId) {
        try {
            $post = $this->service->addCategoryToPost($postId, $categoryId);
            return 1;
        } catch (Throwable $e) {
            abort(500, 'Server Error');
        }
    }

    public function removeCategory($postId, $categoryId) {
        try {
            $post = $this->service->removeCategoryFromPost($postId, $categoryId);
            return json_encode(['postcategories' => $post->categories, 'allcategories' => $this->service->getAllCategories()]);
        } catch (Throwable $e) {
            abort(500, 'Server Error');
        }
    }

}
