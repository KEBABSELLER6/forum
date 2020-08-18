
    @foreach ($topics as $topic)
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
