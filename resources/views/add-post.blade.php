@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="text-2xl font-semibold mb-6">{{ isset($post) ? __('Edit Blog Post') : __('Create Blog Post') }}</div>

                <form method="POST" action="{{ isset($post) ? route('post.update', $post->id) : route('post.store') }}">
                    @csrf
                    @if(isset($post))
                        @method('PUT')
                    @endif

                    @if(isset($post))
                        <div>
                            <input id="postId" type="hidden" name="postId" value="{{ $post->id }}">
                            <h2 class="text-lg font-semibold mb-2">Categories</h2>
                            <div class="flex flex-wrap" id="category-added-section">
                                @foreach ($post->categories as $category)
                                    <div class="flex items-center bg-gray-200 rounded-full px-3 py-1 m-1">
                                        <span>{{ $category->name }}</span>
                                        <button type="button" class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none remove-category" data-postid="{{ $post->id }}" data-categoryid="{{ $category->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    <br>
                    @endif
                    <input type="hidden" id="selectedCategories" name="selectedCategories">

                    @if(isset($post))
                        <div id="category-missing-section">
                            <div class="flex">
                                @foreach($categories as $category)
                                    @unless ($post->categories->contains($category->id))
                                        <div class="flex items-center cursor-pointer mr-4">
                                            <input type="checkbox" name="{{ $category->name }}" id="cat_{{ $category->id }}" value="{{ $category->id }}" class="hidden category-checkbox">
                                            <label for="cat_{{ $category->id }}" class="px-3 py-1 rounded-full bg-gray-300 hover:bg-gray-400">{{ $category->name }}</label>
                                        </div>
                                    @endunless
                                @endforeach
                            </div>
                        </div>
                    @else
                    <div id="category-missing-section">
                        <div class="flex">
                            @foreach($categories as $category)
                                <div class="flex items-center cursor-pointer mr-4">
                                    <input type="checkbox"  id="cat_{{ $category->id }}" value="{{ $category->id }}" class="hidden category-checkbox">
                                    <label for="cat_{{ $category->id }}" class="px-3 py-1 rounded-full bg-gray-300 hover:bg-gray-400">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <br>
                    <br>

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold">{{ __('Title') }}</label>
                        <input id="title" type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror" name="title" value="{{ isset($post) ? $post->title : old('title') }}" required autofocus>
                        @error('title')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-bold">{{ __('Content') }}</label>
                        <textarea id="content" class="form-textarea mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('content') border-red-500 @enderror" name="content" rows="5" required>{{ isset($post) ? $post->content : old('content') }}</textarea>
                        @error('content')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
                            {{ isset($post) ? __('Update') : __('Create') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    <style>
    .category-checkbox {
        @apply hidden;
    }

    .custom-checkbox-label {
        @apply cursor-pointer inline-block relative pl-7;
    }

    .custom-checkbox-label::before {
        @apply block w-5 h-5 border border-gray-300 rounded transition duration-300;
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    .category-checkbox:checked + .custom-checkbox-label::before {
        @apply bg-blue-500;
    }

    .custom-checkbox-label::after {
        @apply block content absolute left-1 top-1 w-2 h-2 border-t border-r border-white transform rotate-45 opacity-0 transition duration-300; /* Adjust position and size as needed */
    }

    .category-checkbox:checked + .custom-checkbox-label::after {
        @apply opacity-100;
    }
</style>
