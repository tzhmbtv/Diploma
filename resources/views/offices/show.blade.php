@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    <div class="container">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('offices.index') }}"> Back</a>
        </div>
        <div class="main col-sm col-md col-lg col-xl">
            <div>
                {{$office->id}}
                {{$office->full_address}}
                {{$office->company->official_name}}
                <a class="btn btn-info" href="{{ route('gates.create') }}">Create Gate</a>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Hash of MAC of client</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($office->gates as $gate)
                        <tr>
                            <td>{{$gate->id }}</td>
                            <td>{{ $gate->name }}</td>
                            <td>{{ $gate->client_hash }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('gates.show',$gate->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('gates.edit',$gate->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
