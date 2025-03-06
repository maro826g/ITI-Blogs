@extends('layout.app')

@section('content')
    <h1>Your Posts</h1>

   
    {{-- Display posts --}}
    <ul>
        @foreach($posts as $post)
            <li>
                <h2>{{ $post['title'] }}</h2>
                <p>{{ $post['description'] }}</p>
                <img src="{{ asset('images/' . $post['image']) }}" alt="{{ $post['title'] }}">
            </li>
        @endforeach
    </ul>
@endsection
