@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container">
        <a class="btn btn-success" href="{{ route('offices.create') }}"> Create New Company</a>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Full Address</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($offices as $office)
                <tr>
                    <td>{{ $office->id }}</td>
                    <td>{{ $office->full_address }}</td>
                    <td>{{ $office->company->full_name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('offices.show',$office->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('offices.edit',$office->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
