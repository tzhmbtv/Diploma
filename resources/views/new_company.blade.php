@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
<div class="container">
    <div class="main col-sm col-md col-lg col-xl">
        <div class="title_company">
            <h2>Create new company</h2>
        </div>
    <div class="company_form">
            <div class="form-group row">
                <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Company name') }}</label>
                <div class="col-md-6">
                    <input id="company_name" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                <div class="col-md-6">
                    <input id="address" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Gate') }}</label>
                <div class="col-md-6">
                    <input id="gate" type="text" class="form-control">
                </div>
            </div>
            </div>
            <div class="btns_company">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
    </div>
</div>
@endsection