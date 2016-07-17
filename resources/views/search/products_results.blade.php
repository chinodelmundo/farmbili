
<div class="row">
    <div class="col-md-3 col-md-offset-10">
        <button class="btn" id="grid-view-btn" data-toggle="tooltip" title="Grid View" style="padding: 3px; padding-left:5px; padding-right:5px; padding-bottom: 3px;border-color:#cccccc;">
            <div class ="white-button">
                <i class="fa fa-th fa-2x"></i>
            </div>  
        </button>
        
             &nbsp;
        <button class="btn" id="list-view-btn" data-toggle="tooltip" title="List View" style="padding: 3px; padding-left:5px; padding-right:5px; padding-bottom: 3px;border-color:#cccccc;">
            <div class ="white-button">
                <i class="fa fa-align-justify fa-2x"></i>
            </div>
        </button>
        <p></p>
    </div>
</div>

<div class="panel panel-default" id="grid-panel">
    <div class="panel-heading">Search Results: {{ $products->count() }} found</div>
    <div class="panel-body">
        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <center>
                                @if(isset($product->images()->first()->id))
                                    <a href="#" data-toggle="modal" data-target="#imageModal1{{$product->id}}">
                                        <img class="img-rounded" src="/images/uploads/{{$product->images()->first()->file_name}}" width="180px" height="100px" style="height: 150px; margin-bottom: 10px;">
                                    </a>
                                    <div id="imageModal1{{$product->id}}" class="modal fade" role="dialog">
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
                                        <img class="img-rounded" src="{{ asset('images/chicken.png') }}" alt="chicken"height="100px" style="height: 150px; margin-bottom: 10px;">
                                    @elseif($product->animal_type == 2)
                                        <img class="img-rounded" src="{{ asset('images/cow.png') }}" alt="cow" height="100px" style="height: 150px; margin-bottom: 10px;">
                                    @elseif($product->animal_type == 3)
                                        <img class="img-rounded" src="{{ asset('images/goat.png') }}" alt="goat" height="100px" style="height: 150px; margin-bottom: 10px;">
                                    @elseif($product->animal_type == 4)
                                        <img class="img-rounded" src="{{ asset('images/pig.png') }}" alt="pig" height="100px" style="height: 150px; margin-bottom: 10px;">
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
                                    <td>Quantity</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Retailer</td>
                                    <td>
                                        <a href="{{ route('retailer.view', $product->user->id) }}"> {{ $product->user->get_name() }} </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table class="table-condensed">
                                            <tr>
                                                <td>
                                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-sm darkred-btn" style="width: 100%"> View </a>
                                                </td>
                                                @include('layouts.add_to_cart')
                                                
                                                @if (Auth::guest())
                                                @else
                                                    @if(Auth::User()->id == $product->user_id || Auth::User()->user_type == 0)    
                                                        <td>
                                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm yellow-btn" style="width:100%"> Edit </a>
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
            No Products found.
        @endif
    </div>
</div>
<div class="panel panel-default" id="list-panel">
    <div class="panel-heading">
        Search Results
    </div>
    <div class="panel-body">
        @if($products->count() > 0)
            <table class="table table-striped table-hover table-bordered" id="products-table" data-order='[[ 1, "asc" ]]'>
                <thead>    
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th width="15%">Animal</th>
                        <th>Breed</th>
                        <th>Price</th>
                        <th>Retailer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                @if(isset($product->images()->first()->id))
                                    <a href="#" data-toggle="modal" data-target="#imageModal{{$product->id}}">
                                        <img class="img-rounded" src="/images/uploads/{{$product->images()->first()->file_name}}" width="80" height="60" style="height: 125px; margin-bottom: 10px;">
                                    </a>
                                    <div id="imageModal{{$product->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">     
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img class="img-rounded" src="/images/uploads/{{$product->images()->first()->file_name}}" width="100%" height="100%" >
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
                                        <img class="img-rounded" src="{{ asset('images/chicken.png') }}" alt="chicken" width="80" height="60" style="height: 125px; margin-bottom: 10px;">
                                    @elseif($product->animal_type == 2)
                                        <img class="img-rounded" src="{{ asset('images/cow.png') }}" alt="cow" width="80" height="60" style="height: 125px; margin-bottom: 10px;">
                                    @elseif($product->animal_type == 3)
                                        <img class="img-rounded" src="{{ asset('images/goat.png') }}" alt="goat" width="80" height="60" style="height: 125px; margin-bottom: 10px;">
                                    @elseif($product->animal_type == 4)
                                        <img class="img-rounded" src="{{ asset('images/pig.png') }}" alt="pig" width="80" height="60" style="height: 125px; margin-bottom: 10px;">
                                    @endif
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('product.show', $product->id) }}"> {{ $product->name }} </a>
                            </td>
                            <td>{{ $product->get_animal_type() }}</td>
                            <td>{{ $product->breed }}</td>
                            <td align="right">{{ $product->price }}</td>
                            <td>
                                <a href="{{ route('retailer.view', $product->user->id) }}"> {{ $product->user->get_name() }} </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            No Products found.
        @endif
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#products-table').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 0}
            ]
        });

        $('#list-panel').hide();

        $('#list-view-btn').on('click', function() {
            $('#grid-panel').hide();
            $('#list-panel').show();
        });

        $('#grid-view-btn').on('click', function() {
            $('#list-panel').hide();
            $('#grid-panel').show();
        });

        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>