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
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">Transaction Dialogues</div>
                            <div class="panel-body dialogues-panel" style="max-height: 400px;overflow-y: scroll;">
                                @if($transaction->dialogues()->count() > 0)
                                    @foreach($transaction->dialogues as $dialogue)
                                        <b>{{$dialogue->user->get_name()}}</b>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                Quantity: {{$dialogue->quantity}}<br>
                                                Total Price: {{$dialogue->total_price}}<br>
                                                <blockquote style="font-size:10pt">
                                                    {!! nl2br(e($dialogue->comment)) !!}
                                                </blockquote>
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3> Current Deal </h3>
                                <table class="table">
                                    <tr>
                                        <td width="20%">Quantity</td>
                                        <td>{{$transaction->quantity}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Price</td>
                                        <td>{{$transaction->total_price}}</td>
                                    </tr>
                                </table>

                                @if($transaction->status == 0)
                                    <center>
                                        <table class="table-condensed">
                                            <tr>
                                                @if($transaction->dialogues()->orderBy('created_at','desc')->first()->user->id != Auth::User()->id && Auth::User()->user_type != 0)
                                                    <td>
                                                        <input type="button" class="btn btn-success btn-sm" value="Approve Transaction" data-toggle="modal" data-target="#approveTransaction">
                                                    
                                                        <div id="approveTransaction" class="modal fade" role="dialog">
                                                            <div class="modal-dialog">      
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-9">
                                                                                <p>You are about to approve a transaction deal.</p>
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
                                                                                                <input type="submit" class="btn btn-primary btn-md" value="Continue">
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
                                                @endif
                                                @if(Auth::User()->user_type == 2)
                                                <td>
                                                    <input type="button" class="btn btn-danger btn-sm" value="Reject Transaction" data-toggle="modal" data-target="#cancelTransaction">
                                                    
                                                    <div id="cancelTransaction" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">      
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <p>
                                                                                You are about to reject a transaction. <br>
                                                                                If you don't agree with the current deal, you can suggest another one instead of rejecting the transaction.
                                                                            </p>
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
                                                                                            <input type="submit" class="btn btn-primary btn-md" value="Continue">
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
                                                @endif
                                            </tr>
                                        </table><br>
                                    </center>
                                @endif
                            </div>
                        </div>


                        @if($transaction->status == 0 && Auth::User()->user_type != 0)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('transaction.add_deal') }}">
                                        {!! csrf_field() !!}

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Quantity</label>

                                            <div class="col-md-4 col-md-offset-1">
                                                <input type="number" class="form-control" name="quantity" min="1" value="{{$transaction->quantity}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Total Price</label>

                                            <div class="col-md-4 col-md-offset-1">
                                                <input type="number" class="form-control" name="total_price" min="1" value="{{$transaction->total_price}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Comment</label>

                                            <div class="col-md-6 col-md-offset-1">
                                                <textarea class="form-control" rows="4" name="comment"></textarea>
                                            </div>
                                        </div>

                                        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

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
                        @else
                            Transaction status: <i class="{{ $transaction->get_status_text_class() }}"><b> {{ $transaction->get_status() }}</b></i>
                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">Product Information</div>
                        <div class="panel-body">
                            <center>
                                @if(isset($transaction->product->images()->first()->id))
                                    <img class="img-rounded" src="/images/uploads/{{$transaction->product->images()->first()->file_name}}" width="190" height="120" style = "height: 150px;">
                                @else
                                    @if($transaction->product->animal_type == 1)
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
                                    <td>Type</td>
                                    <td>{{ $transaction->product->get_animal_type() }}</td>
                                </tr>
                                <tr>
                                    <td>Breed</td>
                                    <td>{{ $transaction->product->breed }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $transaction->product->name }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>{{ $transaction->product->price }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        @if($transaction->product->fixed_price == 0)
                                            Negotiable Price
                                        @else
                                            Fixed Price
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>{{ $transaction->product->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $transaction->product->description }}</td>
                                </tr>
                                <tr>
                                    <td>Retailer</td>
                                    <td>
                                        <a href="{{ route('retailer.view', $transaction->product->user->id) }}"> {{ $transaction->product->user->get_name() }} </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-user"></span>
                            Retailer Information
                        </div>
                        <div class="panel-body">
                            <center>
                                @if($transaction->retailer->images()->count() > 0)
                                    <img src="/images/uploads/{{$transaction->retailer->images()->where('is_primary', 1)->first()->file_name}}" height="150" style = "height: 150px;">

                                @else
                                    <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" height="150">
                                @endif
                            </center>
                            <table class="table">
                                <tr>
                                    <td width="20%">Name</td>
                                    <td>{{ $transaction->retailer->get_name() }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @if($transaction->retailer->user_type == 2)
                                            Approved
                                        @else
                                            Unapproved
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $transaction->retailer->email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{ $transaction->retailer->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Region</td>
                                    <td>{{ $transaction->retailer->region }}</td>
                                </tr>
                                <tr>
                                    <td>Province</td>
                                    <td>{{ $transaction->retailer->province }}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{ $transaction->retailer->city }}</td>
                                </tr>
                                <tr>
                                    <td>Joined</td>
                                    <td>{{ $transaction->retailer->created_at->toDateString() }}</td>
                                </tr>
                                <tr>
                                    <td>Products</td>
                                    <td>{{ $transaction->retailer->products->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $transaction->retailer->description }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        var d = $('.dialogues-panel');
        d.scrollTop(d.prop("scrollHeight"));
    });
</script>

@endsection
