@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Announcement
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('announcement.update', $announcement->id) }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Message</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="4" name="message">{{ $announcement->message }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">User Type</label>

                            <div class="col-md-6">
                                  <select class="form-control" name="user_type" value="{{ $announcement->user_type }}">
                                    <option value="9" @if($announcement->user_type == 9) selected @endif > All User Types </option>
                                    <option value="1" @if($announcement->user_type == 1) selected @endif > Buyers </option>
                                    <option value="2" @if($announcement->user_type == 2) selected @endif > Retailers </option>
                                    <option value="0" @if($announcement->user_type == 0) selected @endif > Administrators </option>
                                  </select>
                            </div>
                        </div>

                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
