@foreach ($posts as $post)
<li class="list-group-item d-flex justify-content-between align-items-center">
    <div class="col-8 justify-content-between">
        <a href="{{ route('comments.index', [$topic,$post->show_id]) }}">
            <h5 class="mb-1">{{ $post->title }}</h5>
        </a>
        <p class="mb-1">{{ $post->descr }}</p>
    </div>
    <div class="col-3 justify-content-between">
        <div>
            <small>Last comment : {{$post->rCommentDate}}</small>
        </div>
        <div>
            <div>
                <a class="badge badge-primary badge-pill text-light" href="{{route('profile.show',$topic)}}">
                    {{$post->owner}}
                </a>
            </div>
        </div>
    </div>
    @canany(['update', 'delete'], $post)
    <div class="col-1 dropdown justify-content-between">
        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"></button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
            @can('update', $post)
            <a class="dropdown-item" href="{{ route('posts.edit' ,[$topic,$post->show_id]) }}">Edit post</a>
            @endcan
            @can('delete', $post)
            <a class="dropdown-item" href="{{ route('posts.remove' ,[$topic,$post->show_id]) }}">Delete
                post</a>
            @endcan
        </div>
    </div>
    @endcanany
</li>
@endforeach