
@extends('layouts.layout')
@section('title', 'Webzey')
@section('content')
    <head>
        <meta charset="utf-8">
    </head>
    <div style="margin-top: 0px"><img src="{{ asset('img/logo-blog.png') }}" style="width: 100%; height: 400px"></div>
    <div style="float: left;font-size: 12px; border: 1px solid #ddd; background-color: #FFFFFF; width: 100%; text-align: center">
        <a style="color: #3d4852" href="javascript:history.go(-1)"><div style="float: left; margin-left: 0px; width: 75px; background-color: #FFFFFF; padding: 10px"><i class="fa fa-undo"></i></div></a>
        <a style="color: #3d4852"><div style="float: left; margin-left: 0px; width: auto; background-color: #FFFFFF; padding: 10px"><i class="fa fa-window-maximize"></i> <b>Webzey</b> / Dashboard / Overzicht </div></a>
        <a style="color: #3d4852" href="/post/create"><div style="float: left; margin-left: 0px; width: auto; background-color: #FFFFFF; padding: 10px"><i>Post aanmaken</i> </div></a>

    </div>
    <link rel='stylesheet' href='{{ asset('css/webzey.css') }}'>
    <div style="text-align: center; color: #4b5462; float: right; margin-left: 5%" class="webzey-rights-search">
        <form action="/webzey-search" method="post">
            <b><i class="fa fa-search"></i> Zoeken</b><hr>
            <input style="width: 80%;" type="text" name="search" placeholder="Zoeken..."><br><br>
            @csrf
            <button type="submit"; style="width: 80%">Zoeken</button>
        </form>
    </div>
    @foreach($threads as $thread)
        <div style="color: #4b5462;" class="webzey-post-block">
            <div class="webzey-dateblock">
                <div class="webzey-dateblock-up">
                    <b>{{ \App\Http\Controllers\PermController::dateMonth($thread->created_at) }}</b>
                </div>{{ \App\Http\Controllers\PermController::dateDay($thread->created_at) }}
            </div>
            <b style='margin-left: 25px'> {{ $thread->title }}</b>
            <hr>
            <div style='margin-left: 25px; margin-right: 25px; font-size: 14px'> {!! $thread->message !!}
            </div>
            <p style='margin-left: 25px'>{{ $thread->user->name }}</p>
            <a href="/post/view/{{ $thread->slug }}" style="color: #3d4852"><p style="float: right; margin-right: 25px">Bekijk bericht <i class="fa fa-comments"></i> </p></a>
        </div>

    @endforeach
@endsection

