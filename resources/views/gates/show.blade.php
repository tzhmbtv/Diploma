@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    <div class="container">
        <div class="main col-sm col-md col-lg col-xl">
            <div class="show_title_gates">
                <h4>
                    <!-- {{$gate->id}} -->
                    {{$gate->name}} -
                    {{$gate->office->full_address}}
                </h4>
                <a class="btn btn-primary" href="{{ route('gates.create') }}">Create Gate</a>
            </div>
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Plate Number</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($gate->cars as $car)
                    <tr>
                        <td>{{$car->id }}</td>
                        <td>{{ $car->plate_number }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('cars.show',$car->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('cars.edit',$car->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
