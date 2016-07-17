@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Add Report</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('report.store') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-2 control-label">Subject</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Category</label>

                            <div class="col-md-8">
                                <select class="form-control" name="category">
                                    <option value="User Related Issue">User Related Issue</option>
                                    <option value="Product Related Issue">Product Related Issue</option>
                                    <option value="Error Encountered">Error Encountered</option>
                                    <option value="Other">Other</option>
                                </select>
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
@endsection