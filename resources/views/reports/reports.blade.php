@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">   
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            @include('layouts.statusmessage')

            <h3 class="page-header"><span class="fa fa-folder-open"></span> Reports</h3>

            @if(Auth::User()->user_type != 0)
                <div class="row">
                    <div class="col-md-2 col-md-offset-8">
                        <a href="{{ route('report.create') }}" class="btn btn-success btn-md">
                            <span class="glyphicon glyphicon-plus"></span> Add Report
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="/users/admins" class="btn btn-primary btn-md"> View Admins
                        </a>
                    </div>
                </div>
                <p></p>
            @endif

            @if(Auth::User()->user_type == 0)
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        Unanswered Reports
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-hover table-bordered" id="unanswered-table" data-order='[[ 4, "desc" ]]'>
                            <thead>    
                                <tr>
                                    <th width="30%">Subject</th>
                                    <th> Category </th>
                                    <th>User</th>
                                    <th>User Type</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unanswered as $report)
                                    <tr>
                                        <td> {{ $report->subject }} </td>
                                        <td> {{ $report->category }} </td>
                                        <td> {{ $report->user->get_name() }} </td>
                                        <td> {{ $report->user->get_user_type() }} </td>
                                        <td> {{ $report->created_at->toDateString() }} </td>
                                        <td>
                                            <a href="{{ route('report.show', $report->id) }}" class="btn btn-primary btn-sm"> View </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading">
                        Answered Reports
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-hover table-bordered" id="answered-table" data-order='[[ 4, "desc" ]]'>
                            <thead>    
                                <tr>
                                    <th width="30%">Subject</th>
                                    <th> Category </th>
                                    <th>User</th>
                                    <th>User Type</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($answered as $report)
                                    <tr>
                                        <td> {{ $report->subject }} </td>
                                        <td> {{ $report->category }} </td>
                                        <td> {{ $report->user->get_name() }} </td>
                                        <td> {{ $report->user->get_user_type() }} </td>
                                        <td> {{ $report->created_at->toDateString() }} </td>
                                        <td>
                                            <a href="{{ route('report.show', $report->id) }}" class="btn btn-primary btn-sm"> View </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>    
                                <tr>
                                    <th width="40%">Subject</th>
                                    <th> Category </th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td> {{ $report->subject }} </td>
                                        <td> {{ $report->category }} </td>
                                        <td> {{ $report->created_at->toDateString() }} </td>
                                        <td> {{ $report->get_status() }} </td>
                                        <td>
                                            <a href="{{ route('report.show', $report->id) }}" class="btn btn-primary btn-sm"> View </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#unanswered-table').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 5}
        ]
    });

    $('#answered-table').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 5}
        ]
    });
});
</script>
@endsection
