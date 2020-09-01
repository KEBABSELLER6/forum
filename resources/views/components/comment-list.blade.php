@foreach ($comments as $comment)
<li class="list-group-item d-flex justify-content-between align-items-center">
    <div class="col-11 justify-content-between">
        <div>
            <div>
                <a class="badge badge-primary badge-pill text-light"
                    href="{{route('profile.show', $comment->user_id)}}">{{$comment->getOwnerName()}}</a>
            </div>
            <small>Created at : {{$comment->created_at}}</small>
        </div>
        <p class="mb-1">{{ $comment->body }}</p>
    </div>
    @canany(['update', 'delete'], $comment)
    <div class="col-1 dropdown justify-content-between">
        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"></button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
            @can('update', $comment)
            <a class="dropdown-item"
                href="{{route('comments.edit',[$topic,$post,$comment->show_id])}}">Edit comment</a>
            @endcan
            @can('delete', $comment)
            <a class="dropdown-item"
                href="{{route('comments.remove',[$topic,$post,$comment->show_id])}}">Delete comment</a>
            @endcan
        </div>
    </div>
    @endcanany
</li>
@endforeach