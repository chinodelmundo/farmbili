@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">

            @include('layouts.statusmessage')

            <h3 class="page-header"><span class="glyphicon glyphicon-user"></span> Send Email</h3>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('email.send') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-2 control-label">Subject</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Recipients</label>

                            <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <table class="table table-bordered" id="users-table" data-order='[[ 1, "asc" ]]'>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>User Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="emails_list[]" value="{{$user->email}}">
                                                        </td>
                                                        <td>{{$user->get_name()}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->get_user_type()}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Message</label>

                            <div class="col-md-8">
                                <textarea class="form-control" rows="6" name="message"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Submit
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
$(document).ready( function () {
    $('#users-table').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 0}
        ],
        pagingType: 'simple'
    });
});
</script>
@endsection
