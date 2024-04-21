<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
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

    public function getAllPosts(): Collection   
    {
        return Post::with('user')->get();
    }

    public function getAllCategories(): Collection   
    {
        return Category::all();
    }

    public function findPost($postId): Post   
    {
        return Post::with('comments', 'categories')->findOrFail($postId);
    }

    public function updatePost($request)   
    {
        $post = $this->findPost($request->postId);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->categories()->attach($request->categories);
        $post->save();
    }

    public function editPost($postId) {
        $categories = $this->getAllCategories();
        $post = $this->findPost($postId);
        return [$post, $categories];
    }

    public function saveComment($request) 
    {
        $user = User::where('name', $request->userName)->firstOrFail();
        $comment = new Comment;
        $comment->post_id = $request->postId;
        $comment->user_id = $user->id;
        $comment->body = $request->comment;
        $comment->save();
    }

    public function addCategoryToPost($postId, $categoryId): Post 
    {
        $post = $this->findPost($postId);
        $post->categories()->attach($categoryId);
        return $post;
    }

    public function removeCategoryFromPost($postId, $categoryId): Post {
        $post = $this->findPost($postId);
        $post->categories()->detach($categoryId);
        return $post;
    }

    public function deletePost($id) {
        return Post::destroy($id);
    }
}