<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('posts.index') }}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('posts.search') }}">
                @csrf
                <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
                <button class="btn btn-outline-success text-white my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

@yield('script')
@include('sweetalert::alert')

</body>
</html>
