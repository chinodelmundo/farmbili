@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">

            @include('layouts.statusmessage')

            <h3 class="page-header"><span class="glyphicon glyphicon-user"></span> Profile</h3>
            
            <div class="row no-gutter">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class = "panel-heading">Basic Information</div>
                        <div class="profile-panel">
                            <div class="panel-body">
                                <center>
                                    @if(Auth::User()->images()->count() > 0)
                                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                @foreach(Auth::User()->images as $image)
                                                    <div class="item @if(isset(Auth::User()->images()->where('is_primary', 1)->first()->id) && $image->id == Auth::User()->images()->where('is_primary', 1)->first()->id) active @endif">
                                                        <img src="/images/uploads/{{$image->file_name}}" height="150" style = "height: 150px;">
                                                    </div>
                                                @endforeach

                                                @if(!isset(Auth::User()->images()->where('is_primary', 1)->first()->id))
                                                    <div class="item active">
                                                        <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" height="100">
                                                    </div>
                                                @endif
                                            </div>

                                            @if(Auth::User()->images()->count() > 1)
                                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <img class="image-rounded" src="{{ asset('images/user.png') }}" alt="user" height="150">
                                    @endif
                                </center>
                                <table class="table profile-table add-margin">
                                    <tr>
                                        <td width="20%">Name</td>
                                        <td>{{ Auth::user()->get_name() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ Auth::user()->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>User Type</td>
                                        <td>{{ Auth::user()->get_user_type() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Region</td>
                                        <td>{{ Auth::user()->region }}</td>
                                    </tr>
                                    <tr>
                                        <td>Province</td>
                                        <td>{{ Auth::user()->province }}</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>{{ Auth::user()->city }}</td>
                                    </tr>
                                    <tr>
                                        <td>Joined</td>
                                        <td>{{ Auth::user()->created_at->toDateString() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ Auth::user()->description }}</td>
                                    </tr>
                                </table>
                                <div class="pull-right">
                                    <a href="{{ route('profile.edit', Auth::user()->id) }}" class="btn btn-primary btn-sm"> Edit Info </a>
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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Latest Activities
                        </div>
                        <div class="panel-body">
                            @if($activities->count() > 0)
                                <table class="table-condensed table-striped table-hover table-activities" id="activities-table">
                                    <thead>    
                                        <tr>
                                            <th width="40%">Action</th>
                                            <th width="35%">Target</th>
                                            <th width="25%">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($activities as $activity)
                                            <tr>
                                                <td>{{ $activity->action }}</td>
                                                <td>{{ $activity->target_name }}</td>
                                                <td>{{ substr($activity->created_at, 0, 10) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div class ="pull-right">
                                    <a href="profile/activities" class="btn btn-primary btn-sm darkred-btn">View All</a>
                                </div>
                            @else 
                                No activities.
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Photos</div>
                        <div class="panel-body">
                            @if(Auth::User()->images()->count() > 0)
                                <div class="row">
                                    <div class="image-container">
                                        @foreach(Auth::User()->images as $image)
                                            <div class="col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <center>
                                                        <img src="/images/uploads/{{$image->file_name}}" class="img-thumbnail" width="100" height="80"><br><br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <form  method="POST" action="{{ route('image.primary', $image->id) }}">
                                                                    <input type="hidden" name="_method" value="PUT">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button type="submit" class="btn btn-sm photo-btn" data-toggle="tooltip" title="@if($image->is_primary == 0) Set as @endif Primary Photo" @if($image->is_primary == 1) disabled style = "cursor:default" @endif><i class="fa fa-check-square-o"></i></button>
                                                                </form>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <button class="btn btn-sm" data-toggle="modal" title="Delete Photo" data-target="#delete{{$image->id}}"><i class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Photo"></i></button>
                                                                
                                                                <div id="delete{{$image->id}}" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">      
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                @if($image->is_primary != 1)
                                                                                    <p>You are about to delete an image.</p>
                                                                                    <table class="table-condensed">
                                                                                        <tr>
                                                                                            <td>
                                                                                                <button type="button" class="btn btn-default btn-sm " data-dismiss="modal">Cancel</button>
                                                                                            </td>
                                                                                            <td>
                                                                                                <form  method="POST" action="{{ route('image.destroy', $image->id) }}">
                                                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                                    <input type="submit" class="btn btn-primary btn-sm" value="Continue">
                                                                                                </form>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                @else
                                                                                    <p>Cannot delete primary photo.<br>Set another photo as primary first.</p>
                                                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                No Photos.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::User()->user_type == 2)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Comments
                    </div>
                    <div class="panel-body">
                        @if(Auth::User()->ratings()->where('comment', '!=', '')->count() > 0)
                            <table class="table table-hover" id="comments-table" width="100%">
                                <thead>    
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Auth::User()->ratings as $rating)
                                        <tr>
                                            <td> 
                                                <blockquote>
                                                    {{$rating->comment}}
                                                    <small>
                                                        <cite>{{$rating->buyer->get_name()}}</cite>
                                                    </small>
                                                </blockquote>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            No Comments.
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


<script>
    $(document).ready( function () {
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
@endsection
