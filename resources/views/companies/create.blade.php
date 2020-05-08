@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    <div class="container">
        <div class="main col-sm col-md col-lg col-xl">
            <div class="title_company">
                <h2>Create new company</h2>
            </div>
            {{ HTML::ul($errors->all() )}}

            {{ Form::open(array('url' => 'company')) }}

            <div class="form-group">
                {{ Form::label('short_name', 'Short Name') }}
                {{ Form::text('short_name', Request::old('short_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('official_name', 'Official Name') }}
                {{ Form::email('official_name', Request::old('official_name'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Create the Nerd!', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
@endsection
