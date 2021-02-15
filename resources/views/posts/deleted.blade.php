@extends('inc.app')

@section('title', 'Posts')

@section('content')
    <h1 class="display-4 text-muted mb-2">Deleted posts</h1>

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
                        <form method="post" class="d-inline-block" action="{{ route('posts.trashed.recover', $post->id) }}">
                            @csrf
                            <button class="btn btn-info">Recover</button>
                        </form>

                        <form class="d-inline-block" method="post" action="{{ route('posts.trashed.delete', $post->id) }}">
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

@endsection

@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
