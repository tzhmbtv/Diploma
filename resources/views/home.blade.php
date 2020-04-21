@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <div class="sidenav">
        <a href="index.html"><img src="img/home.png" width="35" height="35">Home</a>
        <a href="history.html"><img src="img/history.png" width="35" height="35">History</a>
        <a href="#team"><img src="img/team.png" width="35" height="35">Team</a>
        <a href="#functions"><img src="img/functions.png" width="35" height="35">Functions</a>
        <a href="#settings"><img src="img/settings.png" width="35" height="35">Settings</a>
    </div>
    <div class="header">
        <div class="logo"><img src="img/logo.png" width="400"></div>
        <div class="logout_btn">
            <button>Log out</button>
        </div>
    </div>
    <div class="main">
        <div class="container">
            <div>
                <div class="btns">
                    <img src="http://10.136.143.219/live"/>
                    <button>Turn on camera</button>
                    <button>Check number</button>
                </div>
            </div>
        </div>
    </div>
@endsection
