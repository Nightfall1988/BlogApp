@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Author</th>
                                <th>Created</th>
                                <th>Article Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post['title'] }}</td>
                                <td>{{ $post['content'] }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ date('d/M/Y H:i', strtotime($post['created_at'])) }}</td>
                                <td><a href="/view-post/{{ $post['id'] }}" target="_blank">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
