@extends('base')

@section('content')
    <div class="content">
        <div class="form_title">New post for {{ $topic->title }}</div>
        {!! Form::open(array('url' => '/topics/' . $topic->show_id . '/posts/' . $post->show_id, 'class'=>'form_wrapper', 'method' => 'put')) !!}
            <div class="form_field">
                <div>
                    {!! Form::label('title', 'Post title:') !!}
                </div>
                {!! Form::text('title', $post->title, array('class'=>'form_input_text')) !!}
            </div>
            <div class="form_field">
                <div>
                    {!! Form::label('descr', 'Post description:') !!}
                </div>
                {!! Form::textarea('descr', $post->descr, array('class'=>array('form_input_text',"form_input_body"))) !!}
            </div>
            <div class="form_field">
                <div>
                    {!! Form::label('creator', 'creator') !!}
                </div>
                {!! Form::text('creator',$post->created_by, array('class'=>'form_input_text')) !!}
            </div>
            <div class="form_field">
                {!! Form::submit('Submit') !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection