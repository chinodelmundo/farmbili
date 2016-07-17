@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user"></span>
                    Edit Profile Information
                </div>
                <div class="panel-body">
                    <div class= "row">
                        <center>
                            <div class = "col-md-6 col-md-offset-4">
                            @if($user->images()->count() > 0)
                                <img class="img-rounded" src="/images/uploads/{{$user->images()->where('is_primary', 1)->first()->file_name}}" alt="buyer" style="height: 150px; margin-bottom: 10px;">
                            @else
                                <img class="image-rounded" src="{{ asset('images/user.png') }}" alt="user" height="150">
                            @endif
                            <br/>
                            @if(Auth::User()->id == $user->id)
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadModal" style ="width: 100%;margin-bottom: 10px;"> Upload Photo </a>
                            @endif
                            </div>
                        </center>
                    </div>
                    <div id="uploadModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">     
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('image.upload_user') }}" enctype="multipart/form-data">
                                                        {!! csrf_field() !!}

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">Image</label>

                                                            <div class="col-md-8">
                                                                <input type="file" class="form-control" name="image">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Upload
                                                                </button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <form class="form-horizontal add-margin"  role="form" method="POST" action="{{ route('profile.update', $user->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        @if(Auth::User()->id == $user->id)
                            <div class="form-group">
                                    <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <a href="/profile/change_password" class="btn btn-primary btn-sm" style="width: 100%; padding-top: -25px;"> Change Password </a>
                                </div>
                            </div>                       
                        @endif 
                        <div class="form-group">
                            <label class="col-md-4 control-label">Contact No.</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"> Region </label>

                            <div class="col-md-6">
                                <select id="region-list"  class="form-control" name="region">
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
                                <select id="province-list"  class="form-control" name="province">
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
                                <input type="text" class="form-control" name="city" value="{{$user->city}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="4" name="description">{{ $user->description }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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

    $("#region-list").val("{{$user->region}}");
    $("#province-list").val("{{$user->province}}");

    $('#region-list').on('change', function() {

        $("#province-list").val("");

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
