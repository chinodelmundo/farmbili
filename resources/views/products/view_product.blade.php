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

                @if(Auth::Guest() || $product->user->id != Auth::User()->id)
                    <div class="col-md-7">
                @else
                    <div class="col-md-6">
                @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">{{$product->name}}</div>
                        <div class="panel-body">
                            <center>
                                @if($product->images()->count() > 0)
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @foreach($product->images as $image)
                                                <div class="item @if($image->id == $product->images()->first()->id) active @endif">
                                                    <img src="/images/uploads/{{$image->file_name}}" width="300" height="200">
                                                </div>
                                            @endforeach
                                        </div>

                                        @if($product->images()->count() > 1)
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
                                    @if($product->animal_type == 1)
                                        <img class="img-rounded" src="{{ asset('images/chicken.png') }}" alt="chicken" height="150">
                                    @elseif($product->animal_type == 2)
                                        <img class="img-rounded" src="{{ asset('images/cow.png') }}" alt="cow" height="150">
                                    @elseif($product->animal_type == 3)
                                        <img class="img-rounded" src="{{ asset('images/goat.png') }}" alt="goat" height="150">
                                    @elseif($product->animal_type == 4)
                                        <img class="img-rounded" src="{{ asset('images/pig.png') }}" alt="pig" height="150">
                                    @endif
                                @endif
                            </center><br>
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
                                    <td>Weight</td>
                                    <td>{{ $product->weight }} kg</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>{{ $product->gender }}</td>
                                </tr>
                                <tr>
                                    <td>Retailer</td>
                                    <td>
                                        <a href="{{ route('retailer.view', $product->user->id) }}"> {{ $product->user->get_name() }} </a>
                                    </td>
                                </tr>
                            </table>
                            <table class="table-condensed">
                                <tr>
                                    @include('layouts.add_to_cart')
                                    @if(Auth::Guest())
                                    @else
                                        @if(Auth::User()->id == $product->user->id || Auth::User()->user_type == 0)    
                                            <td>
                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm"> Edit </a>
                                            </td>
                                        @endif

                                        @if(Auth::User()->id == $product->user->id) 
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadModal"> Upload Photo </a>

                                                <div id="uploadModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">     
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row no-gutter">
                                                                    <div class="col-md-9">
                                                                        <form class="form-horizontal" role="form" method="POST" action="{{ route('image.upload_product') }}" enctype="multipart/form-data">
                                                                            {!! csrf_field() !!}

                                                                            <div class="form-group">
                                                                                <label class="col-md-4 control-label">Image</label>

                                                                                <div class="col-md-8">
                                                                                    <input type="file" class="form-control" name="image">
                                                                                </div>
                                                                            </div>

                                                                            <input type="hidden" name="product_id" value="{{$product->id}}">

                                                                            <div class="form-group">
                                                                                <div class="col-md-6 col-md-offset-4">
                                                                                    <button type="submit" class="btn btn-primary">
                                                                                        Upload
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                @if(Auth::Guest() || $product->user->id != Auth::User()->id)
                    @if(Auth::Guest())
                        <div class="col-md-5">
                    @else
                        <div class="col-md-4">
                    @endif
                        <div class="panel panel-default">
                            <div class="panel-heading">Photos</div>
                            <div class="panel-body">
                                @if($product->images()->count() > 0)
                                    <div class="row">
                                        <div class="image-container">
                                            <?php $num = 0; ?>
                                            @foreach($product->images as $image)
                                                <div class="col-md-6">
                                                    <div class="images">
                                                        <a href="#" data-target="#myCarousel" data-slide-to="{{$num}}"><img src="/images/uploads/{{$image->file_name}}" class="img-rounded" style="width:100px; height:80px; margin: 10px;"></a>
                                                    </div>
                                                </div>
                                                <?php $num += 1; ?>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    No Photos.
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Photos</div>
                            <div class="panel-body">
                                @if($product->images()->count() > 0)
                                    <div class="row">
                                        <div class="image-container">
                                            @foreach($product->images as $image)
                                                <div class="col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <center>
                                                            <img src="/images/uploads/{{$image->file_name}}" class="img-thumbnail" width="100" height="80" style="width:150px; height:120px;"><br><br>
                                                            <div class="row">
                                                                <div class="col-md-5 col-md-offset-1">
                                                                    <form  method="POST" action="{{ route('image.primary_product', $image->id, $product->id) }}">
                                                                        <input type="hidden" name="_method" value="PUT">
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <button type="submit" class="btn btn-sm" data-toggle="tooltip" title="@if($image->is_primary == 0) Set as @endif Primary Photo" @if($image->is_primary == 1) disabled @endif><i class="fa fa-check-square-o"></i></button>
                                                                    </form>
                                                                </div>

                                                                <div class="col-md-5">
                                                                    <button class="btn btn-sm" data-toggle="modal" title="Delete Photo" data-target="#delete{{$image->id}}"><i class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Photo"></i></button>
                                                                    
                                                                    <div id="delete{{$image->id}}" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog">      
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    @if($image->is_primary != 1)
                                                                                        <p>You are about to delete an image.</p>
                                                                                        <table class="table-condensed">
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <form  method="POST" action="{{ route('image.delete_product_image', $image->id) }}">
                                                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                                        <input type="submit" class="btn btn-primary btn-sm" value="Continue">
                                                                                                    </form>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    @else
                                                                                        <p>Cannot delete primary photo.<br>Set another photo as primary first.</p>
                                                                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    No Photos.
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if(Auth::Guest() || $product->user->id != Auth::User()->id)
                    @if(Auth::Guest())
                        <div class="col-md-5">
                    @else
                        <div class="col-md-4">
                    @endif
                @else
                    <div class="col-md-6">
                @endif
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="page-header"><b>Product Description</b></h4>
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Transactions</div>
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
                                                <td class="{{ $transaction->get_status_text_class() }}"> <b> {{ $transaction->get_status() }}</b></td>
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
