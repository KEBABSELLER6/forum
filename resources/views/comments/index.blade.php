@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <h1 class="display-6">{{$post->title}}</h1>
                <p class="lead">{{$post->descr}}</p>
                <div class="justify-content-between">
                    <span class="badge badge-primary badge-pill">{{ $post->getOwnerName() }}</span>
                    <small>Created at : {{$post->getLastCommentDate()}}</small>
                </div>
            </div>
        </div>

        <div class="list-group">
            @foreach ($comments as $comment)
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                        <div class="col-11 justify-content-between">
                            <div>
                                <span class="badge badge-primary badge-pill">{{ $comment->getOwnerName() }}</span>
                                <small>Created at : {{$comment->created_at}}</small>
                            </div>
                            <p class="mb-1">{{ $comment->body }}</p>
                    </div>
                    @canany(['update', 'delete'], $post)
                    <div class="dropdown col-1">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            @can('update', $comment)
                                <button class="dropdown-item" type="button">Edit post</button>
                            @endcan
                            @can('delete', $comment)
                                <button class="dropdown-item" type="button">Delete post</button>
                            @endcan
                        </div>
                    </div>
                    @endcanany
                    </div>
                </a>
            @endforeach
            @can('create', App\Comment::class)
            <a href="{{  route('comments.create',[$topic,$post->show_id]) }}" class="list-group-item list-group-item-action">
                <div class="row align-items-center">
                    <div class="col justify-content-between">
                        <p class="mb-1">+ Add new comment</p>
                    </div>
                </div>
            </a>
            @endcan
        </div>
    </div>
@endsection