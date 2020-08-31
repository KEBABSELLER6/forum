@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="jumbotron w-100">
                <h1 class="display-6">{{$topic->title}}</h1>
                <p class="lead">{{$topic->descr}}</p>
                <div class="justify-content-between">
                    <div>
                        <a class="badge badge-primary badge-pill text-light" href="/profile/{{$topic->user_id}}">
                            {{$topic->getOwnerName()}}
                        </a>
                    </div>
                    <small>Created at : {{$topic->getRecentPostDate()}}</small>
                </div>
            </div>
        </div>
        <ul class="list-group">
            @foreach ($posts as $post)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="col-8 justify-content-between">
                    <a href="{{ route('comments.index', [$topic->show_id,$post->show_id]) }}">
                        <h5 class="mb-1">{{ $post->title }}</h5>
                    </a>   
                    <p class="mb-1">{{ $post->descr }}</p>
            </div>
            <div class="col-3 justify-content-between">
                <div>
                    <small>Last post : {{$post->getLastCommentDate()}}</small>
                </div>
                <div>
                    <div>
                        <a class="badge badge-primary badge-pill text-light" href="/profile/{{$post->user_id}}">
                            {{$post->getOwnerName()}}
                        </a>
                    </div>
                </div>
                    </div>
                    @canany(['update', 'delete'], $post)
                <div class="col-1 dropdown justify-content-between">
                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                    @can('update', $post)
                        <a class="dropdown-item" href="/topics/{{ $topic->show_id}}/posts/{{ $post->show_id }}/edit">Edit post</a>
                    @endcan
                    @can('delete', $post)
                        <a class="dropdown-item" href="/topics/{{ $topic->show_id}}/posts/{{ $post->show_id }}/remove">Delete post</a>
                    @endcan
                    </div>
                </div>
                    @endcanany
            </li>                    
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
        </ul>
    </div>
@endsection