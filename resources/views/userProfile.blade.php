@extends('layouts.layout')
@section('title', 'Webzey')
@section('content')


    <div style="margin-top: 0px"><img src="{{ asset('img/logo-blog.png') }}" style="width: 100%; height: 400px"></div>
    <p style="position: absolute; top: 345px; left: 30px;color: #FFFFFF"><b style="font-size: 20px">{{ $user->name }}</b> <br> </p>
    <div style="float: left;font-size: 12px; border: 1px solid #ddd; background-color: #FFFFFF; width: 100%; text-align: center">
        <a style="color: #3d4852" href="/user/settings"><div style="float: left; margin-left: 0px; width: 75px; background-color: #FFFFFF; padding: 10px"><i class="fa fa-undo"></i></div></a>
        <a style="color: #3d4852" href=""><div style="float: left; margin-left: 0px; width: 100px; background-color: #FFFFFF; padding: 10px"><i class="fa fa-info"></i> Informatie</div></a>
        <a style="color: #3d4852" href=""><div style="float: left; margin-left: 0px; width: 100px; background-color: #FFFFFF; padding: 10px"><i class="fa fa-sliders"></i> Instellingen</div></a>
    </div>
    @if ($errors->any())
        <div id="error" style="position: fixed; width: 200px; height: auto; right: 60px; top: 60px; z-index: 1001"; class="alert alert-danger">
            <b>Oeps... er ging iets fout!</b>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
@permission('gebruiker-groep-aanpassen')
    <div class="webzey-user-profile">
        <div class="webzey-setting-create-menu-hide"><b>GROEP INSTELLINGEN</b></div>
        <br>
        <div><form action="/save-user-group" method="post"> @foreach($roles as $item) @if(in_array($item->id, $role))

                <b style="font-size: 12px; max-width: 70%; margin-left: 10%">{{ $item->Rolename }}</b><label style="float: right; margin-right: 10%" class="switch">
                    <input type="checkbox" name="{{ $item->id }}" checked>
                    <span class="slider round"></span>
                </label>
                <p style="font-size: 10px; max-width: 70%; margin-left: 11%">{{ $item->description }}</p>
        @else
                <b style="font-size: 12px; max-width: 70%; margin-left: 10%">{{ $item->Rolename }}</b><label style="float: right; margin-right: 10%" class="switch">
                    <input type="checkbox" name="{{ $item->id }}">
                    <span class="slider round"></span>
                </label>
                <p style="font-size: 10px; max-width: 70%; margin-left: 11%">{{ $item->description }}</p>

        @endif @endforeach <input type="hidden" name="user" value="{{ $user->id }}"> @csrf <button type="submit" style="margin-left: 10%; margin-bottom: 25px; text-align: center; width: 80%; padding: 5px; background-color: #3f9ae5"><i class="fa fa-floppy-o"></i> Opslaan</button></form></div>

    </div>
@endpermission
@permission('gebruiker-aanpassen')
    <div class="webzey-user-profile">
        <div class="webzey-setting-create-menu-hide"><b>GEBRUIKER INSTELLINGEN</b></div>
        <div>
            <form method="post" action="/change-user">
                <br>
                <b style="font-size: 12px; max-width: 60%; margin-left: 5%">NAAM AANPASSEN</b>
                <input style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; float: right; margin-right: 25px" type="text" value="{{ $user->name }}" name="user-name">
                <p style="font-size: 10px; max-width: 60%; margin-left: 6%">Vul hier de nieuwe naam in.</p>

                <b style="font-size: 12px; max-width: 60%; margin-left: 5%">EMAIL AANPASSEN</b>
                <input style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; float: right; margin-right: 25px" type="text" value="{{ $user->email }}" name="user-email">
                <p style="font-size: 10px; max-width: 60%; margin-left: 6%">Vul hier het nieuwe email adres in.</p>
                <input type="hidden" name="user-id" value="{{ $user->id }}">
                @csrf
                <button type="submit" style="margin-left: 5%; margin-bottom: 25px; text-align: center; width: 90%; padding: 5px; background-color: #3f9ae5"><i class="fa fa-floppy-o"></i> Opslaan</button>

            </form>
        </div>
    </div>

    <div class="webzey-user-profile">
        <div class="webzey-setting-create-menu-hide"><b>WACHTWOORD INSTELLINGEN</b></div>
        <div>
            <br>
            <form method="post" action="/change-password">
                <b style="font-size: 12px; max-width: 60%; margin-left: 5%">WACHTWOORD AANPASSEN</b>
                <input style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; float: right; margin-right: 25px" name="user-password" type="password" placeholder="Nieuw wachtwoord">
                <p style="font-size: 10px; max-width: 60%; margin-left: 6%">Vul hier het nieuwe wachtwoord in.</p>
                @csrf
                <input type="hidden" name="user-id" value="{{ $user->id }}">
                <button type="submit" style="margin-left: 5%; margin-bottom: 25px; text-align: center; width: 90%; padding: 5px; background-color: #3f9ae5"><i class="fa fa-floppy-o"></i> Opslaan</button>
            </form>
        </div>
    </div>
    @else
        <div class="webzey-user-profile" style="margin-left: 5%; float: left; width: 42%; border: 1px solid #ddd; background-color: #FFFFFF; margin-top: 50px; height: auto">
            <div class="webzey-setting-create-menu-hide"><b>USER INSTELLINGEN</b></div>
            <div>
                <form>
                    <br>
                    <b style="font-size: 12px; max-width: 60%; margin-left: 5%">NAAM AANPASSEN</b>
                    <input style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; float: right; margin-right: 25px" type="text" value="{{ $user->name }}" disabled>
                    <p style="font-size: 10px; max-width: 60%; margin-left: 6%">Hier kun jij jouw naam aanpassen.</p>

                    <b style="font-size: 12px; max-width: 60%; margin-left: 5%">EMAIL AANPASSEN</b>
                    <input style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; float: right; margin-right: 25px" type="text" value="{{ $user->email }}" disabled>
                    <p style="font-size: 10px; max-width: 60%; margin-left: 6%">Hier kun jij jouw email aanpassen.</p>
                </form>
                <form method="post" action="/reset-password">
                    <b style="font-size: 12px; max-width: 60%; margin-left: 5%">WACHTWOORD NIEUW</b>
                    <input style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; float: right; margin-right: 25px" name="new-password-0" type="password" placeholder="Nieuw wachtwoord">
                    <p style="font-size: 10px; max-width: 60%; margin-left: 6%">Vul hier jouw nieuwe wachtwoord in.</p>

                    <b style="font-size: 12px; max-width: 60%; margin-left: 5%">WACHTWOORD NIEUW</b>
                    <input style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; float: right; margin-right: 25px" name="new-password-1" type="password" placeholder="Nieuw wachtwoord">
                    <p style="font-size: 10px; max-width: 60%; margin-left: 6%">Vul hier jouw nieuwe wachtwoord in.</p>

                    <b style="font-size: 12px; max-width: 60%; margin-left: 5%">WACHTWOORD OUD</b>
                    <input style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; float: right; margin-right: 25px" name="old-password-0" type="password" placeholder="Oud wachtwoord">
                    <p style="font-size: 10px; max-width: 60%; margin-left: 6%">Vul hier jouw oude wachtwoord in.</p>
                    @csrf
                    <button type="submit" style="margin-left: 5%; margin-bottom: 25px; text-align: center; width: 90%; padding: 5px; background-color: #3f9ae5"><i class="fa fa-floppy-o"></i> Opslaan</button>
                </form>
            </div>
        </div>
@endpermission





@endsection