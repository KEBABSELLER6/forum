@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <h3>General</h3>
        </div>
        <div class="list-group">
            @component('topics.list',['topics'=>$gTopics])@endcomponent
        </div>
        <div class='row'>
            <h3>Unique</h3>
        </div>
        <div class="list-group">
            @component('topics.list',['topics'=>$uTopics])@endcomponent
            @can('create', App\Topic::class)
            <a href="{{ route('topics.create') }}" class="list-group-item list-group-item-action">
                <div class="row align-items-center">
                    <div class="col justify-content-between">
                        <h5 class="mb-1">+ Add new topic</h5>
                    </div>
                </div>
            </a>
            @endcan
        </div>
    </div>
       

@endsection

        

