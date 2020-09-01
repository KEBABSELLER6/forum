@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h4 class="col-11">Profile details</h4>
        @can('update', $user)
        <a class="col-1 " href="/profile/{{$user->id}}/edit">Edit</a>
        @endcan
    </div>
    <div class="row form-group">
        <div class="col-6">
            <label for="email">Email address :</label>
            <div id="email">{{$user->email}}</div>
        </div>
        <div class="col-6">
            <label for="username">Username :</label>
            <div id="username">{{$user->name}}</div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-6">
            <label for="created_at">Registered at :</label>
            <div id="created_at">{{$user->created_at}}</div>
        </div>
        @if ($user->isModerator())
        <div class="col-6">
            <div class="badge badge-primary badge-pill text-light">Moderator</div>
            @can('revokeModerator', Auth::user())
            <a class="badge badge-primary badge-pill text-danger"
                href="{{ route('profile.revokeModerator',[$user->id]) }}" onclick="event.preventDefault();
                                          document.getElementById('revoke-form').submit();">
                {{ __('Revoke moderator') }}
            </a>

            <form id="revoke-form" action="{{ route('profile.revokeModerator',[$user->id]) }}" method="POST"
                style="display: none;">
                @csrf
            </form>
            @endcan
        </div>
        @else
        @can('grantModerator', Auth::user())
        <div class="col-6">
            <a class="badge badge-primary badge-pill text-success"
                href="{{ route('profile.grantModerator',[$user->id]) }}" onclick="event.preventDefault();
                                                     document.getElementById('grant-form').submit();">
                {{ __('Grant moderator') }}
            </a>

            <form id="grant-form" action="{{ route('profile.grantModerator',[$user->id]) }}" method="POST"
                style="display: none;">
                @csrf
            </form>
        </div>
        @endcan
        @endif
    </div>
    @can('update', $user)
    <h4 class="form-group"><a href="/password/reset">Reset password</a></h4>
    @endcan
    <h4 class="form-group">Last posts</h4>
    @foreach ($user->getLastPosts() as $post)
    <div class="justify-content-between list-group-item">
        <a href="{{ route('comments.index', [$post->topic()->get()[0]->show_id,$post->show_id]) }}">
            <h5 class="mb-1">{{ $post->title }}</h5>
        </a>
        <p class="mb-1">{{ $post->descr }}</p>
    </div>
    @endforeach
    <h4 class="form-group">Last comments</h4>
    @foreach ($user->getLastComments() as $comment)
    <div class="justify-content-between list-group-item">
        <a href="{{ route('comments.index', [$comment->getTopic()->show_id,$comment->post()->get()[0]->show_id]) }}">
            <h5 class="mb-1">{{ $comment->post()->get()[0]->title }}</h5>
        </a>
        <p class="mb-1">{{ $comment->body }}</p>
    </div>
    @endforeach
</div>
@endsection