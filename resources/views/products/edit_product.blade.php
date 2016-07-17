@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Product</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('product.update', $product->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Animal Type</label>

                            <div class="col-md-6">
                                  <select id="animal_type" class="form-control" name="animal_type">
                                    <option value="1" @if($product->animal_type == 1) selected @endif >Chicken</option>
                                    <option value="2" @if($product->animal_type == 2) selected @endif >Cow</option>
                                    <option value="3" @if($product->animal_type == 3) selected @endif>Goat</option>
                                    <option value="4" @if($product->animal_type == 4) selected @endif>Pig</option>
                                  </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Breed</label>

                            <div class="col-md-6">
                                <select id="breed-list" class="form-control" name="breed">
                                    <option class="chicken-breed" value="Banaba">Banaba</option>
                                    <option class="chicken-breed" value="Bolinao">Bolinao</option>
                                    <option class="chicken-breed" value="Camarines">Camarines</option>
                                    <option class="chicken-breed" value="Darag">Darag</option>
                                    <option class="chicken-breed" value="Joloanon">Joloanon</option>
                                    <option class="chicken-breed" value="Paraoakan">Paraoakan</option>
                                    <option class="cow-breed" value="Banteng">Banteng</option>
                                    <option class="cow-breed" value="Brahman">Brahman</option>
                                    <option class="cow-breed" value="Brown Swiss">Brown Swiss</option>
                                    <option class="cow-breed" value="Holstein Friesian">Holstein Friesian</option>
                                    <option class="cow-breed" value="Ongole">Ongole</option>
                                    <option class="cow-breed" value="Red Sindhi">Red Sindhi</option>
                                    <option class="cow-breed" value="Sahiwal">Sahiwal</option>
                                    <option class="cow-breed" value="Santa Gertrudis">Santa Gertrudis</option>
                                    <option class="cow-breed" value="Tharparkar">Tharparkar</option>
                                    <option class="goat-breed" value="Boer">Boer</option>
                                    <option class="goat-breed" value="Pygmy">Pygmy</option>
                                    <option class="goat-breed" value="Saanen">Saanen</option>
                                    <option class="pig-breed" value="Berkshire">Berkshire</option>
                                    <option class="pig-breed" value="Duroc">Duroc</option>
                                    <option class="pig-breed" value="Shato">Shato</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input type="number" step="any" min="0" class="form-control" name="price" value="{{ $product->price }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Quantity</label>

                            <div class="col-md-6">
                                <input type="number" min="0" class="form-control" name="quantity" value="{{ $product->quantity }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Weight (kg)</label>

                            <div class="col-md-6">
                                <input type="number" min="0" step="any" class="form-control" name="weight" value="{{ $product->weight }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <select class="form-control" name="gender">
                                    <option value="Male" @if($product->gender == "Male") selected @endif >Male</option>
                                    <option value="Female" @if($product->gender == "Female") selected @endif >Female</option>
                                  </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="4" name="description">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $('#breed-list').val("{{$product->breed}}")

    $(".chicken-breed").hide();
    $(".cow-breed").hide();
    $(".goat-breed").hide();
    $(".pig-breed").hide();

    switch($('#animal_type').val()) {
        case "1":
            $(".chicken-breed").show();
            break;
        case "2":
            $(".cow-breed").show();
            break;
        case "3":
            $(".goat-breed").show();
            break;
        case "4":
            $(".pig-breed").show();
            break;
    }

    $('#animal_type').on('change', function() {

        $(".chicken-breed").hide();
        $(".cow-breed").hide();
        $(".goat-breed").hide();
        $(".pig-breed").hide();

        switch(this.value) {
            case "1":
                $("#breed-list").val("Banaba");
                $(".chicken-breed").show();
                break;
            case "2":
                $("#breed-list").val("Banteng");
                $(".cow-breed").show();
                break;
            case "3":
                $("#breed-list").val("Boer");
                $(".goat-breed").show();
                break;
            case "4":
                $("#breed-list").val("Duroc");
                $(".pig-breed").show();
                break;
        }
    });
});
</script>
@endsection
