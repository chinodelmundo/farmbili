<td>
    @if($product->user->user_type == 2)
        @if (Auth::guest())
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#buy{{$product->id}}"> Add to Cart <span class="fa fa-shopping-cart"> </span></a>
                
            <div id="buy{{$product->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">      
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <h4 class="page-header"> Add to Cart </h4>
                                </div>
                            </div>
                            <div class="row">
                                @if($product->fixed_price == 1)
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('guest.buy') }}">
                                        {!! csrf_field() !!}

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Quantity</label>

                                            <div class="col-md-4 col-md-offset-1">
                                                <input type="number" class="form-control" name="quantity" max="{{ $product->quantity }}" min="1" value="1">
                                            </div>
                                        </div>

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"> Submit </button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('guest.deal') }}">
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
                                                <input type="number" step="any" min="1" class="form-control" name="total_price">
                                            </div>
                                        </div>

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"> Submit </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @if(Auth::User()->user_type == 1)    
                @if($product->fixed_price == 0)   
                    <a href="{{ route('transaction.deal', $product->id) }}" class="btn btn-primary btn-sm"><span class="fa fa-shopping-cart"></span> Add to Cart</a>
                @else
                    <a href="{{ route('product.buy', $product->id) }}" class="btn btn-primary btn-sm"><span class="fa fa-shopping-cart"></span> Add to Cart</a>
                @endif
            @endif
        @endif
    @endif
</td>