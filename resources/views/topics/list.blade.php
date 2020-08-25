
        @foreach ($topics as $topic)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="col-8 justify-content-between">
                        <a href="{{ route('posts.index', $topic->show_id) }}">
                            <h5 class="mb-1">{{ $topic->title }}</h5>
                        </a>
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
                    <div class="col-1 dropdown justify-content-between">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        @can('update', $topic)
                            <a class="dropdown-item" href="/topics/{{ $topic->show_id}}/edit">Edit topic</a>
                        @endcan
                        @can('delete', $topic)
                            <a class="dropdown-item" href="#">Delete topic</a>
                        @endcan
                        </div>
                    </div>
                    @endcanany
            </li>      
        @endforeach
