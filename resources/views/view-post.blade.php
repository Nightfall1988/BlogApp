@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form>                
                    <div>
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
                        <div id="add-comment">
                            <input id="comment" name="comment"></input>
                            <button id="submit-bttn" type="button">Submit</button>
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
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
