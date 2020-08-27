@extends('layouts.app')

@section('content')
    <div class="container">
       <h4>New post for {{ $topic->title }}</h4>
        {!! Form::open(array('url' => '/topics/' . $topic->show_id . '/posts', 'class'=>'form_wrapper')) !!}
            <div class="form-group">
                {!! Form::label('title', 'Post title:') !!}
                {!! Form::text('title', '',  array('class'=>'form-control')) !!}
                @error('title')
                    <p class="invalid-feedback" style="display: inline">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('descr', 'Post description:') !!}
                {!! Form::textarea('descr', '',  array('class'=>array('form-control'), 'rows'=>4)) !!}
                @error('descr')
                    <p class="invalid-feedback" style="display: inline">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::submit('Submit', array('class'=>array('btn','btn-primary'))) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection