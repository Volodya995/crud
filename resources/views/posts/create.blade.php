@extends('inc.app')

@section('title', 'post create')

@section('content')
    <form method="post" action="{{ route('posts.store') }}">
        @csrf
        <div class="form-group">
            <label for="post_title">Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="form-control @error('title') is-invalid @enderror" id="post_title">

            @error('title')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="post_description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror"
                      name="description" id="post_description" rows="3">{{ old('description') }}</textarea>

            @error('description')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="post_price">Price</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                   name="price" id="post_price">

            @error('price')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Create</button>
    </form>
@endsection
