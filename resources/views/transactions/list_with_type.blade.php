@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header"> {{ $title }} </h3>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if($transactions->count() > 0)
                        <table class="table table-striped table-hover table-bordered" id="transactions-table" data-order='[[ 4, "desc" ]]'>
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
    $('#transactions-table').DataTable();
});
</script>
@endsection
