@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>
        
        <div class="col-md-10">
            <h3 class="page-header"><span class="fa fa-paw"></span> Products</h3>
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ route('product.create') }}" class="btn btn-success btn-md">
                        <span class="glyphicon glyphicon-plus"></span> Add Product
                    </a>
                </div>

                <div class="col-md-8 col-md-offset-2">
                    <form  method="POST" action="{{ route('product.order') }}">
                        <div class="form-horizontal" >
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-3 control-label">Order By</div>
                                <div class="col-md-4">
                                    <select class="form-control" name="order_by" onchange="this.form.submit()">
                                        <option value="1" @if(isset($order_by) && $order_by == 1) selected @endif >Name</option>
                                        <option value="2" @if(isset($order_by) && $order_by == 2) selected @endif >Animal Type</option>
                                        <option value="3" @if(isset($order_by) && $order_by == 3) selected @endif >Price</option>
                                        <option value="4" @if(isset($order_by) && $order_by == 4) selected @endif >Quantity</option>
                                        <option value="5" @if(isset($order_by) && $order_by == 5) selected @endif >Date Added</option>
                                    </select>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($products->count() > 0)
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <center>
                                            @if(isset($product->images()->first()->id))
                                                <img class="img-rounded" src="/images/uploads/{{$product->images()->first()->file_name}}" width="190" height="120" style="width:150px; height:110px; margin-bottom: 10px;">
                                            @else
                                                @if($product->animal_type == 1)
                                                    <img class="img-rounded" src="{{ asset('images/chicken.png') }}" alt="chicken"height="120" style="width:150px; height:110px; margin-bottom: 10px;">
}">
                                                @elseif($product->animal_type == 2)
                                                    <img class="img-rounded" src="{{ asset('images/cow.png') }}" alt="cow" height="120" style="width:150px; height:110px; margin-bottom: 10px;">
                                                @elseif($product->animal_type == 3)
                                                    <img class="img-rounded" src="{{ asset('images/goat.png') }}" alt="goat" height="120" style="width:150px; height:110px; margin-bottom: 10px;">
                                                @elseif($product->animal_type == 4)
                                                    <img class="img-rounded" src="{{ asset('images/pig.png') }}" alt="pig" height="120" style="width:150px; height:110px; margin-bottom: 10px;">
                                                @endif
                                            @endif
                                        </center>
                                        <table class="table table-custom">
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
                                                <td>Quantity</td>
                                                <td>{{ $product->quantity }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table class="table-condensed">
                                                        <tr>
                                                            <td>
                                                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-sm"> View </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm"> Edit </a>
                                                            </td>
                                                            <td>
                                                                <input type="button" class="btn btn-danger btn-sm" value="Delete" data-toggle="modal" data-target="#delete{{$product->id}}">
                                
                                                                <div id="delete{{$product->id}}" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">      
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-9">
                                                                                        <p>You are about to delete a product.</p>
                                                                                        <p>Product Name: {{$product->name}}</p>
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
                                                                                                    <form  method="POST" action="{{ route('product.destroy', $product->id) }}">
                                                                                                        <input type="hidden" name="_method" value="DELETE">
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
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <center> No Products. </center>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
