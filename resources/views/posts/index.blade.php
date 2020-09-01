@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="jumbotron w-100">
            <h1 class="display-6">{{$topic->title}}</h1>
            <p class="lead">{{$topic->descr}}</p>
            <div class="justify-content-between">
                <div>
                    <a class="badge badge-primary badge-pill text-light" href="{{ route('profile.show' ,$topic->user_id) }}">
                        {{$topic->getOwnerName()}}
                    </a>
                </div>
                <small>Created at : {{$topic->created_at}}</small>
            </div>
        </div>
    </div>
    <ul class="list-group">
        @component('components.post-list',['posts'=>$posts, 'topic'=>$topic->show_id])@endcomponent
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