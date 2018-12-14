@extends('layouts.layout')
@section('title', 'Webzey')
@section('content')


    <div style="margin-top: 0px"><img src="{{ asset('img/logo-blog.png') }}" style="width: 100%; height: 400px"></div>
    <p style="position: absolute; top: 345px; left: 30px;color: #FFFFFF"><b style="font-size: 20px">GROUP EDIT</b> <br> <b style="margin-left: 15px;font-size: 14px;color: {{ $rank->color }} ">{{ $rank->name }}</b></p>
    <div style="float: left;font-size: 12px; border: 1px solid #ddd; background-color: #FFFFFF; width: 100%; text-align: center">
        <a style="color: #3d4852" href="/user/settings"><div style="float: left; margin-left: 0px; width: 75px; background-color: #FFFFFF; padding: 10px"><i class="fa fa-undo"></i></div></a>
    </div>
    @if ($errors->any())
        <div id="error" style="position: fixed; width: 200px; height: auto; right: 60px; top: 60px; z-index: 1001"; class="alert alert-danger">
            <b>Oeps... er ging iets fout!</b>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
        <div class="webzey-setting-group-users">
            <div class="webzey-setting-create-menu-hide"><b>USERS</b> <b style="font-size: 7px;color: {{ $rank->color }}">{{ $rank->name }}</b></div>
            <div style="height: auto; background-color: #FFFFFF; border: 1px solid #ddd">
                <br>
                <p>
                    @foreach($rank->users as $ranks)
                        <a style="color: #3d4852" href="/user/profile/{{ $ranks->id }}/{{ $ranks->name }}"><i style="margin-left: 10px" class="fa fa-user-o"></i> {{ $ranks->name }} <br></a>
                    @endforeach
                </p>
            </div>
        </div>

        <div class="webzey-setting-group-permissions">
            <div class="webzey-setting-create-menu-hide"><b>SETTINGS</b>
                @permission('groep-verwijderen')
                    <a onclick="webzey_group_delete_open()" id="delete-group"><i style="float: right; margin-right: 25px; font-size: 14px" class="fa fa-ban"></i><b style="float: right; margin-right: 10px">VERWIJDER</b></a>
                @endpermission
            </div>
            @permission('groep-aanpassen')
            <div style="height: auto; background-color: #FFFFFF; border: 1px solid #ddd">
                <form action="/submit-group-settings" method="post">
                    <br>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">RANK KLEUR</b> <input name="color" value="{{ $rank->color }}" type="color" style="margin-right: 10%; float: right;padding: 5px; width: 30px; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px"><p style="font-size: 10px; max-width: 70%; margin-left: 11%">Met deze optie kan jij de kleur van de rank aanpassen. <br>Deze kleur zou dan overal te zien zijn waar de rank getoond wordt.</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">GETOONDE NAAM</b><input name="display-name" value="{{ $rank->display_name }}" type="text" placeholder="Getoonde naam" style="margin-right: 5%; float: right;padding: 5px; width: 10%; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px"><p style="font-size: 10px; max-width: 70%; margin-left: 11%">Met deze optie kan jij de display naam van een rank aanpassen. <br> Let wel op dat de ranknaam hetzelfde blijft.</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">GROEP NAAM</b><input name="groep-name" value="{{ $rank->name }}" type="text" placeholder="Groep naam" style="margin-right: 5%; float: right;padding: 5px; width: 10%; margin-left: 5%; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px"><p style="font-size: 10px; max-width: 70%; margin-left: 11%">Met deze optie kan jij de naam van een rank aanpassen.<br></p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">GEBRUIKERS GROEP AANPASSEN</b>
                    <label style="float: right; margin-right: 10%"  class="switch">
                        <input type="checkbox" name="permission_1" @if(in_array(1, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px; max-width: 70%; margin-left: 11%">Je kunt met deze permission de groepen van andere accounts weghalen of toevoegen.</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">GEBRUIKERS INFORMATIE AANPASSEN</b><label style="float: right; margin-right: 10%" class="switch">
                        <input type="checkbox" name="permission_2" @if(in_array(2, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px; max-width: 70%; margin-left: 11%">Je kunt met deze permission de informatie van andere accounts veranden of toevoegen.</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">GEBRUIKERS VERWIJDERN</b><label style="float: right; margin-right: 10%" class="switch">
                        <input type="checkbox" name="permission_3" @if(in_array(3, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px; max-width: 70%; margin-left: 11%">Je kunt met deze permission gebruikers van de website verwijderen. </p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">BERICHTEN VERWIJDEREN</b><label style="float: right; margin-right: 10%" class="switch">
                        <input type="checkbox" name="permission_4" @if(in_array(4, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px; max-width: 70%; margin-left: 11%">Je kunt met deze permission berichten van andere gebruikers verwijderen</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">BERICHTEN AANPASSEN</b><label style="float: right; margin-right: 10%" class="switch">
                        <input type="checkbox" name="permission_5" @if(in_array(5, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px; max-width: 70%; margin-left: 11%">Je kunt met deze permission berichten van andere gebruikers aanpassen.</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">TOEGANG TOT ADMINISTRATIE</b><label style="float: right; margin-right: 10%" class="switch">
                        <input type="checkbox" name="permission_6" @if(in_array(6, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px; max-width: 70%; margin-left: 11%">Met deze permission heb je toegang tot het administratie paneel.</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">GROEP AANMAKEN</b><label style="float: right; margin-right: 10%" class="switch">
                        <input type="checkbox" name="permission_7" @if(in_array(7, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px; max-width: 70%; margin-left: 11%">Je kunt met deze permission een groep aanmaken.</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">GROEP AANPASSEN</b><label style="float: right; margin-right: 10%" class="switch">
                        <input type="checkbox" name="permission_8" @if(in_array(8, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px; max-width: 70%; margin-left: 11%">Je kunt met deze permission de permissions van een groep aanpassen.</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">GROEP VERWIJDEREN</b><label style="float: right; margin-right: 10%" class="switch">
                        <input type="checkbox" name="permission_9" @if(in_array(9, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px;max-width: 70%; margin-left: 11%">Je kunt met deze permission kan je bestaande groepen verwijderen.</p>
                    <b style="font-size: 12px; max-width: 70%; margin-left: 10%">PERMISSION AANMAKEN</b><label style="float: right; margin-right: 10%" class="switch">
                        <input type="checkbox" name="permission_10" @if(in_array(10, $permission)) checked @endif>
                        <span class="slider round"></span>
                    </label>
                    <p style="font-size: 10px;max-width: 70%; margin-left: 11%">Je kunt met deze permission permissions aanmaken.</p>
                    @csrf
                    <input type="hidden" name="id" value="{{ $rank->id }}">
                    <button type="submit" style="margin-left: 10%; margin-bottom: 25px; text-align: center; width: 80%; padding: 5px; background-color: #3f9ae5"><i class="fa fa-floppy-o"></i> Opslaan</button>
                </form>
            </div>
                @else
                <div style="height: auto; background-color: #FFFFFF; border: 1px solid #ddd">
                    <p style="font-size: 13px;margin-left: 25px; margin-top: 20px"><i style="color: #c51f1a" class="fa fa-exclamation-triangle"></i> <b>JE HEBT HIER GEEN TOESTEMMING VOOR!</b></p>
                </div>
            @endpermission
        </div>
    @permission('groep-verwijderen')
    <div id="webzey-group-verwijderen" style="display: none">
        <div style="background-color: #3d4852; width: 100%; height: 100%; position: fixed; top: 0px;z-index: 10; opacity: 0.9"></div>
        <div style="text-align: center; display: block; width: 60%; margin-left: 20%; height: 100px; background-color: #FFFFFF; border: 1px solid #ddd; position: fixed; z-index: 10; ">
            <a><br><b>Weet jij zeker dat je deze rank wilt verwijderen?</b><br><b onclick="webzey_group_delete_submit()" style="color: #5cd08d">JA</b><b style="color: #636b6f"> | </b><b onclick="webzey_group_delete_close()" style="color: #e9605c">NEE</b></a>
            <form id="webzey-submit" action="/submit-delete-group" method="POST" style="display: none;">
                <input type="hidden" value="{{ $rank->id }}" name="rank-id">
                @csrf
            </form>
            <script>
                function webzey_group_delete_open() {
                    document.getElementById('webzey-group-verwijderen').style.display = 'block';
                }
                function webzey_group_delete_submit() {
                    document.getElementById('webzey-submit').submit();
                }
                function webzey_group_delete_close() {
                    document.getElementById('webzey-group-verwijderen').style.display = 'none';
                }
            </script>
        </div>
    </div>
    @endpermission

@endsection