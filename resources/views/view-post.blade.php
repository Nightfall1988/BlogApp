@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div>
                    <h2>Categories</h2>
                    <ul>
                        @foreach ($post->categories as $category)
                            {{ $category->name }}
                        @endforeach
                    </ul>
                </div>
                <div class="card-header">{{ __('Dashboard') }}</div>
                    <div id="post_"{{ $post['id'] }}>
                        <div>
                            <p>{{ $post['title'] }}</p>
                        </div>
                        <div>
                            <p>{{ $post['content'] }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h2>Comments</h2>
                    <ul>
                        @foreach ($post->comments as $comment)
                            <li>{{ $comment->body }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
