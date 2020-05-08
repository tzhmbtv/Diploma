@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    <div class="container">
        <div class="main col-sm col-md col-lg col-xl">
            <div class="title_company">
                <h2>List of companies</h2>
                <a href="{{ url('/new_company') }}"><button type="submit" class="btn btn-primary">Create</button></a>
        </div>
            <div class="list_companies">
                <ul>
                    <dt><a href="{{ url('/company_info') }}">Company number 1</a>
                    <span><a href="{{ url('/edit_company') }}"><button type="submit" class="btn btn-primary">Edit</button></a></span>
                    </dt>
                    <dt><a href="{{ url('/company_info') }}">Company number 1</a>
                    <span><a href="{{ url('/edit_company') }}"><button type="submit" class="btn btn-primary">Edit</button></a></span>
                    </dt>
                    <dt><a href="{{ url('/company_info') }}">Company number 1</a>
                    <span><a href="{{ url('/edit_company') }}"><button type="submit" class="btn btn-primary">Edit</button></a></span>
                    </dt>
                    <dt><a href="{{ url('/company_info') }}">Company number 1</a>
                    <span><a href="{{ url('/edit_company') }}"><button type="submit" class="btn btn-primary">Edit</button></a></span>
                    </dt>
                    <dt><a href="{{ url('/company_info') }}">Company number 1</a>
                    <span><a href="{{ url('/edit_company') }}"><button type="submit" class="btn btn-primary">Edit</button></a></span>
                    </dt>
                </ul>
            </div>
        </div>
    </div>
@endsection
