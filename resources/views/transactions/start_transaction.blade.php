@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">Start Transaction</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('transaction.start_deal') }}">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Quantity</label>

                                    <div class="col-md-4 col-md-offset-1">
                                        <input type="number" class="form-control" name="quantity" max="{{ $product->quantity }}" min="1" value="1">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Total Price</label>

                                    <div class="col-md-4 col-md-offset-1">
                                        <input type="number" class="form-control" name="total_price" min="1" value="{{$product->price}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Comment</label>

                                    <div class="col-md-6 col-md-offset-1">
                                        <textarea class="form-control" rows="4" name="comment"></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <input type="hidden" name="product_name" value="{{ $product->name }}">

                                <input type="hidden" name="retailer_id" value="{{ $product->user->id }}">

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Suggest Deal
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">Product Information</div>
                        <div class="panel-body">
                            <center>
                                @if(isset($product->images()->first()->id))
                                    <img class="img-rounded" src="/images/uploads/{{$product->images()->first()->file_name}}" width="190" height="120">
                                @else
                                    @if($product->animal_type == 1)
                                        <img class="img-rounded" src="{{ asset('images/chicken.png') }}" alt="chicken"height="120">
                                    @elseif($transaction->product->animal_type == 2)
                                        <img class="img-rounded" src="{{ asset('images/cow.png') }}" alt="cow" height="120">
                                    @elseif($transaction->product->animal_type == 3)
                                        <img class="img-rounded" src="{{ asset('images/goat.png') }}" alt="goat" height="120">
                                    @elseif($transaction->product->animal_type == 4)
                                        <img class="img-rounded" src="{{ asset('images/pig.png') }}" alt="pig" height="120">
                                    @endif
                                @endif
                            </center>
                            <table class="table table-condensed">
                                <tr>
                                    <td width="20%">Type</td>
                                    <td>{{ $product->get_animal_type() }}</td>
                                </tr>
                                <tr>
                                    <td>Breed</td>
                                    <td>{{ $product->breed }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>{{ $product->price }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        @if($product->fixed_price == 0)
                                            Negotiable Price
                                        @else
                                            Fixed Price
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <td>Retailer</td>
                                    <td>
                                        <a href="{{ route('retailer.view', $product->user->id) }}"> {{ $product->user->get_name() }} </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection