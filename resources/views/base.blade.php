<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum</title>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jakab's Forum</title>

        <link rel="stylesheet" href="{{asset('/css/style.css')}}" type="text/css">
</head>
<body>
    <div id="container">
        <header id="header">
            <div id="nav">
                <a href="{{route('topics.index')}}">Home</a>
                <a href="/profile">Profile</a>
                <a href="https://github.com/">github</a>
            </div>
        </header>

        <div id="forum_head">Jakab's Forum</div>
    
        @yield('content')

    </div>
</body>
</html>