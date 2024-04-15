<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}