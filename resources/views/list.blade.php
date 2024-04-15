@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                                <th>User ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post['title'] }}</td>
                                <td>{{ $post['content'] }}</td>
                                <td>{{ $post['user_id'] }}</td>
                                <td>{{ $post['created_at'] }}</td>
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
