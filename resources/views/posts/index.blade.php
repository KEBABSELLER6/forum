@extends('base')

@section('content')
    <div id="content">
        <div class="items_header">
            <div>
                <div class="items_title">{{$topic->title}}</div>
                <div class="items_desc">{{$topic->descr}}</div>
            </div>
            <div class="items_options">
                <div>
                    <a href="{{ route('topics.edit', $topic->show_id) }}" class="option_links">
                        <img src="/images/edit.png" alt="edit" class="option_icons">
                    </a>
                </div>
                <div>
                    <a href="{{ route('topics.delete', $topic->show_id) }}" class="option_links">
                        <img src="/images/trash.png" alt="delete" class="option_icons">
                    </a>
                </div>
            </div>
        </div>
        <ul class="item_list">
            @foreach ($posts as $post)
            <li class="item">
                <div class="item_header">
                    <div class="item_title">
                        <a class="item_links" href="{{ route('comments.index',[$topic->show_id,$post->show_id]) }}">{{ $post->title }}</a>
                    </div>
                    <div class="item_desc">{{ $post->descr }}</div>
                </div>
                <div class="item_info">
                    <div class="item_desc">Last activity at : {{ $post->recent_comment_at }}</div>
                    <div class="item_desc">Created by: {{ $post->creator }}</div>
                </div>
            </li>
            @endforeach
            <li class="item">
                <div>
                    <a href="{{ route('posts.create', $topic->show_id) }}" class="item_links">+ Add new post</a>
                </div>
            </li>
        </ul>
    </div>
@endsection