@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Edit topic</h4>
        {!! Form::open(array('url' => '/topics/' . $topic->show_id, 'class'=>'form_wrapper', 'method' => 'put')) !!}
            <div class="form-group">
                {!! Form::label('title', 'Topic title:') !!}
                {!! Form::text('title', $topic->title, array('class'=>'form-control')) !!}
                @error('descr')
                    <p class="invalid-feedback" style="display: inline">
                        {{$title}}
                    </p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('descr', 'Topic description:') !!}
                {!! Form::textarea('descr', $topic->descr, array('class'=>array('form-control'), 'rows'=>4)) !!}
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