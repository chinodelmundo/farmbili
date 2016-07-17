<div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#activities">
        <h4 class="panel-title">
            <a href="#">
                Activity Log <span class="caret"></span>
            </a>
        </h4>
    </div>
    <div id="activities" class="panel-collapse collapse">
        <div class="panel-body">
            @if($activities->count() > 0)
                <table class="table table-striped table-hover table-bordered table-custom" id="activities-table" width="100%">
                    <thead>    
                        <tr>
                            <th>User</th>
                            <th>Action</th>
                            <th>Target</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td>
                                    @if($activity->user->user_type == 0)
                                        <a href="{{ route('admin.view', $activity->user->id) }}" title="{{ $activity->user->get_name() }}"> {{ $activity->user->get_name() }} </a>
                                    @elseif($activity->user->user_type == 1)
                                        <a href="{{ route('buyer.view', $activity->user->id) }}" title="{{ $activity->user->get_name() }}"> {{ $activity->user->get_name() }} </a>
                                    @elseif($activity->user->user_type == 2 || $activity->user->user_type == 3)
                                        <a href="{{ route('retailer.view', $activity->user->id) }}" title="{{ $activity->user->get_name() }}"> {{ $activity->user->get_name() }} </a>
                                    @else
                                        {{ $activity->user->get_name() }}
                                    @endif
                                </td>
                                <td>{{ $activity->action }}</td>
                                <td>
                                    @if($activity->target_type == 0)
                                        <a href="{{ route('admin.view', $activity->target_id) }}" title="{{ $activity->target_name }}"> {{ $activity->target_name }} </a>
                                    @elseif($activity->target_type == 1)
                                        <a href="{{ route('buyer.view', $activity->target_id) }}" title="{{ $activity->target_name }}"> {{ $activity->target_name }} </a>
                                    @elseif($activity->target_type == 2 || $activity->target_type == 3)
                                        <a href="{{ route('retailer.view', $activity->target_id) }}" title="{{ $activity->target_name }}"> {{ $activity->target_name }} </a>
                                    @elseif($activity->target_type == 4)
                                        <a href="{{ route('product.show', $activity->target_id) }}" title="{{ $activity->target_name }}"> {{ $activity->target_name }} </a>
                                    @elseif($activity->target_type == 5)
                                        <a href="{{ route('transaction.show', $activity->target_id) }}"> Transaction {{$activity->target_id}} </a>
                                    @else
                                        {{ $activity->target_name }}
                                    @endif
                                </td>
                                <td>{{ $activity->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
<script>
$(document).ready( function () {
    $('#activities-table').DataTable({
        ordering: false,
        pagingType: 'simple'
    });
});
</script>