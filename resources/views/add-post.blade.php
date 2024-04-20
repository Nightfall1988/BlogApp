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
                            <input id="postId" type="hidden" name='postId' value="{{ $post->id }}"></input>

                            <h2 class="text-lg font-semibold mb-2">Categories</h2>
                            <div class="flex flex-wrap">
                                @foreach ($post->categories as $category)
                                    <div class="flex items-center bg-gray-200 rounded-full px-3 py-1 m-1">
                                        <span>{{ $category->name }}</span>
                                        <button type="button" class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none" onclick="removeCategory({{ $category->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <input type="hidden" id="selectedCategories" name="selectedCategories">

                    @if(isset($post))

                    <input id="postId" type="hidden" value="{{ $post->id }}"></input>
                    <div>
                        <div class="flex">
                            @foreach($categories as $category)
                                @unless ($post->categories->contains($category->id))
                                    <div class="flex items-center cursor-pointer mr-4" onclick="toggleCategory('{{ $category }}')">
                                        <input type="checkbox" name="categories[]" id="{{ $category }}" value="{{ $category->id }}" class="hidden">
                                        <label for="{{ $category }}" class="px-3 py-1 rounded-full bg-gray-300 hover:bg-gray-400">{{ $category->name }}</label>
                                    </div>
                                @endunless
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div>
                        <div class="flex">
                            @foreach($categories as $category)
                                <div class="flex items-center cursor-pointer mr-4" onclick="toggleCategory('{{ $category }}')">
                                    <input type="checkbox" name="categories[]" id="{{ $category }}" value="{{ $category->id }}" class="hidden">
                                    <label for="{{ $category }}" class="px-3 py-1 rounded-full bg-gray-300 hover:bg-gray-400">{{ $category->name }}</label>
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
@endsection
<script>
// import axios from 'axios';


function toggleCategory(category) {
    const checkbox = document.getElementById(category);
    checkbox.checked = !checkbox.checked;
    if (checkbox.checked) {
        checkbox.nextElementSibling.classList.remove('bg-gray-300');
        checkbox.nextElementSibling.classList.add('bg-blue-500');
    } else {
        checkbox.nextElementSibling.classList.remove('bg-blue-500');
        checkbox.nextElementSibling.classList.add('bg-gray-300');
    }
    updateSelectedCategories();
}

function updateSelectedCategories() {
    const selectedCategories = Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => checkbox.value);
    document.getElementById('selectedCategories').value = JSON.stringify(selectedCategories);
}


// MAKE CATEGORY DELETION
function removeCategory(postId, categoryIds) {
    axios.post('/remove-category/' + postId, {
        category_ids: categoryIds
    })
    .then(function(response) {
        console.log(response.data);
        alert('Categories removed successfully!');
        // Optionally, you can update the UI here to reflect the changes
    })
    .catch(function(error) {
        console.error(error);
        alert('An error occurred while removing categories.');
    });
}
</script>