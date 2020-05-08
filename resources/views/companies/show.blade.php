@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    <div class="container">
        <div class="main col-sm col-md col-lg col-xl">
        <!-- <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
        </div> -->
                <div class="show_title">
                    <h2>{{$company->official_name}}
                    </h2>
                    <a class="btn btn-primary" href="{{ route('offices.create') }}">Create office</a>
                </div>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($company->offices as $office)
                        <tr>
                            <td>{{$office->id }}</td>
                            <td>{{ $office->full_address }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('offices.show',$office->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('offices.edit',$office->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
    </div>
@endsection
