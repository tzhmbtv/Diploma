<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="sidenav">
    <a href="{{ url('/home') }}"><img src="/img/home.png" width="35" height="35">Home</a>
    <a href="{{ url('/history') }}"><img src="/img/history.png" width="35" height="35">History</a>
    <a href="{{ url('/team') }}"><img src="/img/team.png" width="35" height="35">Team</a>
    <a href="{{ route('companies.index') }}"><img src="/img/company.png" width="35" height="35">Companies</a>
</div>
</body>
</html>
