
    @foreach ($topics as $topic)
        <a href="{{ route('posts.index', $topic->show_id) }}" class="list-group-item list-group-item-action">
            <div class="row align-items-center">
                <div class="col-8 justify-content-between">
                    <h5 class="mb-1">{{ $topic->title }}</h5>
                    <p class="mb-1">{{ $topic->descr }}</p>
                </div>
                <div class="col-3 justify-content-between">
                    <div>
                        <small>Last post : {{$topic->getRecentPostDate()}}</small>
                    </div>
                    <div>
                        <span class="badge badge-primary badge-pill">{{ $topic->getOwnerName() }}</span>
                    </div>
                </div>
                @canany(['update', 'delete'], $topic)
                <div class="dropdown col-1">
                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        @can('update', $topic)
                            <button class="dropdown-item" type="button">Edit topic</button>
                        @endcan
                        @can('delete', $topic)
                            <button class="dropdown-item" type="button">Delete topic</button>
                        @endcan
                    </div>
                </div>
                @endcanany
            </div>
        </a>
    @endforeach
