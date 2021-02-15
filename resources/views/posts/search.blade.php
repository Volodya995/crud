@extends('inc.app')

@section('title', 'Post search')

@section('content')
    @if (count($posts))
        <table class="table table-striped mt-5">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ Str::limit($post->title, 40, '...') }}</td>
                    <td>{{ Str::limit($post->description, 60, '...') }}</td>
                    <td>{{ $post->price }}$</td>
                    <td class="text-right">
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-success">Show</a>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-info">Edit</a>
                        <form class="d-inline-block" method="post" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-muted">No data found!</h1>
    @endif

    {{ $posts->withQueryString()->links() }}
@endsection

