@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Edit topic</h4>
        {!! Form::open(array('url' => '/topics', 'class'=>'form_wrapper')) !!}
            <div class="form-group">
                <div>
                    {!! Form::label('title', 'Topic title:') !!}
                </div>
                {!! Form::text('title', '', array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                <div>
                    {!! Form::label('descr', 'Topic description:') !!}
                </div>
                {!! Form::textarea('descr', '', array('class'=>array('form-control'), 'rows'=>4)) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit', array('class'=>array('btn','btn-primary'))) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection