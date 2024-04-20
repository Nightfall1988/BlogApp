@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-center">
        <div class="col-md-8">
            <div class="lg:w-12/12 xl:w-12/12">
                <div class="p-6">
                    <table class="w-full text-lg">
                        <thead>
                            <tr>
                                <th class="px-2 py-2 text-center">Title</th>
                                <th class="px-2 py-2 text-center">Content</th>
                                <th class="px-2 py-2 text-center">Author</th>
                                <th class="px-2 py-2 text-center">Created</th>
                                <th class="px-2 py-2 text-center">Article Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr class="border-t bg-white rounded shadow-lg">
                                <td class="px-2 py-2">{{ $post['title'] }}</td>
                                <td class="px-2 py-2">{{ strlen($post['content']) > 150 ? substr($post['content'], 0, 150) . '...' : $post['content'] }}</td>
                                <td class="px-2 py-2 w-32">{{ $post->user->name }}</td>
                                <td class="px-2 py-2 w-40">{{ date('d/M/Y H:i', strtotime($post['created_at'])) }}</td>
                                <td class="px-2 py-2 text-blue-700"><u><a href="/view-post/{{ $post['id'] }}" target="_blank">View</a></u></td>
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
<style>
    th:nth-child(4), /* Created At column */
td:nth-child(4),
th:nth-child(3), /* Author column */
td:nth-child(3) {
    width: 181px; /* Adjust as needed */
    white-space: nowrap; /* Prevent text wrapping */
    overflow: hidden; /* Hide overflow text */
    text-overflow: ellipsis; /* Display ellipsis for overflow text */
}
    </style>