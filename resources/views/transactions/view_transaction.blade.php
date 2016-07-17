@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header"> Transaction Details </h3>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if(isset($transaction))
                        <table class="table table-striped table-hover table-bordered">
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
                                <tr>
                                    <td> 
                                        <a href="{{ route('buyer.view', $transaction->user->id) }}"> {{ $transaction->user->get_name() }} </a>
                                    </td>
                                    <td> 
                                        <a href="{{ route('product.show', $transaction->product->id) }}"> {{ $transaction->product->name }} </a>
                                    </td>
                                    <td> 
                                        <a href="{{ route('retailer.view', $transaction->product->user->id) }}"> {{ $transaction->product->user->get_name() }} </a> 
                                    </td>
                                    <td> {{ $transaction->quantity }}</td>
                                    <td> {{ $transaction->created_at }}</td>
                                    <td class="{{ $transaction->get_status_text_class() }}"><b> {{ $transaction->get_status() }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        Transaction not found.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
