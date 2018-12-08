@extends('layouts.layout')
@section('title', 'Webzey')
@section('content')
    <div style="margin-top: 0px"><img src="{{ asset('img/logo-blog.png') }}" style="width: 100%; height: 400px"></div>
    <p style="position: absolute; top: 345px; left: 30px;color: #FFFFFF"><b style="font-size: 20px">SEARCH</b></p>
    <div style="float: left;font-size: 12px; border: 1px solid #ddd; background-color: #FFFFFF; width: 100%; text-align: center">
        <a style="color: #3d4852" href="javascript:history.go(-1)"><div style="float: left; margin-left: 0px; width: 75px; background-color: #FFFFFF; padding: 10px"><i class="fa fa-undo"></i></div></a>
    </div>
    @if($users->count() > 0)
    <div class="webzey-search-users" style="width: 40%; float: left; margin-left: 6%; margin-top: 50px; background-color: white; border: 1px solid #ddd">
        <div class="webzey-setting-create-menu-hide"><b>USERS</b></div>
        @foreach ($users as $user)
            <div style="border: 1px solid #ddd; width: 100%; height: 60px">
                <p style="font-size: 14px; margin-top: 15px; color: #3d4852"><b style="float: left; margin-left: 15px"><i class="fa fa-bandcamp"></i> {{ $user->name }}</b> <a href="/user/profile/{{ $user->id }}/{{ $user->name }}" style="float: right; margin-right: 15px">Bekijk profiel</a></p>
            </div>
        @endforeach
    </div>
    @else
        <div class="webzey-search-posts" style="width: 40%; float: left; margin-left: 8%; margin-top: 50px; background-color: white; border: 1px solid #ddd; height: auto">
            <div class="webzey-setting-create-menu-hide"><b>USERS</b></div>
            <p style="margin-top: 10px; margin-left: 10px">Geen resultaten</p>
        </div>
    @endif
    @if($posts->count() > 0)
    <div class="webzey-search-posts" style="width: 40%; float: left; margin-left: 8%; margin-top: 50px; background-color: white; border: 1px solid #ddd; height: auto">
        <div class="webzey-setting-create-menu-hide"><b>POSTS</b></div>
        @foreach ($posts as $post)
            <div style="border: 1px solid #ddd; width: 100%; height: 60px">
                <p style="font-size: 14px; margin-top: 15px; color: #3d4852"><b style="float: left; margin-left: 15px"><i class="fa fa-bandcamp"></i> {{ $post->title }}</b> <a style="margin-left: 10px"> by: {{ $post->user->name }} </a><a href="/post/view/{{ $post->slug}}" style="float: right; margin-right: 15px">Bekijk bericht</a></p>
            </div>
        @endforeach
    </div>
        @else
        <div class="webzey-search-posts" style="width: 40%; float: left; margin-left: 8%; margin-top: 50px; background-color: white; border: 1px solid #ddd; height: auto">
            <div class="webzey-setting-create-menu-hide"><b>POSTS</b></div>
            <p style="margin-top: 10px; margin-left: 10px">Geen resultaten</p>
        </div>
    @endif



@endsection