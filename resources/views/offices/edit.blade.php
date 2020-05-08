@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    <div class="container">
        <div class="main col-sm col-md col-lg col-xl">
            <h1>Edit office</h1>
            {{ HTML::ul($errors->all()) }}
            <form action="{{ route('offices.update', $office->id) }}" method="PUT">

                <div class="form-group">
                    {{ Form::label('full_address', 'Full Address') }}
                    {{ Form::text('full_address', $office->full_address, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('company_id', 'Company') }}
                    <select name="company_id"
                            class="form-control {{ $errors->has('company_id') ? ' is-invalid' : '' }}">
                        @foreach( $companies as $company ):
                        <option value="{{ $company->id }}" {{ ($office->company->id == $company->id ? "selected":"") }}>
                            {{$company->official_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{ Form::submit('Edit the Company!', ['class' => 'btn btn-primary']) }}
            </form>
        </div>
    </div>
@endsection
