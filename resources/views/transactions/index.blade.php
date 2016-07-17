@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header"><span class="fa fa-shopping-cart"></span> 
                @if(Auth::User()->user_type ==1)
                    Cart
                @else
                    Transactions
                @endif
            </h3>

            <div class="panel panel-default">
                <div class="panel-heading">Fixed Price Products</div>
                <div class="panel-body">
                    @if($transactions->where('type',1)->count() > 0)
                        <table class="table table-striped table-hover table-bordered" id="transactions-table" data-order='[[ 4, "desc" ]]'>
                            <thead>    
                                <tr>
                                    @if(Auth::User()->user_type == 2)
                                        <th>Buyer</th>
                                    @endif
                                    <th>Product</th>
                                    @if(Auth::User()->user_type == 1)
                                        <th>Retailer</th>
                                    @endif
                                    <th>Qty</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions->where('type', 1) as $transaction)
                                    <tr>
                                        @if(Auth::User()->user_type == 2)
                                            <td> 
                                                <a href="{{ route('buyer.view', $transaction->user->id) }}"> {{ $transaction->user->get_name() }} </a>
                                            </td>
                                        @endif
                                        @if(isset($transaction->product->id))
                                            <td> 
                                                <a href="{{ route('product.show', $transaction->product->id) }}"> {{ $transaction->product->name }} </a>
                                            </td>
                                            @if(Auth::User()->user_type == 1)
                                                <td> 
                                                    <a href="{{ route('retailer.view', $transaction->product->user->id) }}"> {{ $transaction->product->user->get_name() }} </a> 
                                                </td>
                                            @endif
                                        @else
                                            <td><i>Unavailable</i></td>
                                            @if(Auth::User()->user_type == 1)
                                                <td>
                                                    <a href="{{ route('retailer.view', $transaction->retailer->id) }}"> {{ $transaction->retailer->get_name() }} </a> 
                                                </td>
                                            @endif
                                        @endif
                                        <td> {{ $transaction->quantity }}</td>
                                        <td align="right"> {{ $transaction->total_price }}</td>
                                        <td> {{ substr($transaction->created_at, 0, 10) }}</td>
                                        <td class="{{ $transaction->get_status_text_class() }}"><b> {{ $transaction->get_status() }}</b></td>
                                        @if(Auth::User()->user_type == 2)
                                            <td>
                                                @if($transaction->status == 0)
                                                    <table class="table-condensed">
                                                        <tr>
                                                            <td>
                                                                <input type="button" class="btn btn-success btn-sm green-btn" value="Approve" data-toggle="modal" data-target="#approve{{$transaction->id}}">
                                                    
                                                                <div id="approve{{$transaction->id}}" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">      
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-9">
                                                                                        <p>You are about to approve a transaction.</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-md-offset-6">
                                                                                        <table class="table-condensed">
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <form  method="POST" action="{{ route('transaction.approve', $transaction->id) }}">
                                                                                                        <input type="hidden" name="_method" value="PUT">
                                                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                                        <input type="submit" class="btn btn-primary btn-sm" value="Continue">
                                                                                                    </form>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="button" class="btn btn-danger btn-sm darkred-btn" value="Reject" data-toggle="modal" data-target="#reject{{$transaction->id}}" style="width: 100%;">
                                                    
                                                                <div id="reject{{$transaction->id}}" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">      
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-9">
                                                                                        <p>You are about to reject a transaction.</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-md-offset-6">
                                                                                        <table class="table-condensed">
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <form  method="POST" action="{{ route('transaction.unapprove', $transaction->id) }}">
                                                                                                        <input type="hidden" name="_method" value="PUT">
                                                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                                        <input type="submit" class="btn btn-primary btn-sm" value="Continue">
                                                                                                    </form>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>
                                        @elseif(Auth::User()->user_type == 1)
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rate{{$transaction->id}}" style="width: 100%"> Rate </a>

                                                <div id="rate{{$transaction->id}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">     
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <form class="form-horizontal" role="form" method="POST" action="/retailer/{{$transaction->retailer_id}}/rate/{{$transaction->id}}">
                                                                        {!! csrf_field() !!}

                                                                        <input type="hidden" name="retailer_id" value="{{ $transaction->retailer_id }}">
                                                                        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

                                                                        <label class="col-md-4 control-label">Rating</label>

                                                                        <div class="col-md-6">
                                                                            <div class="form-control custom-form rating" @if(isset($transaction->rating->id)) data-score="{{$transaction->rating->rate}}" @endif></div>
                                                                        </div>
                                                            
                                                                        <label class="col-md-4 control-label">Comment</label>

                                                                        <div class="col-md-6">
                                                                            <textarea class="form-control" rows="4" cols="40" name="comment">@if(isset($transaction->rating->id)){{$transaction->rating->comment}}@endif</textarea>
                                                                        </div>

                                                                        <div class="col-md-6 col-md-offset-1">
                                                                            <button type="submit" class="btn btn-primary">
                                                                                Submit
                                                                            </button>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        No Transactions.
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Negotiable Price Products</div>
                <div class="panel-body">
                    @if($transactions->where('type', 2)->count() > 0)
                        <table class="table table-striped table-hover table-bordered" id="transactions-table2" data-order='[[ 4, "desc" ]]'>
                            <thead>    
                                <tr>
                                    @if(Auth::User()->user_type == 2)
                                        <th>Buyer</th>
                                    @endif
                                    <th>Product</th>
                                    @if(Auth::User()->user_type == 1)
                                        <th>Retailer</th>
                                    @endif
                                    <th>Qty</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions->where('type', 2) as $transaction)
                                    <tr>
                                        @if(Auth::User()->user_type == 2)
                                            <td> 
                                                <a href="{{ route('buyer.view', $transaction->user->id) }}"> {{ $transaction->user->get_name() }} </a>
                                            </td>
                                        @endif
                                        @if(isset($transaction->product->id))
                                            <td> 
                                                <a href="{{ route('product.show', $transaction->product->id) }}"> {{ $transaction->product->name }} </a>
                                            </td>
                                            @if(Auth::User()->user_type == 1)
                                                <td> 
                                                    <a href="{{ route('retailer.view', $transaction->product->user->id) }}"> {{ $transaction->product->user->get_name() }} </a> 
                                                </td>
                                            @endif
                                        @else
                                            <td><i>Unavailable</i></td>
                                            @if(Auth::User()->user_type == 1)
                                                <td>
                                                    <a href="{{ route('retailer.view', $transaction->retailer->id) }}"> {{ $transaction->retailer->get_name() }} </a> 
                                                </td>
                                            @endif
                                        @endif
                                        <td> {{ $transaction->quantity }}</td>
                                        <td align="right"> {{ $transaction->total_price }}</td>
                                        <td> {{ substr($transaction->created_at, 0, 10) }}</td>
                                        <td class="{{ $transaction->get_status_text_class() }}"><b> {{ $transaction->get_status() }}</b></td>
                                        <td> 
                                            <center>
                                                <a class="btn btn-primary btn-sm yellow-btn" href="/transaction/{{$transaction->id}}/view"> View </a> 
                                                
                                                @if(Auth::User()->user_type == 1)
                                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rate{{$transaction->id}}"> Rate </a>

                                                    <div id="rate{{$transaction->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">     
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <form class="form-horizontal" role="form" method="POST" action="/retailer/{{$transaction->retailer_id}}/rate/{{$transaction->id}}">
                                                                            {!! csrf_field() !!}

                                                                            <input type="hidden" name="retailer_id" value="{{ $transaction->retailer_id }}">
                                                                            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

                                                                            <label class="col-md-4 control-label">Rating</label>

                                                                            <div class="col-md-6">
                                                                                <div class="form-control custom-form rating" @if(isset($transaction->rating->id)) data-score="{{$transaction->rating->rate}}" @endif></div>
                                                                            </div>

                                                                
                                                                            <label class="col-md-4 control-label">Comment</label>

                                                                            <div class="col-md-6">
                                                                                <textarea class="form-control" rows="4" name="comment">@if(isset($transaction->rating->id)){{$transaction->rating->comment}}@endif</textarea>
                                                                            </div>

                                                                            <div class="col-md-6 col-md-offset-1">
                                                                                <button type="submit" class="btn btn-primary">
                                                                                    Submit
                                                                                </button>
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </center>
                                        </td>
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
    $('#transactions-table').DataTable();
    $('#transactions-table2').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 6}
        ]
    });

    $('.rating').raty({
        path: function() {
            return '/images';
        },
        score: function() {
            return $(this).attr('data-score');
        },
        hints: ['1','2','3','4','5'],
        scoreName: 'score'
    });
});
</script>
@endsection
