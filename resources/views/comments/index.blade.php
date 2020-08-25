@extends('base')

@section('content')
    <div class="content">
        <div class="post_header">
            <div>
                <div class="post_info">
                    <div class="post_author">{{ $post->getOwnerName() }}</div>
                    <div class="post_date">{{ $post->created_at }}</div>
                </div>
                <div class="post_title">{{ $post->title }}</div>
                <div class="post_desc">{{ $post->descr }}</div>
            </div>
            <div class="items_options">
                @can('update', $post)
                <div>
                    <a href="{{ route('posts.edit', [$topic, $post->show_id]) }}" class="option_links">
                        <img src="/images/edit.png" alt="edit" class="option_icons">
                    </a>
                </div>
                @endcan
                @can('delete', $post)
                <div>
                    <a href="{{ route('posts.delete', [$topic,$post->show_id]) }}" class="option_links">
                        <img src="/images/trash.png" alt="delete" class="option_icons">
                    </a>
                </div>
                @endcan
            </div>
        </div>
        <ul class="item_list">
            @foreach ($comments as $comment)
            <li class="comment">
                <div>
                    <div class="comment_header">
                        <div class="comment_author">{{ $comment ->getOwnerName() }}</div>
                        <div class=comment_date>{{ $comment ->created_at }}</div>
                    </div>
                    <div class="comment_body">{{ $comment ->body }}</div>
                </div>
                <div class="items_options">
                    @can('update', $comment)
                    <div>
                        <a href="{{ route('comments.edit', [$topic,$post->show_id,$comment->show_id]) }}" class="option_links">
                            <img src="/images/edit.png" alt="edit" class="option_icons">
                        </a>
                    </div>
                    @endcan
                    @can('delete', $comment)
                    <div>
                        <a href="{{ route('comments.delete', [$topic,$post->show_id,$comment->show_id]) }}" class="option_links" data-method="delete">
                            <img src="/images/trash.png" alt="delete" class="option_icons">
                        </a>
                    </div>
                    @endcan
                </div>
            </li>
            @endforeach
            @can('create', App\Comment::class)
            <li class="comment">
                <div>
                    <a href="{{ route('comments.create',[$topic,$post->show_id]) }}" class="item_links">+ Add new comment</a>
                </div> 
            </li>
            @endcan
        </ul>
    </div>
@endsection