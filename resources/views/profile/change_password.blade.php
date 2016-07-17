@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">

            @include('layouts.statusmessage')

            <h3 class="page-header">Change Password</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="#">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Current Password</label>

                            <div class="col-md-5">
                                <input type="password" class="form-control" name="current_password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">New Password</label>

                            <div class="col-md-5">
                                <input type="password" class="form-control" name="new_password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm New Password</label>

                            <div class="col-md-5">
                                <input type="password" class="form-control" name="new_password2">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    </i>Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
