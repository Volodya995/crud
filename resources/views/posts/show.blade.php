@extends('inc.app')

@section('title', $post->title)

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->description }}</p>
            <p>{{ $post->price }}$</p>
        </div>
    </div>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary mt-3">Go back</a>
@endsection
