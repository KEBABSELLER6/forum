@extends('base')

@section('content')
    <div class="content">
        <div class="post_header">
            <div>
                <div class="post_info">
                    <div class="post_author">{{ $post->created_by }}</div>
                    <div class="post_date">{{ $post->created_at }}</div>
                </div>
                <div class="post_title">{{ $post->title }}</div>
                <div class="post_desc">{{ $post->descr }}</div>
            </div>
        </div>
        <div class="form_title">New comment</div>
        {!! Form::open(array('url' => '/topics/' . $topic . '/posts/' . $post->show_id . '/comments', 'class'=>'form_wrapper')) !!}
            <div class="form_field">
                <div>
                    {!! Form::label('body', 'Comment body:') !!}
                </div>
                {!! Form::textarea('body', '', array('class'=>array('form_input_text',"form_input_body"))) !!}
            </div>
            <div class="form_field">
                <div>
                    {!! Form::label('creator', 'creator') !!}
                </div>
                {!! Form::text('creator','', array('class'=>'form_input_text')) !!}
            </div>
            <div class="form_field">
                {!! Form::submit('Submit') !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection