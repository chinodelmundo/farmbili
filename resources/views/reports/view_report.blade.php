@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header">Report Details</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="#">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-2 control-label">Subject</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $report->subject }}" disabled style="cursor: default;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">From</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $report->user->get_name() }}" disabled style="cursor: default;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Message</label>

                            <div class="col-md-8">
                                <textarea class="form-control" rows="6" disabled style="cursor: default;">{{$report->message}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Reply</label>

                            <div class="col-md-8">
                                <textarea class="form-control" rows="6" name="reply" @if($report->reply != "") value="{{$report->reply}}" @else placeholder="Not yet replied." @endif disabled style="cursor: default;">{{$report->reply}}</textarea>
                            </div>
                        </div>
                    </form>
                    @if(Auth::User()->user_type == 0)
                        <div>
                            <center><a href="{{ route('report.edit', $report->id) }}" class="btn btn-primary btn-md"> Edit Reply </a></center>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection