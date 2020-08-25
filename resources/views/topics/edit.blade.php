@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Edit topic</h4>
        {!! Form::open(array('url' => '/topics/' . $topic->show_id, 'class'=>'form_wrapper', 'method' => 'put')) !!}
            <div class="form-group">
                <div>
                    {!! Form::label('title', 'Topic title:') !!}
                </div>
                {!! Form::text('title', $topic->title, array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                <div>
                    {!! Form::label('descr', 'Topic description:') !!}
                </div>
                {!! Form::textarea('descr', $topic->descr, array('class'=>array('form-control'), 'rows'=>4)) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit', array('class'=>array('btn','btn-primary'))) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection