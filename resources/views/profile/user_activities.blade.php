@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header"> {{ $user->get_name()}}'s Activities</h3>
                    
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($activities->count() > 0)
                        <table class="table table-striped table-hover table-bordered table-condensed" id="activities-table" data-order='[[ 2, "desc" ]]'>
                            <thead>    
                                <tr>
                                    <th>Action</th>
                                    <th>Target</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activity)
                                    <tr>
                                        <td>{{ $activity->action }}</td>
                                        <td>
                                            @if($activity->target_type == 0)
                                                <a href="{{ route('admin.view', $activity->target_id) }}"> {{ $activity->target_name }} </a>
                                            @elseif($activity->target_type == 1)
                                                <a href="{{ route('buyer.view', $activity->target_id) }}"> {{ $activity->target_name }} </a>
                                            @elseif($activity->target_type == 2 || $activity->target_type == 3)
                                                <a href="{{ route('retailer.view', $activity->target_id) }}"> {{ $activity->target_name }} </a>
                                            @elseif($activity->target_type == 4)
                                                <a href="{{ route('product.show', $activity->target_id) }}"> {{ $activity->target_name }} </a>
                                            @elseif($activity->target_type == 5)
                                                <a href="{{ route('transaction.show', $activity->target_id) }}"> {{ $activity->target_name }} </a>
                                            @else
                                                {{ $activity->target_name }}
                                            @endif
                                        </td>
                                        <td>{{ $activity->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else 
                        No activities.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#activities-table').DataTable();
});
</script>

@endsection
