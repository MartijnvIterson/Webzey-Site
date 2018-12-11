
@extends('layouts.layout')
@section('title', 'Webzey')
@section('content')
    <head>
        <meta charset="utf-8">
    </head>
    <div style="margin-top: 0px"><img src="{{ asset('img/logo-blog.png') }}" style="width: 100%; height: 400px"></div>
    <div style="float: left;font-size: 12px; border: 1px solid #ddd; background-color: #FFFFFF; width: 100%; text-align: center">
        <a style="color: #3d4852" href="javascript:history.go(-1)"><div style="float: left; margin-left: 0px; width: 75px; background-color: #FFFFFF; padding: 10px"><i class="fa fa-undo"></i></div></a>
        <a style="color: #3d4852"><div style="float: left; margin-left: 0px; width: auto; background-color: #FFFFFF; padding: 10px"><i class="fa fa-window-maximize"></i> <b>Webzey</b> / Posts / View / {{ $post->title }}</div></a>
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
    <div style="color: #4b5462;" class="webzey-post-block">
        <b style='margin-left: 25px'> {{ $post->title }}</b> <hr>
        <div style='margin-left: 25px; margin-right: 25px; font-size: 14px; color: #818181'> {!! $post->message !!}</div>
        <p style='margin-left: 25px'><a style="color:#3d4852;" href="/user/profile/{{ $post->user->id }}/{{ $post->user->name }}">{{ $post->user->name }}</a>  <a style="float: right; margin-right: 25px; font-size: 8px; color: #636b6f">{{ $post->created_at }}</a>
            @auth @if(Auth::user()->id == $post->user->id)
                <a style="color: #3d4852; float: right; font-size: 8px; margin-right: 20px;" href="/delete-post/{{ $post->slug }}">Verwijderen</a>
                      @else
                @permission('berichten-verwijderen')
                <a style="color: #3d4852; float: right; font-size: 8px; margin-right: 20px;" href="/delete-post/{{ $post->slug }}">Verwijderen</a>
                @endpermission
        @endif @endauth
        </p>
    </div>
    @foreach($post->comments as $comment)
    <div style="margin-bottom: 25px" class="webzey-reaction-block">
            <div style="margin-left: 25px; margin-right: 25px">
                <p style='margin-left: 25px; margin-right: 25px; font-size: 14px; color: #818181'>
                {!! $comment->message  !!}
             </p></div>
        <p style='margin-left: 25px'><a style="color:#3d4852;" href="/user/profile/{{ $comment->user->id }}/{{ $comment->user->name }}">{{ $comment->user->name }}  </a>   <a style="float: right; margin-right: 25px; font-size: 8px; color: #636b6f">{{ $comment->created_at }}</a>
            @auth @if(Auth::user()->id == $comment->user->id)
                <a style="color: #3d4852; float: right; font-size: 8px; margin-right: 20px;" href="/delete-comment/{{ $comment->id }}">Verwijderen</a>
                      @else
                @permission('berichten-verwijderen')
                <a style="color: #3d4852; float: right; font-size: 8px; margin-right: 20px;" href="/delete-comment/{{ $comment->id }}">Verwijderen</a>
                @endpermission
            @endif @endauth

        </p>
    </div>
    @endforeach
    <div style="margin-bottom: 25px" class="webzey-message-block">
        @guest
            <p style="padding-top: 20px; margin-left: 25px; margin-right: 25px">Je moet ingelogd zijn om te kunnen reageren. Klik <a href="{{ route('home') }}">hier</a> om in te loggen. </p>
        @else
        <script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
        <script>
            tinymce.init({
                selector: '#mytextarea'
            });
        </script>

        <form method="post" action="/submit-comment">

            <textarea style="height: 350px" name="message" id="mytextarea"></textarea>
            @csrf
            <input type="hidden" name="thread" value="{{ $post->id }}">
            <input type="hidden" name="link" value="{{ $post->slug }}">
            <button type="submit" class="webzey-send-button fa fa-paper-plane" style="position: absolute; top: 330px"></button>
        </form>
        @endguest
    </div>


@endsection

