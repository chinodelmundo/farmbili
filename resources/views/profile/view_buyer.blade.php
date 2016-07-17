@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">

            @include('layouts.statusmessage')

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-user"></span>
                            {{ $buyer->get_name() }}
                        </div>
                        <div class="panel-body">
                            <center>
                                @if($buyer->images()->count() > 0)
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @foreach($buyer->images as $image)
                                                <div class="item @if($image->id == $buyer->images()->where('is_primary', 1)->first()->id) active @endif">
                                                    <img src="/images/uploads/{{$image->file_name}}" height="150">
                                                </div>
                                            @endforeach
                                        </div>

                                        @if($buyer->images()->count() > 1)
                                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" height="150">
                                @endif
                            </center>
                            <table class="table add-margin">
                                <tbody>
                                    <tr>
                                        <td width="20%">Email</td>
                                        <td>{{ $buyer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $buyer->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Region</td>
                                        <td>{{ $buyer->region }}</td>
                                    </tr>
                                    <tr>
                                        <td>Joined</td>
                                        <td>{{ $buyer->created_at->toDateString() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if(Auth::User()->id == $buyer->id || Auth::User()->user_type == 0)    
                                <a href="{{ route('profile.edit', $buyer->id) }}" class="btn btn-primary btn-sm"> Edit </a>
                            @endif
                        </div>
                    </div>
                </div>
                @if(Auth::Guest())
                @else
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               Latest Activities
                            </div>
                            <div class="panel-body">
                                @if($activities->count() > 0)
                                    <table class="table-condensed table-striped table-hover table-activities" id="activities-table">
                                        <thead>    
                                            <tr>
                                                <th width="40%">Action</th>
                                                <th width="35%">Target</th>
                                                <th width="25%">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($activities as $activity)
                                                <tr>
                                                    <td>{{ $activity->action }}</td>
                                                    <td>{{ $activity->target_name }}</td>
                                                    <td>{{ substr($activity->created_at, 0, 10) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if(Auth::User()->user_type == 0)
                                        <br>
                                        <a href="{{route('activities.all', $buyer->id)}}" class="btn btn-primary btn-sm">View All</a>
                                    @endif
                                @else 
                                    No activities.
                                @endif
                            </div>
                        </div>
                    </div>
                @endif


                <div class="@if(Auth::guest()) col-md-5 @else col-md-6 @endif">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="page-header"><b>Buyer Description</b></h4>
                            {!! nl2br(e($buyer->description)) !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Transactions
                </div>
                <div class="panel-body">
                    @if($transactions->count() > 0)
                        <table class="table table-striped table-hover table-bordered" id="transactions-table" data-order='[[ 4, "desc" ]]' width="100%">
                            <thead>    
                                <tr>
                                    <th>Buyer</th>
                                    <th>Product</th>
                                    <th>Retailer</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td> 
                                            <a href="{{ route('buyer.view', $transaction->user->id) }}"> {{ $transaction->user->get_name() }} </a>
                                        </td>
                                        @if(isset($transaction->product->id))
                                            <td> 
                                                <a href="{{ route('product.show', $transaction->product->id) }}"> {{ $transaction->product->name }} </a>
                                            </td>
                                            <td> 
                                                <a href="{{ route('retailer.view', $transaction->product->user->id) }}"> {{ $transaction->product->user->get_name() }} </a> 
                                            </td>
                                        @else
                                            <td><i>Deleted</i></td>
                                            <td>
                                                <a href="{{ route('retailer.view', $transaction->retailer->id) }}"> {{ $transaction->retailer->get_name() }} </a> 
                                            </td>
                                        @endif
                                        <td> {{ $transaction->quantity }}</td>
                                        <td> {{ $transaction->created_at }}</td>
                                        <td> {{ $transaction->get_status() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        No Transactions.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready( function () {
    $('#transactions-table').DataTable({
        ordering : false,
        searching: false
    });
});
</script>
@endsection
