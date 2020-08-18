@extends('base')

@section('content')
    <div class="content">
        <div id="general_topics">
            <div class="items_header">
                <div class="items_title">General</div>
            </div>
            <ul class="item_list">
                @foreach ($genTopics as $topic)
                    <li class="item">
                        <div class="item_header">
                            <div class="item_title">
                                <a class="item_links" href="{{ route('posts.index', $topic->show_id) }}">{{ $topic->title }}</a>
                            </div>
                            <div class="item_desc">{{ $topic->descr }}</div>
                        </div>
                        <div class="item_info">
                            <div class="item_desc">Last post created at : {{$topic->recent_post_at}}</div>
                            <div class="item_desc">Created by : {{ $topic->created_by }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div id="unique_topics">
            <div class="items_header">
                <div class="items_title">Unique</div>
            </div>
            <ul class="item_list">
                @foreach ($uniqTopics as $topic)
                    <li class="item">
                        <div class="item_header">
                            <div class="item_title">
                                <a class="item_links" href="{{ route('posts.index', $topic->show_id) }}">{{ $topic->title }}</a>
                            </div>
                            <div class="item_desc">{{ $topic->descr }}</div>
                        </div>
                        <div class="item_info">
                            <div class="item_desc">Last post created at : {{$topic->recent_post_at}}</div>
                            <div class="item_desc">Created by : {{ $topic->created_by }}</div>
                        </div>
                    </li>
                @endforeach
                <li class="item">
                    <div>
                        <a href="{{ route('topics.create') }}" class="item_links">+ Add new topic</a>
                    </div>
                </li>
            </ul>
        </div>

    </div>
@endsection

        

