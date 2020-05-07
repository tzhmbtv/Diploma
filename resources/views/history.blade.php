@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    <div class="container">
        <div class="main col-sm col-md col-lg col-xl">
            <div class="visit_title">
                <h1><span>V</span>isit history</h1>
            </div>
            <div class="clear_btn">
                <button type="submit" class="btn btn-primary">Clear</button>
            </div>
            <div class="table">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Plate Number</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>Ячейка 3</td>
                        <td>Ячейка 4</td>
                        <td>Ячейка 3</td>
                        <td>Ячейка 4</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
