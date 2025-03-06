@extends('layout.app')

@section("content")
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bootstrap Table</title>
</head>
<div class="container mt-4">
    <div class="card m-5" style="width: 40rem;">
    <img src="{{ asset('storage/uploads/' . $post['image']) }}" class="card-img-top" alt="{{ $post['title'] }}">
        <div class="card-body">
            <h5 class="card-title">{{ $post['title'] }}</h5>
            <p class="card-text">Description: {{ $post['description'] }}</p>
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
