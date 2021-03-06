@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header"> <span class="glyphicon glyphicon-user"></span> Administrators </h3>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if($users->count() > 0)
                        <table class="table table-striped table-hover table-bordered table-condensed" id="admins-table" data-order='[[ 1, "asc" ]]'>
                            <thead>    
                                <tr>
                                    <th></th>
                                    <th>Name</th>
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
                                            <center>
                                                @if(isset($user->images()->first()->id))
                                                    <a href="#" data-toggle="modal" data-target="#imageModal{{$user->id}}">
                                                        <img class="img-rounded" src="/images/uploads/{{$user->images()->first()->file_name}}" alt="user" width="80" height="60">
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
                                                    <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" width="80" height="60">
                                                @endif
                                            </center>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.view', $user->id) }}"> {{ $user->get_name() }} </a>
                                        </td>
                                        <td>{{ $user->region }}</td>
                                        <td>{{ $user->province }}</td>
                                        <td>{{ $user->city }}</td>
                                        <td>{{ $user->created_at->toDateString() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#admins-table').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 0}
        ]
    });
} );
</script>
@endsection
