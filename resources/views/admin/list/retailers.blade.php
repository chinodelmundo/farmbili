@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header"> <span class="glyphicon glyphicon-user"></span> Retailers </h3>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if($users->count() > 0)
                        <table class="table table-striped table-hover table-bordered table-condensed" id="retailers-table" data-order='[[ 1, "asc" ]]'>
                            <thead>    
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Region</th>
                                    <th>Province</th>
                                    <th>City</th>
                                    <th>Registered</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            @if(isset($user->images()->where('is_primary', 1)->first()->id))
                                                <a href="#" data-toggle="modal" data-target="#imageModal{{$user->id}}">
                                                    <img class="img-rounded" src="/images/uploads/{{$user->images()->where('is_primary', 1)->first()->file_name}}" alt="user" width="80" height="60">
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
                                        </td>
                                        <td>
                                            <a href="{{ route('retailer.view', $user->id) }}"> {{ $user->get_name() }} </a>
                                        </td>
                                        <td>{{ $user->region }}</td>
                                        <td>{{ $user->province }}</td>
                                        <td>{{ $user->city }}</td>
                                        <td>{{ $user->created_at->toDateString() }}</td>
                                        <td colspan="2">
                                            <table class="table-condensed">
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary btn-sm"> Edit </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <form  method="POST" action="{{ route('retailer.unapprove', $user->id) }}">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="submit" class="btn btn-danger btn-sm" value="Unapprove">
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
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
    $('#retailers-table').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 0},
            { "orderable": false, "targets": 6}
        ]
    });
} );
</script>
@endsection
