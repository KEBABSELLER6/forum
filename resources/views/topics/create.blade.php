@extends('base')

@section('content')
    <div class="content">
        <div class="form_title">New topic</div>
        {!! Form::open(array('url' => '/topics', 'class'=>'form_wrapper')) !!}
            <div class="form_field">
                <div>
                    {!! Form::label('title', 'Topic title:') !!}
                </div>
                {!! Form::text('title', '', array('class'=>'form_input_text')) !!}
            </div>
            <div class="form_field">
                <div>
                    {!! Form::label('descr', 'Topic description:') !!}
                </div>
                {!! Form::textarea('descr', '', array('class'=>array('form_input_text',"form_input_body"))) !!}
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