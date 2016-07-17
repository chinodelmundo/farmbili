@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">

            @include('layouts.statusmessage')

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-user"></span>
                            Administrator Information
                        </div>
                        <div class="panel-body">
                            <center>
                                @if($admin->images()->count() > 0)
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @foreach($admin->images as $image)
                                                <div class="item @if($image->id == $admin->images()->where('is_primary', 1)->first()->id) active @endif">
                                                    <img src="/images/uploads/{{$image->file_name}}" height="150">
                                                </div>
                                            @endforeach
                                        </div>

                                        @if($admin->images()->count() > 1)
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
                                    <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" height="150">
                                @endif
                            </center>
                            <table class="table add-margin">
                                <thead>
                                    <tr>
                                        <th colspan="2"><center><b>{{ $admin->get_name() }}</b></center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="20%">Email</td>
                                        <td>{{ $admin->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $admin->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Region</td>
                                        <td>{{ $admin->region }}</td>
                                    </tr>
                                    <tr>
                                        <td>Province</td>
                                        <td>{{ $admin->province }}</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>{{ $admin->city }}</td>
                                    </tr>
                                    <tr>
                                        <td>Joined</td>
                                        <td>{{ $admin->created_at->toDateString() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if(Auth::User()->id == $admin->id)    
                                <a href="{{ route('profile.edit', $admin->id) }}" class="btn btn-primary btn-sm"> Edit </a>
                            @endif
                        </div>
                    </div>
                </div>
                @if(Auth::Guest())
                @else
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
                                    @if(Auth::User()->user_type == 0)
                                        <br>
                                        <a href="{{route('activities.all', $admin->id)}}" class="btn btn-primary btn-sm">View All</a>
                                    @endif
                                @else 
                                    No activities.
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="@if(Auth::guest()) col-md-5 @else col-md-6 @endif">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="page-header"><b>Admin Description</b></h4>
                            {!! nl2br(e($admin->description)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection