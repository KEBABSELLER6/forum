@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <h1 class="display-6">{{$topic->title}}</h1>
                <p class="lead">{{$topic->descr}}</p>
                <div class="justify-content-between">
                    <span class="badge badge-primary badge-pill">{{ $topic->getOwnerName() }}</span>
                    <small>Created at : {{$topic->getRecentPostDate()}}</small>
                </div>
            </div>
        </div>
        <div class="list-group">
            @foreach ($posts as $post)
                <a href="{{ route('comments.index', [$topic->show_id,$post->show_id]) }}" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                        <div class="col-8 justify-content-between">
                            <h5 class="mb-1">{{ $post->title }}</h5>
                            <p class="mb-1">{{ $post->descr }}</p>
                    </div>
                    <div class="col-3 justify-content-between">
                        <div>
                            <small>Last post : {{$post->getLastCommentDate()}}</small>
                        </div>
                        <div>
                            <span class="badge badge-primary badge-pill">{{ $topic->getOwnerName() }}</span>
                        </div>
                    </div>
                    @canany(['update', 'delete'], $post)
                    <div class="dropdown col-1">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            @can('update', $post)
                                <button class="dropdown-item" type="button">Edit post</button>
                            @endcan
                            @can('delete', $post)
                                <button class="dropdown-item" type="button">Delete post</button>
                            @endcan
                        </div>
                    </div>
                    @endcanany
                    </div>
                </a>
            @endforeach
            @can('create', App\Topic::class)
            <a href="{{ route('posts.create', $topic->show_id) }}" class="list-group-item list-group-item-action">
                <div class="row align-items-center">
                    <div class="col justify-content-between">
                        <h5 class="mb-1">+ Add new post</h5>
                    </div>
                </div>
            </a>
            @endcan
        </div>
    </div>
@endsection