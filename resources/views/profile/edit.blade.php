@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Edit profile</h4>
        {!! Form::open(array('url' => '/profile/' . $user->id, 'method' => 'put')) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Username:') !!}
                    {!! Form::text('name', $user->name, array('class'=>'form-control')) !!}
                    @error('name')
                    <p class="invalid-feedback" style="display: inline">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email address:') !!}
                    {!! Form::text('email', $user->email, array('class'=>'form-control')) !!}
                    @error('email')
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