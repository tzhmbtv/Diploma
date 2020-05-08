@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    <div class="container">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
        </div>
        <div class="main col-sm col-md col-lg col-xl">
            <div>
                {{$company->official_name}}
                {{$company->short_name}}
                {{$company->id}}
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Address</th>
                    </tr>
                    @foreach ($company->offices as $office)
                        <tr>
                            <td>{{$office->id }}</td>
                            <td>{{ $office->full_address }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
