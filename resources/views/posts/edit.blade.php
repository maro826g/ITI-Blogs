@extends('layout.app')

@section('content')
<div class="container mt-4">
    
    <form method="POST" action="{{ route('posts.update', $post['id']) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $post['title']) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required>{{ old('description', $post['description']) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
            
            @if ($post['image'])
                <img src="{{ asset('storage/uploads/' . $post['image']) }}" width="300" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
