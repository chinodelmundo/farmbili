@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
                <div class = "row">
                    <div class = "col-md-6">
                        <div id = "register-consumer">
                        <img src="{{ asset('images/register-consumer.png') }}">
                        <button class="btn btn-primary btn-lg" id="buyer-btn" style="margin-top: 50px;width: 100%;">Register as Buyer</button>
                        </div>
                    </div>
                    <div class = "col-md-6">
                        <div id = "register-retailer">
                        <img src="{{ asset('images/register-retailer.png') }}">
                        <center>
                            <button class="btn btn-primary btn-lg" id="retailer-btn" style="margin-top: 50px; width: 100%;">Register as Retailer</button>
                        </center>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" id="buyer-panel" hidden>
                <div class="panel-heading">Register as Buyer</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"> Region </label>

                            <div class="col-md-6">
                                <select  class="form-control region-list" name="region" required>
                                    <option value="">Select Region</option>
                                    <option value="ARMM">ARMM</option>
                                    <option value="CAR">CAR</option>
                                    <option value="NCR">NCR</option>
                                    <option value="Region 1">Region 1</option>
                                    <option value="Region 2">Region 2</option>
                                    <option value="Region 3">Region 3</option>
                                    <option value="Region 4a">Region 4a</option>
                                    <option value="Region 4b">Region 4b</option>
                                    <option value="Region 5">Region 5</option>
                                    <option value="Region 6">Region 6</option>
                                    <option value="Region 7">Region 7</option>
                                    <option value="Region 8">Region 8</option>
                                    <option value="Region 9">Region 9</option>
                                    <option value="Region 10">Region 10</option>
                                    <option value="Region 11">Region 11</option>
                                    <option value="Region 12">Region 12</option>
                                    <option value="Region 13">Region 13</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"> Province </label>

                            <div class="col-md-6">
                                <select class="form-control province-list" name="province" required>
                                    <option value="">Select Province</option>
                                    <option class="region1" value="Illocos Norte">Illocos Norte</option>
                                    <option class="region1" value="Illocos Sur">Illocos Sur</option>
                                    <option class="region1" value="La Union">La Union</option>
                                    <option class="region1" value="Pangasinan">Pangasinan</option>
                                    <option class="region2" value="Batanes">Batanes</option>
                                    <option class="region2" value="Cagayan">Cagayan</option>
                                    <option class="region2" value="Isabela">Isabela</option>
                                    <option class="region2" value="Nueva Viscaya">Nueva Viscaya</option>
                                    <option class="region2" value="Quirino">Quirino</option>
                                    <option class="region3" value="Aurora">Aurora</option>
                                    <option class="region3" value="Bataan">Bataan</option>
                                    <option class="region3" value="Bulacan">Bulacan</option>
                                    <option class="region3" value="Nueva Ecija">Nueva Ecija</option>
                                    <option class="region3" value="Pampanga">Pampanga</option>
                                    <option class="region3" value="Tarlac">Tarlac</option>
                                    <option class="region3" value="Zambales">Zambales</option>
                                    <option class="region4a" value="Batangas">Batangas</option>
                                    <option class="region4a" value="Cavite">Cavite</option>
                                    <option class="region4a" value="Laguna">Laguna</option>
                                    <option class="region4a" value="Quezon">Quezon</option>
                                    <option class="region4a" value="Rizal">Rizal</option>
                                    <option class="region4b" value="Marinduque">Marinduque</option>
                                    <option class="region4b" value="Occidental Mindoro">Occidental Mindoro</option>
                                    <option class="region4b" value="Oriental Mindoro">Oriental Mindoro</option>
                                    <option class="region4b" value="Palawan">Palawan</option>
                                    <option class="region4b" value="Romblon">Romblon</option>
                                    <option class="region5" value="Albay">Albay</option>
                                    <option class="region5" value="Camarines Norte">Camarines Norte</option>
                                    <option class="region5" value="Camarines Sur">Camarines Sur</option>
                                    <option class="region5" value="Catanduanes">Catanduanes</option>
                                    <option class="region5" value="Masbate">Masbate</option>
                                    <option class="region5" value="Sorsogon">Sorsogon</option>
                                    <option class="region6" value="Aklan">Aklan</option>
                                    <option class="region6" value="Antique">Antique</option>
                                    <option class="region6" value="Capiz">Capiz</option>
                                    <option class="region6" value="Iloilo">Iloilo</option>
                                    <option class="region6" value="Guimaras">Guimaras</option>
                                    <option class="region6" value="Negros Occidental">Negros Occidental</option>
                                    <option class="region7" value="Bohol">Bohol</option>
                                    <option class="region7" value="Cebu">Cebu</option>
                                    <option class="region7" value="Guimaras">Guimaras</option>
                                    <option class="region7" value="Negro Oriental">Negro Oriental</option>
                                    <option class="region7" value="Siquijor">Siquijor</option>
                                    <option class="region8" value="Biliran">Biliran</option>
                                    <option class="region8" value="Eastern Samar">Eastern Samar</option>
                                    <option class="region8" value="Leyte">Leyte</option>
                                    <option class="region8" value="Northern Samar">Northern Samar</option>
                                    <option class="region8" value="Western Samar">Western Samar</option>
                                    <option class="region8" value="Southern Leyte">Southern Leyte</option>
                                    <option class="region9" value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                                    <option class="region9" value="Zamboanga del Norte">Zamboanga del Norte</option>
                                    <option class="region9" value="Zamboanga del Sur">Zamboanga del Sur</option>
                                    <option class="region10" value="Bukidnon">Bukidnon</option>
                                    <option class="region10" value="Camiguin">Camiguin</option>
                                    <option class="region10" value="Misamis Occidental">Misamis Occidental</option>
                                    <option class="region10" value="Msamis Oriental">Msamis Oriental</option>
                                    <option class="region10" value="Lanao del Norte">Lanao del Norte</option>
                                    <option class="region11" value="Davao del Norte">Davao del Norte</option>
                                    <option class="region11" value="Davao del Sur">Davao del Sur</option>
                                    <option class="region11" value="Davao Oriental">Davao Oriental</option>
                                    <option class="region11" value="Comostela Valley">Comostela Valley</option>
                                    <option class="region12" value="North Cotabato">North Cotabato</option>
                                    <option class="region12" value="Sultan Kudarat">Sultan Kudarat</option>
                                    <option class="region12" value="South Cotabato">South Cotabato</option>
                                    <option class="region12" value="Saranggani">Saranggani</option>
                                    <option class="region13" value="Agustan del Norte">Agustan del Norte</option>
                                    <option class="region13" value="Augustan del Sur">Augustan del Sur</option>
                                    <option class="region13" value="Suriago del Norte">Suriago del Norte</option>
                                    <option class="region13" value="Suriago del Sur">Suriago del Sur</option>
                                    <option class="regioncar" value="Abra">Abra</option>
                                    <option class="regioncar" value="Benguet">Benguet</option>
                                    <option class="regioncar" value="Ifugao">Ifugao</option>
                                    <option class="regioncar" value="Kalinga">Kalinga</option>
                                    <option class="regioncar" value="Apayao">Apayao</option>
                                    <option class="regioncar" value="Mountain Province">Mountain Province</option>
                                    <option class="regionarmm" value="Basilan">Basilan</option>
                                    <option class="regionarmm" value="Sulu">Sulu</option>
                                    <option class="regionarmm" value="Tawi-Tawi">Tawi-Tawi</option>
                                    <option class="regionarmm" value="Lanao del Sur">Lanao del Sur</option>
                                    <option class="regionarmm" value="Magrindanao">Magrindanao</option>
                                    <option class="regionncr" value="Manila">Manila</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"> City </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="city" required>
                            </div>
                        </div>

                        <input type="hidden" name="user_type" value=1>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default" id="retailer-panel" hidden>
                <div class="panel-heading">Register as Retailer</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label"> Region </label>

                            <div class="col-md-6">
                                <select  class="form-control region-list" name="region" required>
                                    <option value="">Select Region</option>
                                    <option value="ARMM">ARMM</option>
                                    <option value="CAR">CAR</option>
                                    <option value="NCR">NCR</option>
                                    <option value="Region 1">Region 1</option>
                                    <option value="Region 2">Region 2</option>
                                    <option value="Region 3">Region 3</option>
                                    <option value="Region 4a">Region 4a</option>
                                    <option value="Region 4b">Region 4b</option>
                                    <option value="Region 5">Region 5</option>
                                    <option value="Region 6">Region 6</option>
                                    <option value="Region 7">Region 7</option>
                                    <option value="Region 8">Region 8</option>
                                    <option value="Region 9">Region 9</option>
                                    <option value="Region 10">Region 10</option>
                                    <option value="Region 11">Region 11</option>
                                    <option value="Region 12">Region 12</option>
                                    <option value="Region 13">Region 13</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"> Province </label>

                            <div class="col-md-6">
                                <select id="province-list"  class="form-control" name="province" required>
                                    <option value="">Select Province</option>
                                    <option class="region1" value="Illocos Norte">Illocos Norte</option>
                                    <option class="region1" value="Illocos Sur">Illocos Sur</option>
                                    <option class="region1" value="La Union">La Union</option>
                                    <option class="region1" value="Pangasinan">Pangasinan</option>
                                    <option class="region2" value="Batanes">Batanes</option>
                                    <option class="region2" value="Cagayan">Cagayan</option>
                                    <option class="region2" value="Isabela">Isabela</option>
                                    <option class="region2" value="Nueva Viscaya">Nueva Viscaya</option>
                                    <option class="region2" value="Quirino">Quirino</option>
                                    <option class="region3" value="Aurora">Aurora</option>
                                    <option class="region3" value="Bataan">Bataan</option>
                                    <option class="region3" value="Bulacan">Bulacan</option>
                                    <option class="region3" value="Nueva Ecija">Nueva Ecija</option>
                                    <option class="region3" value="Pampanga">Pampanga</option>
                                    <option class="region3" value="Tarlac">Tarlac</option>
                                    <option class="region3" value="Zambales">Zambales</option>
                                    <option class="region4a" value="Batangas">Batangas</option>
                                    <option class="region4a" value="Cavite">Cavite</option>
                                    <option class="region4a" value="Laguna">Laguna</option>
                                    <option class="region4a" value="Quezon">Quezon</option>
                                    <option class="region4a" value="Rizal">Rizal</option>
                                    <option class="region4b" value="Marinduque">Marinduque</option>
                                    <option class="region4b" value="Occidental Mindoro">Occidental Mindoro</option>
                                    <option class="region4b" value="Oriental Mindoro">Oriental Mindoro</option>
                                    <option class="region4b" value="Palawan">Palawan</option>
                                    <option class="region4b" value="Romblon">Romblon</option>
                                    <option class="region5" value="Albay">Albay</option>
                                    <option class="region5" value="Camarines Norte">Camarines Norte</option>
                                    <option class="region5" value="Camarines Sur">Camarines Sur</option>
                                    <option class="region5" value="Catanduanes">Catanduanes</option>
                                    <option class="region5" value="Masbate">Masbate</option>
                                    <option class="region5" value="Sorsogon">Sorsogon</option>
                                    <option class="region6" value="Aklan">Aklan</option>
                                    <option class="region6" value="Antique">Antique</option>
                                    <option class="region6" value="Capiz">Capiz</option>
                                    <option class="region6" value="Iloilo">Iloilo</option>
                                    <option class="region6" value="Guimaras">Guimaras</option>
                                    <option class="region6" value="Negros Occidental">Negros Occidental</option>
                                    <option class="region7" value="Bohol">Bohol</option>
                                    <option class="region7" value="Cebu">Cebu</option>
                                    <option class="region7" value="Guimaras">Guimaras</option>
                                    <option class="region7" value="Negro Oriental">Negro Oriental</option>
                                    <option class="region7" value="Siquijor">Siquijor</option>
                                    <option class="region8" value="Biliran">Biliran</option>
                                    <option class="region8" value="Eastern Samar">Eastern Samar</option>
                                    <option class="region8" value="Leyte">Leyte</option>
                                    <option class="region8" value="Northern Samar">Northern Samar</option>
                                    <option class="region8" value="Western Samar">Western Samar</option>
                                    <option class="region8" value="Southern Leyte">Southern Leyte</option>
                                    <option class="region9" value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                                    <option class="region9" value="Zamboanga del Norte">Zamboanga del Norte</option>
                                    <option class="region9" value="Zamboanga del Sur">Zamboanga del Sur</option>
                                    <option class="region10" value="Bukidnon">Bukidnon</option>
                                    <option class="region10" value="Camiguin">Camiguin</option>
                                    <option class="region10" value="Misamis Occidental">Misamis Occidental</option>
                                    <option class="region10" value="Msamis Oriental">Msamis Oriental</option>
                                    <option class="region10" value="Lanao del Norte">Lanao del Norte</option>
                                    <option class="region11" value="Davao del Norte">Davao del Norte</option>
                                    <option class="region11" value="Davao del Sur">Davao del Sur</option>
                                    <option class="region11" value="Davao Oriental">Davao Oriental</option>
                                    <option class="region11" value="Comostela Valley">Comostela Valley</option>
                                    <option class="region12" value="North Cotabato">North Cotabato</option>
                                    <option class="region12" value="Sultan Kudarat">Sultan Kudarat</option>
                                    <option class="region12" value="South Cotabato">South Cotabato</option>
                                    <option class="region12" value="Saranggani">Saranggani</option>
                                    <option class="region13" value="Agustan del Norte">Agustan del Norte</option>
                                    <option class="region13" value="Augustan del Sur">Augustan del Sur</option>
                                    <option class="region13" value="Suriago del Norte">Suriago del Norte</option>
                                    <option class="region13" value="Suriago del Sur">Suriago del Sur</option>
                                    <option class="regioncar" value="Abra">Abra</option>
                                    <option class="regioncar" value="Benguet">Benguet</option>
                                    <option class="regioncar" value="Ifugao">Ifugao</option>
                                    <option class="regioncar" value="Kalinga">Kalinga</option>
                                    <option class="regioncar" value="Apayao">Apayao</option>
                                    <option class="regioncar" value="Mountain Province">Mountain Province</option>
                                    <option class="regionarmm" value="Basilan">Basilan</option>
                                    <option class="regionarmm" value="Sulu">Sulu</option>
                                    <option class="regionarmm" value="Tawi-Tawi">Tawi-Tawi</option>
                                    <option class="regionarmm" value="Lanao del Sur">Lanao del Sur</option>
                                    <option class="regionarmm" value="Magrindanao">Magrindanao</option>
                                    <option class="regionncr" value="Manila">Manila</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"> City </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="city" required>
                            </div>
                        </div>

                        <input type="hidden" name="user_type" value=3>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $('#buyer-btn').on('click', function() {
        $('#buyer-btn').hide();
        $('#retailer-btn').hide();
        $('#buyer-panel').show();
        $('#retailer-panel').hide();
    });

    $('#retailer-btn').on('click', function() {
        $('#buyer-btn').hide();
        $('#retailer-btn').hide();
        $('#buyer-panel').hide();
        $('#retailer-panel').show();
    });

    @if (isset($errors) && old('user_type') == 1)
        $('#buyer-btn').hide();
        $('#retailer-btn').hide();
        $('#buyer-panel').show();
        $('#retailer-panel').hide();
    @endif

    @if (isset($errors) && old('user_type') == 3)
        $('#buyer-btn').hide();
        $('#retailer-btn').hide();
        $('#buyer-panel').hide();
        $('#retailer-panel').show();
    @endif

    $(".province-list").val("");

    $(".region1").hide();
    $(".region2").hide();
    $(".region3").hide();
    $(".region4a").hide();
    $(".region4b").hide();
    $(".region5").hide();
    $(".region6").hide();
    $(".region7").hide();
    $(".region8").hide();
    $(".region9").hide();
    $(".region10").hide();
    $(".region11").hide();
    $(".region12").hide();
    $(".region13").hide();
    $(".regionarmm").hide();
    $(".regioncar").hide();
    $(".regionncr").hide();

    $('.region-list').on('change', function() {

        $(".province-list").val("");

        $(".region1").hide();
        $(".region2").hide();
        $(".region3").hide();
        $(".region4a").hide();
        $(".region4b").hide();
        $(".region5").hide();
        $(".region6").hide();
        $(".region7").hide();
        $(".region8").hide();
        $(".region9").hide();
        $(".region10").hide();
        $(".region11").hide();
        $(".region12").hide();
        $(".region13").hide();
        $(".regionarmm").hide();
        $(".regioncar").hide();
        $(".regionncr").hide();
        
        switch(this.value) {
            case "Region 1":
                $(".region1").show();
                break;
            case "Region 2":
                $(".region2").show();
                break;
            case "Region 3":
                $(".region3").show();
                break;
            case "Region 4a":
                $(".region4a").show();
                break;
            case "Region 4b":
                $(".region4b").show();
                break;
            case "Region 5":
                $(".region5").show();
                break;
            case "Region 6":
                $(".region6").show();
                break;
            case "Region 7":
                $(".region7").show();
                break;
            case "Region 8":
                $(".region8").show();
                break;
            case "Region 9":
                $(".region9").show();
                break;
            case "Region 10":
                $(".region10").show();
                break;
            case "Region 11":
                $(".region11").show();
                break;
            case "Region 12":
                $(".region12").show();
                break;
            case "Region 13":
                $(".region13").show();
                break;
            case "CAR":
                $(".regioncar").show();
                break;
            case "ARMM":
                $(".regionarmm").show();
                break;
            case "NCR":
                $(".regionncr").show();
                break;
        }
    });
});
</script>

@endsection
