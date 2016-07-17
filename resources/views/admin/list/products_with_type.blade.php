@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <h3 class="page-header">
                @if($animal_type == 1)
                    Chickens
                @elseif($animal_type == 2)
                    Cows
                @elseif($animal_type == 3)
                    Goats
                @elseif($animal_type == 4)
                    Pigs
                @endif
            </h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($products->count() > 0)
                        <table class="table table-striped table-hover table-bordered table-condensed" id="products-table" data-order='[[ 1, "asc" ]]'>
                            <thead>    
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Breed</th>
                                    <th>Price</th>
                                    <th>Weight</th>
                                    <th>Gender</th>
                                    <th>Retailer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            @if(isset($product->images()->first()->id))
                                                <a href="#" data-toggle="modal" data-target="#imageModal{{$product->id}}">
                                                    <img class="img-rounded" src="/images/uploads/{{$product->images()->first()->file_name}}" width="100" height="80">
                                                </a>
                                                <div id="imageModal{{$product->id}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">     
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <img class="img-rounded" src="/images/uploads/{{$product->images()->first()->file_name}}" width="100%" height="100%">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @if($product->animal_type == 1)
                                                    <img class="img-rounded" src="{{ asset('images/chicken.png') }}" alt="chicken"height="80" width="100">
                                                @elseif($product->animal_type == 2)
                                                    <img class="img-rounded" src="{{ asset('images/cow.png') }}" alt="cow" height="80" width="100">
                                                @elseif($product->animal_type == 3)
                                                    <img class="img-rounded" src="{{ asset('images/goat.png') }}" alt="goat" height="80" width="100">
                                                @elseif($product->animal_type == 4)
                                                    <img class="img-rounded" src="{{ asset('images/pig.png') }}" alt="pig" height="80" width="100">
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('product.show', $product->id) }}"> {{ $product->name }} </a>
                                        </td>
                                        <td>{{ $product->breed }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->weight }} kg</td>
                                        <td>{{ $product->gender }}</td>
                                        <td>
                                            <a href="{{ route('retailer.view', $product->user->id) }}"> {{ $product->user->get_name() }} </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#products-table').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 0}
        ]
    });
} );
</script>
@endsection
