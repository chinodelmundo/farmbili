@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header"> <span class="glyphicon glyphicon-user"></span> {{ $title }}</h3>

            <div align="center">
                @if($month == 1)
                    <a href="/users/{{$year - 1}}/12" class="btn btn-primary btn-sm"> Prev Month </a>
                @else
                    <a href="/users/{{$year}}/{{$month - 1}}" class="btn btn-primary btn-sm"> Prev Month </a>
                @endif

                @if($month == 12)
                    <a href="/users/{{$year + 1}}/1" class="btn btn-primary btn-sm"> Next Month </a>
                @else
                    <a href="/users/{{$year}}/{{$month + 1}}" class="btn btn-primary btn-sm"> Next Month </a>
                @endif
                <p></p>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if($users->count() > 0)
                        <table class="table table-striped table-hover table-bordered table-condensed" id="users-table" data-order='[[ 1, "asc" ]]'>
                            <thead>    
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>User Type</th>
                                    <th>Region</th>
                                    <th>Province</th>
                                    <th>City</th>
                                    <th>Registered</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            @if(isset($user->images()->where('is_primary', 1)->first()->id))
                                                <a href="#" data-toggle="modal" data-target="#imageModal{{$user->id}}">
                                                    <img class="img-rounded" src="/images/uploads/{{$user->images()->where('is_primary', 1)->first()->file_name}}" alt="user" height="50" width="50">
                                                </a>
                                                <div id="imageModal{{$user->id}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">     
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <img class="img-rounded" src="/images/uploads/{{$user->images()->first()->file_name}}" width="100%" height="100%">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" height="50" width="50">
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->user_type == 0)
                                                <a href="{{ route('admin.view', $user->id) }}"> {{ $user->get_name() }} </a>
                                            @elseif($user->user_type == 1)
                                                <a href="{{ route('buyer.view', $user->id) }}"> {{ $user->get_name() }} </a>
                                            @elseif($user->user_type == 2 || $user->user_type == 3)
                                                <a href="{{ route('retailer.view', $user->id) }}"> {{ $user->get_name() }} </a>
                                            @else
                                                {{ $user->get_name() }}
                                            @endif
                                        </td>
                                        <td>{{ $user->get_user_type() }}</td>
                                        <td>{{ $user->region }}</td>
                                        <td>{{ $user->province }}</td>
                                        <td>{{ $user->city }}</td>
                                        <td>{{ $user->created_at->toDateString() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        No Users.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready( function () {
    $('#users-table').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 0}
        ]
    });
});
</script>
@endsection
