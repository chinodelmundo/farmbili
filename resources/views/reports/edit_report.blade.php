@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Report</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('report.update', $report->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-2 control-label">Subject</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $report->subject }}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Message</label>

                            <div class="col-md-8">
                                <textarea class="form-control" rows="6" disabled>{{$report->message}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Reply</label>

                            <div class="col-md-8">
                                <textarea class="form-control" rows="6" name="reply">{{$report->reply}}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="_method" value="PUT">

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
@endsection