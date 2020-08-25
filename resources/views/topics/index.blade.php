@extends('base')

@section('content')
    <div class="content">
        <div id="general_topics">
            <div class="items_header">
                <div class="items_title">General</div>
            </div>
            <ul class="item_list">
                @yield('topicList')
                @component('topics.list',['topics'=>$gTopics])@endcomponent
            </ul>
        </div>

        <div id="unique_topics">
            <div class="items_header">
                <div class="items_title">Unique</div>
            </div>
            <ul class="item_list">
                @component('topics.list',['topics'=>$uTopics])@endcomponent
                @can('create', App\Topic::class)
                <li class="item">
                    <div>
                        <a href="{{ route('topics.create') }}" class="item_links">+ Add new topic</a>
                    </div>
                </li>
                @endcan
            </ul>
        </div>

    </div>
@endsection

        

