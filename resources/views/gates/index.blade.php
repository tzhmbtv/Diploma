@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container">
        <a class="btn btn-success" href="{{ route('gates.create') }}"> Create New Company</a>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Full Address</th>
                <th>Company</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($gates as $gate)
                <tr>
                    <td>{{ $gate->id }}</td>
                    <td>{{ $gate->name }}</td>
                    <td>{{ $gate->office->full_address }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('gates.show',$gate->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('gates.edit',$gate->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
