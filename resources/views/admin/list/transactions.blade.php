@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header"> Transactions </h3>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if($transactions->count() > 0)
                        <table class="table table-striped table-hover table-bordered table-custom" id="transactions-table" data-order='[[ 5, "desc" ]]'>
                            <thead>    
                                <tr>
                                    <th width="19%">Buyer</th>
                                    <th width="19%">Product</th>
                                    <th width="19%">Retailer</th>
                                    <th width="8%">Qty</th>
                                    <th>Total Price</th>
                                    <th width="12%">Date</th>
                                    <th width="12%">Status</th>
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
                                        <td align="right"> {{ $transaction->total_price }}</td>
                                        <td> {{ substr($transaction->created_at, 0, 10) }}</td>
                                        <td class="{{ $transaction->get_status_text_class() }}"><b> {{ $transaction->get_status() }}</b></td>
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
