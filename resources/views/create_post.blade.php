
@extends('layouts.layout')
@section('title', 'Webzey')
@section('content')
    <head>
        <meta charset="utf-8">
    </head>
    @if ($errors->any())
        <div id="error" style="position: fixed; width: 200px; height: auto; right: 60px; top: 60px; z-index: 1001"; class="alert alert-danger">
            <b>Oeps... er ging iets fout!</b>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
        </div>
        @endif
        <script>
            setTimeout(
                function() {
                    document.getElementById('error').style.display = "none";
                }, 6000);
        </script>

    <div style="margin-top: 0px"><img src="{{ asset('img/logo-blog.png') }}" style="width: 100%; height: 400px"></div>
    <div style="float: left;font-size: 12px; border: 1px solid #ddd; background-color: #FFFFFF; width: 100%; text-align: center">
        <a style="color: #3d4852" href="javascript:history.go(-1)"><div style="float: left; margin-left: 0px; width: 75px; background-color: #FFFFFF; padding: 10px"><i class="fa fa-undo"></i></div></a>
        <a style="color: #3d4852"><div style="float: left; margin-left: 0px; width: auto; background-color: #FFFFFF; padding: 10px"><i class="fa fa-window-maximize"></i> <b>Webzey</b> / Dashboard / Overzicht / Post aanmaken </div></a>
    </div>
    <link rel='stylesheet' href='{{ asset('css/webzey.css') }}'>
    <div style="text-align: center; color: #4b5462; float: right; margin-left: 5%" class="webzey-rights-search">
        <form action="/webzey-search" method="post">
            <b><i class="fa fa-search"></i> Zoeken</b><hr>
            <input style="width: 80%;" type="text" name="search" placeholder="Zoeken..."><br><br>
            @csrf
            <button type="submit"; style="width: 80%">Zoeken</button>
        </form>
    </div>      @guest
            <div style="margin-bottom: 25px" class="webzey-message-block">
            <p style="margin-left: 25px; margin-right: 25px">Je moet ingelogd zijn om te kunnen reageren. Klik <a href="{{ route('home') }}">hier</a> om in te loggen. </p>
            </div>
        @else
            <script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
            <script>
                tinymce.init({
                    selector: '#mytextarea'
                });
            </script>
            <form method="post" action="/submit-post">
            <div style="margin-bottom: 25px" class="webzey-message-block">
                <input type="text" name="title" placeholder="Titel" style="width: 100%; border: 1px solid #ddd; padding: 5px">
            </div>
            <div style="margin-bottom: 25px" class="webzey-message-block">
                <textarea style="height: 350px" name="message" id="mytextarea"></textarea>
                @csrf
                <button type="submit" class="webzey-send-button fa fa-paper-plane" style="position: absolute; top: 330px"></button>
            </div>
            </form>
        @endguest


@endsection

