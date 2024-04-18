@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full">
            <div class="bg-white shadow-md rounded-lg mb-4">
                <form class="p-4">
                    <div class="flex row">
                        <div>
                            <h2 class="text-lg font-semibold mb-2">Categories</h2>
                            <ul class="flex row">
                                @foreach ($post->categories as $category)
                                    <li class="mb-1 mr-2"> &#x2022; {{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @if ($post->user->id == Auth::user()->id )
                        <div class="ml-auto flex row">
                            <a href="/edit-post/{{ $post->id }}"><i class="fas fa-pen-to-square"></i>Edit</a>
                            <a href="/delete-post/{{ $post->id }}"><i class="fas fa-trash"></i>Delete</a>
                        </div>
                        @endif

                    </div>
                    <div class="border-t border-gray-200 mt-4">
                        <div class="p-4">
                            <input id="postId" type="hidden" value="{{ $post->id }}"></input>
                            <div id="post_{{ $post->id }}" class="mb-4">
                                <div id="mid-section" class="flex row">
                                    <div>
                                        <p>Author: <b>{{ $post->user->name }}</b></p>
                                        <input id="userName" type="hidden" value="{{ $post->user->name }}"></input>
                                        <br>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="/create-post" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2">Create a new post</a>
                                    </div>
                                </div>
                                <div>
                                    <p class="font-bold">{{ $post->title }}</p>
                                </div>
                                <div>
                                    <p>{{ $post->content }}</p>
                                </div>
                            </div>
                            
                            <div id="add-comment" class="mb-4 border-t border-gray-200 mt-4">
                                <br>

                                <textarea id="comment" name="comment" class="w-full border border-gray-300 rounded-md p-2"></textarea>
                                <br>
                                <br>
                                <button id="submit-bttn" type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2">Submit Comment</button>
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <h2 class="text-lg font-semibold mb-2">Comments</h2>
                                    <button id="toggle-comments" type="button" class="text-blue-500 font-semibold mb-2 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                            <path x-show="!showComments" class="hidden" fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l5 5a1 1 0 01.293.707V14a1 1 0 01-1 1H6a1 1 0 01-1-1V9.414a1 1 0 01.293-.707l5-5A1 1 0 0110 3zm-1 4.414L6.414 9H9a1 1 0 110 2H5v3a1 1 0 001 1h8a1 1 0 001-1v-3h-3a1 1 0 110-2h2.586L11 7.414a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            <path x-show="showComments" fill-rule="evenodd" d="M4.293 7.293a1 1 0 011.414 0L10 11.586l4.293-4.293a1 1 0 111.414 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <div id="comments-list" class="invisible flex flex-col">
                                    @foreach ($post->comments as $comment)
                                        <div class="p-2 border-solid border-2 rounded border-sky-300">
                                            <ul>
                                                <li>By: <b>{{ $comment->user->name }}</b></li>
                                                <li>{{ $comment->body }}</li>
                                            </ul>
                                        </div>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

