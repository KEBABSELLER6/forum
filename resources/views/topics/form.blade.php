@extends('layouts.app')

@section('content')
<div class="container">
    <h4>{{$title}}</h4>
    {!! Form::open(array('route' => array($route, $routeArgs), 'class'=>'form_wrapper', 'method' => $method)) !!}
    <div class="form-group">
        {!! Form::label('title', 'Topic title:') !!}
        {!! Form::text('title', isset($topic) ? $topic->title : '', array('class'=>'form-control')) !!}
        @component('components.form-error',['field'=>'title'])@endcomponent
    </div>
    <div class="form-group">
        {!! Form::label('descr', 'Topic description:') !!}
        {!! Form::textarea('descr', isset($topic) ? $topic->descr : '', array('class'=>array('form-control'),
        'rows'=>4)) !!}
        @component('components.form-error',['field'=>'descr'])@endcomponent
    </div>
    @component('components.form-submit')@endcomponent
    {!! Form::close() !!}
</div>
@endsection