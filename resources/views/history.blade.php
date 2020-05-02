@extends('layouts.app')
@extends('layouts.sidenav')

@section('content')
    <div class="container" style="margin-right: auto; margin-left:auto;">
        <div class="main_history">
            <div class="visit_title">
                <p><span>V</span>isit history</p>
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
