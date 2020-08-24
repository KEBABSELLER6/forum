@extends('base')

@section('content')
    <div class="content">
        <div class="form_title">Edit topic</div>
        {!! Form::open(array('url' => '/topics/' . $topic->show_id, 'class'=>'form_wrapper', 'method' => 'put')) !!}
            <div class="form_field">
                <div>
                    {!! Form::label('title', 'Topic title:') !!}
                </div>
                {!! Form::text('title', $topic->title, array('class'=>'form_input_text')) !!}
            </div>
            <div class="form_field">
                <div>
                    {!! Form::label('descr', 'Topic description:') !!}
                </div>
                {!! Form::textarea('descr', $topic->descr, array('class'=>array('form_input_text',"form_input_body"))) !!}
            </div>
            <div class="form_field">
                {!! Form::submit('Submit') !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection