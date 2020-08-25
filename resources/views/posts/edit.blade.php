@extends('layouts.app')

@section('content')
    <div class="container">
            <h4>Edit post</h4>
            {!! Form::open(array('url' => '/topics/' . $topic->show_id . '/posts/' . $post->show_id, 'class'=>'form_wrapper', 'method' => 'put')) !!}
                <div class="form-group">
                    <div>
                        {!! Form::label('title', 'Post title:') !!}
                    </div>
                    {!! Form::text('title', $post->title, array('class'=>'form-control')) !!}
                </div>
                <div class="form-group">
                    <div>
                        {!! Form::label('descr', 'Post description:') !!}
                    </div>
                    {!! Form::textarea('descr', $post->descr, array('class'=>array('form-control'), 'rows'=>4)) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Submit', array('class'=>array('btn','btn-primary'))) !!}
                </div>
            {!! Form::close() !!}
    </div>
@endsection