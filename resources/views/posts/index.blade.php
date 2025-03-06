@extends('layout.app')


@section('content')

<div class="flex flex-col gap-3 justify-between items-center my-3 px-3">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
   
</div>
<div class="position-absolute top-0 end-0 m-3">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Log Out</button>
    </form>
</div>

<div class="container mt-4">
    <h1 class="mb-4">All Posts</h1>

    <table class="table">
        <thead>
            <tr>
              
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                   
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['description'] }}</td>
                    <td>
                    <img src="{{ asset('storage/uploads/' . $post['image']) }}" alt="{{ $post['title'] }}" width="300">

                    </td>
                    <td>
                        <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-info text-white">View</a>
                        <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="display:inline;" 
                              onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
