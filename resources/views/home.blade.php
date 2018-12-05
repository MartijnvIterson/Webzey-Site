@extends('layouts.layout')
@section('title', 'Webzey')
@section('content')
    <link rel='stylesheet' href='{{ asset('css/webzey.css') }}'>
    <div style="text-align: center; color: #4b5462; float: right; margin-left: 5%; margin-top: 100px;" class="webzey-rights-search">
        <form action="/webzey-search" method="post">
            <b><i class="fa fa-search"></i> Zoeken</b><hr>
            <input style="width: 80%;" type="text" name="search" placeholder="Zoeken..."><br><br>
            @csrf
            <button type="submit"; style="width: 80%">Zoeken</button>
        </form>
    </div>
    <div style="margin-top: 110px" class="webzey-dashboard-block-1"><div class="webzey-dashboard-block-1-alert"><b style="color: white">1</b></div><i style="font-size: 35px" class="fa fa-inbox"></i> <p style="margin-left: 15px">Facturen</p></div>
    <div style="margin-top: 110px" class="webzey-dashboard-block-1">
        <div class="webzey-dashboard-block-1-alert">
            <b style="color: white">1</b>
        </div><i style="font-size: 35px" class="fa fa-tasks"></i>
        <p style="margin-left: 15px">Producten / Diensten</p>
    </div>
    <a href="/post/overzicht"><div style="margin-top: 110px; color: #3d4852" class="webzey-dashboard-block-1">
        <div class="webzey-dashboard-block-1-alert">
            <b style="color: white">1</b>
        </div><i style="font-size: 35px" class="fa fa-comments"></i>
        <p style="margin-left: 15px">Berichten</p>
    </div></a>
    <div class="webzey-dashboard-block-2">
        <p style="margin-left: 25px;">
            <b>Account Informatie</b>
        </p>
            <hr>
        <p style="margin-left: 25px">Naam: {{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
            <hr>
        <p style="margin-left: 25px">Email: {{ \Illuminate\Support\Facades\Auth::user()->email }}</p>
            <hr>
        <p style="margin-left: 25px">Door ons gestuurde e-mails <button style="background-color: #3d4852; float: right; margin-right: 10px; border-radius: 20px; height: auto; width: auto; padding-left: 10px; padding-right: 10px; padding-bottom: 2px; padding-top: 2px">Bekijk e-mails</button></p>
    </div>

@endsection
