@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Add Product</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                       
                        <div class="form-group">
                            <label class="col-md-4 control-label">Animal Type</label>

                            <div class="col-md-6">
                                  <select id="animal_type" class="form-control" name="animal_type" value="1">
                                    <option value="1">Chicken</option>
                                    <option value="2">Cow</option>
                                    <option value="3">Goat</option>
                                    <option value="4">Pig</option>
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
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input type="number" step="any" min="0" class="form-control" name="price">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <label class="checkbox-inline"><input type="checkbox" name="fixed_price" checked>Fixed Price</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Quantity</label>

                            <div class="col-md-6">
                                <input type="number" min="1" class="form-control" name="quantity">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Weight (kg)</label>

                            <div class="col-md-6">
                                <input type="number" min="0" step="any" class="form-control" name="weight">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <select class="form-control" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="4" name="description"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
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

    $(".chicken-breed").show();
    $(".cow-breed").hide();
    $(".goat-breed").hide();
    $(".pig-breed").hide();

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