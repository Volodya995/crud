@extends('inc.app')

@section('title', 'post edit')

@section('content')
    <form method="post" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="post_title">Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="post_title" value="{{ $post->title }}">

            @error('title')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="post_description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="post_description" rows="3">{{ $post->description }}</textarea>

            @error('description')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="post_price">Price</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="post_price" value="{{ $post->price }}">

            @error('price')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Cancel</a>
    </form>
@endsection
