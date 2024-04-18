@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full lg:w-10/12 xl:w-7/12">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="text-2xl font-semibold mb-6">{{ isset($post) ? __('Edit Blog Post') : __('Create Blog Post') }}</div>

            
                <form method="POST" action="{{ isset($post) ? route('posts.edit', $post->id) : route('post.create') }}">
                    @csrf
                    @if(isset($post))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">{{ __('Title') }}</label>
                        <input id="title" type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror" name="title" value="{{ isset($post) ? $post->title : old('title') }}" required autofocus>
                        @error('title')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">{{ __('Content') }}</label>
                        <textarea id="content" class="form-textarea mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('content') border-red-500 @enderror" name="content" rows="5" required>{{ isset($post) ? $post->content : old('content') }}</textarea>
                        @error('content')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
                            {{ isset($post) ? __('Update') : __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
