@extends('layouts.layout')
@section('title', 'Webzey')
@section('content')
    <div style="margin-top: 0px"><img src="{{ asset('img/logo-blog.png') }}" style="width: 100%; height: 400px"></div>
    <p style="position: absolute; top: 345px; left: 30px;color: #FFFFFF"><b style="font-size: 20px">GROUPS</b></p>
    <div style="float: left;font-size: 12px; border: 1px solid #ddd; background-color: #FFFFFF; width: 100%; text-align: center">
        <a style="color: #3d4852" href="javascript:history.go(-1)"><div style="float: left; margin-left: 0px; width: 75px; background-color: #FFFFFF; padding: 10px"><i class="fa fa-undo"></i></div></a>
    </div>
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
    @permission('toegang-administratie')

    <div class="webzey-setting-create-menu">
        <div class="webzey-setting-create-menu-hide"><b>GROEP AANMAKEN</b><i style="float: right; margin-right: 5px; font-size: 16px" class="fa fa-angle-down"></i></div>
    <div class="webzey-setting-group">
        @permission('groep-aanmaken')

        <form method="post" action="/create-role">
            <input type="text" placeholder="Groep naam" name="name" style="padding: 5px; width: 90%; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px">
            <input type="text" placeholder="Getoonde naam" name="display_name" style="padding: 5px; width: 90%; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px">
            <input type="text" placeholder="Beschrijving" name="description" style="padding: 5px; width: 90%; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px">
            <input type="color" placeholder="#ffffff" name="color" style="padding: 5px; width: 90%; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px">
            @csrf
            <button type="submit" style="padding: 5px; background: #3d4852; width: 90%; margin-left: 5%; margin-top: 10px; border-radius: 5px">Groep aanmaken</button>
        </form>
        @else
            <p style="font-size: 13px;margin-left: 20px;margin-right: 10px; margin-top: 20px"><i style="color: #c51f1a" class="fa fa-exclamation-triangle"></i> <b>JIJ HEBT HIER GEEN TOESTEMMING VOOR!</b></p>
        @endpermission
    </div>
        <div class="webzey-setting-create-menu-hide"><b>PERMISSION AANMAKEN</b><i style="float: right; margin-right: 5px; font-size: 16px" class="fa fa-angle-down"></i></div>
    <div class="webzey-setting-group">
        @permission('permission-aanmaken')
        <form method="post" action="/create-perm">
            <input type="text" placeholder="Permission naam" name="name" style="padding: 5px; width: 90%; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px">
            <input type="text" placeholder="Getoonde naam" name="display_name" style="padding: 5px; width: 90%; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px">
            <input type="text" placeholder="Beschrijving" name="description" style="padding: 5px; width: 90%; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px">
            @csrf
            <button type="submit" style="padding: 5px; background: #3d4852; width: 90%; margin-left: 5%; margin-top: 10px; border-radius: 5px">Permission aanmaken</button>
        </form>
        @else
        <p style="font-size: 13px;margin-left: 20px;margin-right: 10px; margin-top: 20px"><i style="color: #c51f1a" class="fa fa-exclamation-triangle"></i> <b>JIJ HEBT HIER GEEN TOESTEMMING VOOR!</b></p>
        @endpermission
    </div>
    </div>

    <div class="webzey-setting-main">
        @foreach($ranks as $rank)
        <a style="color: #3d4852" href="/user/edit/rank/{{ $rank->name }}"><div class="webzey-setting-rank-block"><div style="position: absolute; right: -3px; top: -15px; width: 15px; height: 15px; font-size: 30px; color: {{ $rank->color }}"><i class="fa fa-bookmark"></i></div><b style="font-size: 12px; margin-left: 5px">{{ $rank->display_name }}</b><hr><p style="font-size: 10px; margin-left: 5px">{{ $rank->description }}</p><hr>@foreach($rank->users as $user) <p style="margin-left: 15px;font-size: 10px"><i class="fa fa-user-o "></i> {{ $user->name }}</p> @endforeach</div></a>
        @endforeach
    </div>
    @else
        <p style="text-align: center; font-size: 13px; margin-top: 200px"><i style="color: #c51f1a" class="fa fa-exclamation-triangle"></i> <b>JIJ HEBT GEEN TOESTEMMING OM DEZE PAGINA TE BEKIJKEN!</b></p>
    @endpermission
@endsection