@extends('inc.app')

@section('title', 'Posts')

@section('content')
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create post</a>

    @if (count($posts))
        <table class="table table-striped">
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
        <h2 class="text-muted">No posts!</h2>
    @endif

    @if (count($posts))
        {{ $posts->links() }}
    @endif

    <a href="{{ route('posts.deleted.show') }}" style="bottom: 25px; right: 25px"
       class="btn btn-lg btn-primary position-fixed rounded-circle">
        <span class="badge bg-danger rounded-circle small"
              style="position: absolute; top: -5px; right: -3px">{{ $count ? $count : null }}</span>
        <i class="fas fa-trash"></i>
    </a>
@endsection

@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
