@extends('layout.app')
@section("content")

<form class="m-5" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*"required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
