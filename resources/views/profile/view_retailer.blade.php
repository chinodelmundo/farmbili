@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"> 
            @if (Auth::guest())
                <div class="col-md-4">
                    @include('search.searchbar')
                </div>
                <div class="col-md-8">
            @else
                <div class="col-md-2">
                    @include('layouts.sidebar')
                </div>
                <div class="col-md-10">
            @endif

            @include('layouts.statusmessage')

            <div class="row">
                @if (Auth::guest())
                    <div class="col-md-7">
                @else
                    <div class="col-md-6">
                @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-user"></span>
                            {{$retailer->get_name()}}
                        </div>
                        <div class="panel-body">
                            <center>
                                @if($retailer->images()->count() > 0)
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @foreach($retailer->images as $image)
                                                <div class="item @if($image->id == $retailer->images()->where('is_primary', 1)->first()->id) active @endif">
                                                    <img src="/images/uploads/{{$image->file_name}}" height="150">
                                                </div>
                                            @endforeach
                                        </div>

                                        @if($retailer->images()->count() > 1)
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
                                        <td width="20%"> Status</td>
                                        <td class="{{$retailer->get_status_text_class()}}">
                                            @if($retailer->user_type == 2)
                                                Approved
                                            @else
                                                Unapproved
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $retailer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td> {{ $retailer->phone }} </td>
                                    </tr>
                                    <tr>
                                        <td>Region</td>
                                        <td>{{ $retailer->region }}</td>
                                    </tr>
                                    <tr>
                                        <td>Province</td>
                                        <td>{{ $retailer->province }}</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>{{ $retailer->city }}</td>
                                    </tr>
                                    <tr>
                                        <td>Joined</td>
                                        <td>{{ $retailer->created_at->toDateString() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Products</td>
                                        <td>{{ $retailer->products->count() }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            @if(Auth::Guest())
                            @elseif(Auth::User()->user_type == 0)
                                <table class="table-condensed">
                                    <tr>
                                        <td>
                                            @if($retailer->user_type == 2)
                                                <form  method="POST" action="{{ route('retailer.unapprove', $retailer->id) }}">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-danger btn-sm" value="Unapprove">
                                                </form>
                                            @else
                                                <form  method="POST" action="{{ route('retailer.approve', $retailer->id) }}">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-success btn-sm" value="Approve">
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('profile.edit', $retailer->id) }}" class="btn btn-primary btn-sm"> Edit </a>
                                        </td>
                                    </tr>
                                </table>
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
                                    <br>
                                    <a href="{{route('activities.all', $retailer->id)}}" class="btn btn-primary btn-sm">View All</a>
                                @else 
                                    No activities.
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::guest())
                    <div class="col-md-5">
                @else
                    <div class="col-md-6">
                @endif
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="page-header"><b>Rating:</b></h4> <div id="rating"></div>({{ $retailer->ratings()->avg('rate') + 0 }}/5)
                        </div>
                    </div>
                </div>
                @if (Auth::guest())
                    <div class="col-md-5">
                @else
                    <div class="col-md-6">
                @endif
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="page-header"><b>Retailer Description</b></h4>
                            {!! nl2br(e($retailer->description)) !!}
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::Guest())
            @else
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
            @endif

            <div class="panel panel-default">
                    <div class="panel-heading">
                        Comments
                    </div>
                    <div class="panel-body">
                        @if($retailer->ratings()->where('comment', '!=', '')->count() > 0)
                            <table class="table table-hover table-condensed" id="comments-table" width="100%">
                                <thead>    
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($retailer->ratings as $rating)
                                        <tr>
                                            <td> 
                                                <blockquote style="font-size:10pt">
                                                    {{$rating->comment}}
                                                    <small>
                                                        <cite>{{$rating->buyer->get_name()}}</cite>
                                                    </small>
                                                </blockquote>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            No Comments.
                        @endif
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"> Products </div>
                    <div class="panel-body">
                        @if($products->count() > 0)
                                @foreach($products as $product)
                                    @if(Auth::Guest())
                                        <div class="col-md-6">
                                    @else
                                        <div class="col-md-4">
                                    @endif
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <center>
                                                    @if(isset($product->images()->first()->id))
                                                        <img class="img-rounded" src="/images/uploads/{{$product->images()->first()->file_name}}" style="width:150px; height:110px; margin-bottom: 10px;">
                                                    @else
                                                        @if($product->animal_type == 1)
                                                            <img class="img-rounded" src="{{ asset('images/chicken.png') }}" alt="chicken"height="120" style="width:150px; height:110px; margin-bottom: 10px;">
                                                        @elseif($product->animal_type == 2)
                                                            <img class="img-rounded" src="{{ asset('images/cow.png') }}" alt="cow" height="120" style="width:150px; height:110px; margin-bottom: 10px;">
                                                        @elseif($product->animal_type == 3)
                                                            <img class="img-rounded" src="{{ asset('images/goat.png') }}" alt="goat" height="120" style="width:150px; height:110px; margin-bottom: 10px;">
                                                        @elseif($product->animal_type == 4)
                                                            <img class="img-rounded" src="{{ asset('images/pig.png') }}" alt="pig" height="120" style="width:150px; height:110px; margin-bottom: 10px;">
                                                        @endif
                                                    @endif
                                                </center>
                                                <table class="table table-condensed table-custom">
                                                    <tr>
                                                        <td width="35%">Type</td>
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
                                                        <td>Qty</td>
                                                        <td>{{ $product->quantity }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <table class="table-condensed">
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-sm"> View </a>
                                                                    </td>

                                                                    @include('layouts.add_to_cart')

                                                                    @if(Auth::Guest())
                                                                    @else
                                                                        @if(Auth::User()->id == $retailer->id || Auth::User()->user_type == 0)    
                                                                            <td>
                                                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm"> Edit </a>
                                                                            </td>
                                                                        @endif
                                                                    @endif
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        @else
                            No Products.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#transactions-table').DataTable({
        ordering : false,
        searching: false,
        pagingType: 'simple'
    });
    $('#comments-table').DataTable({
        ordering : false,
        searching: false,
        pagingType: 'simple'
    });
    $('#rating').raty({
        path: function() {
            return '/images';
        },
        readOnly: true,
        score: {{ $retailer->ratings()->avg('rate') + 0 }},
        hints: ['','','','','']
    });
});
</script>
@endsection
