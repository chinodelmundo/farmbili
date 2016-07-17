<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="glyphicon glyphicon-search"></span>
            Search
        </div>
    </div>
    <ul class="nav nav-tabs">
            <li class="@if(!isset($retailers) && !isset($buyers)) active @endif"><a data-toggle="tab" href="#products">Products</a></li>
            <li class="@if(isset($retailers)) active @endif"><a data-toggle="tab" href="#retailers">Retailers</a></li>
            @if (Auth::guest())
            @else
                <li class="@if(isset($buyers)) active @endif"><a data-toggle="tab" href="#buyers">Buyers</a></li>
            @endif
        </ul>
    <div class="panel-body">
        <div class="tab-content">
            <div id="products" class="tab-pane fade @if(!isset($retailers) && !isset($buyers)) in active @endif">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('search.product') }}" id="search_product">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Animal Type </label>

                        <div class="col-md-8">
                            <select id="animal_type" class="form-control" name="animal_type" value="0">
                                <option value="0"> Any Animal Type </option>
                                <option value="1"> Chicken </option>
                                <option value="2"> Cow </option>
                                <option value="3"> Goat </option>
                                <option value="4"> Pig </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Breed </label>

                        <div class="col-md-8">
                            <select id="breed-list" class="form-control" name="breed">
                                    <option value="">Any Breed</option>
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
                        <label class="col-md-4 control-label"> Product Name </label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" placeholder="Any Name" @if(isset($product_params)) value="{{$product_params[2]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class = "add-margin">
                            <label class="col-md-4 control-label"> Price Range </label>

                            <div class="col-md-3">
                                <input id="ex2" type="text" name="price" class="span2" value="" data-slider-min="0" data-slider-max="10000" data-slider-step="100" @if(isset($product_params)) data-slider-value="[{{$product_params[3]}},{{$product_params[4]}}]" @else data-slider-value="[0,7000]" @endif/>
                            </div>
                        </div>
                    </div>

                    <div data-toggle="collapse" data-target="#more">
                        <center>
                            <a href="#more">
                                More Options <span class="caret"></span>
                            </a>
                        </center>
                    </div>
                    <hr>
                    
                    <div id="more" class="collapse">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-4 control-label"> Region </label>

                                <div class="col-md-8">
                                    <select id="region-list"  class="form-control" name="region">
                                        <option value="">Any Region</option>
                                        <option value="ARMM">ARMM</option>
                                        <option value="CAR">CAR</option>
                                        <option value="NCR">NCR</option>
                                        <option value="Region 1">Region 1</option>
                                        <option value="Region 2">Region 2</option>
                                        <option value="Region 3">Region 3</option>
                                        <option value="Region 4a">Region 4a</option>
                                        <option value="Region 4b">Region 4b</option>
                                        <option value="Region 5">Region 5</option>
                                        <option value="Region 6">Region 6</option>
                                        <option value="Region 7">Region 7</option>
                                        <option value="Region 8">Region 8</option>
                                        <option value="Region 9">Region 9</option>
                                        <option value="Region 10">Region 10</option>
                                        <option value="Region 11">Region 11</option>
                                        <option value="Region 12">Region 12</option>
                                        <option value="Region 13">Region 13</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"> Province </label>

                                <div class="col-md-8">
                                    <select id="province-list"  class="form-control" name="province">
                                        <option value="">Any Province</option>
                                        <option class="region1" value="Illocos Norte">Illocos Norte</option>
                                        <option class="region1" value="Illocos Sur">Illocos Sur</option>
                                        <option class="region1" value="La Union">La Union</option>
                                        <option class="region1" value="Pangasinan">Pangasinan</option>
                                        <option class="region2" value="Batanes">Batanes</option>
                                        <option class="region2" value="Cagayan">Cagayan</option>
                                        <option class="region2" value="Isabela">Isabela</option>
                                        <option class="region2" value="Nueva Viscaya">Nueva Viscaya</option>
                                        <option class="region2" value="Quirino">Quirino</option>
                                        <option class="region3" value="Aurora">Aurora</option>
                                        <option class="region3" value="Bataan">Bataan</option>
                                        <option class="region3" value="Bulacan">Bulacan</option>
                                        <option class="region3" value="Nueva Ecija">Nueva Ecija</option>
                                        <option class="region3" value="Pampanga">Pampanga</option>
                                        <option class="region3" value="Tarlac">Tarlac</option>
                                        <option class="region3" value="Zambales">Zambales</option>
                                        <option class="region4a" value="Batangas">Batangas</option>
                                        <option class="region4a" value="Cavite">Cavite</option>
                                        <option class="region4a" value="Laguna">Laguna</option>
                                        <option class="region4a" value="Quezon">Quezon</option>
                                        <option class="region4a" value="Rizal">Rizal</option>
                                        <option class="region4b" value="Marinduque">Marinduque</option>
                                        <option class="region4b" value="Occidental Mindoro">Occidental Mindoro</option>
                                        <option class="region4b" value="Oriental Mindoro">Oriental Mindoro</option>
                                        <option class="region4b" value="Palawan">Palawan</option>
                                        <option class="region4b" value="Romblon">Romblon</option>
                                        <option class="region5" value="Albay">Albay</option>
                                        <option class="region5" value="Camarines Norte">Camarines Norte</option>
                                        <option class="region5" value="Camarines Sur">Camarines Sur</option>
                                        <option class="region5" value="Catanduanes">Catanduanes</option>
                                        <option class="region5" value="Masbate">Masbate</option>
                                        <option class="region5" value="Sorsogon">Sorsogon</option>
                                        <option class="region6" value="Aklan">Aklan</option>
                                        <option class="region6" value="Antique">Antique</option>
                                        <option class="region6" value="Capiz">Capiz</option>
                                        <option class="region6" value="Iloilo">Iloilo</option>
                                        <option class="region6" value="Guimaras">Guimaras</option>
                                        <option class="region6" value="Negros Occidental">Negros Occidental</option>
                                        <option class="region7" value="Bohol">Bohol</option>
                                        <option class="region7" value="Cebu">Cebu</option>
                                        <option class="region7" value="Guimaras">Guimaras</option>
                                        <option class="region7" value="Negro Oriental">Negro Oriental</option>
                                        <option class="region7" value="Siquijor">Siquijor</option>
                                        <option class="region8" value="Biliran">Biliran</option>
                                        <option class="region8" value="Eastern Samar">Eastern Samar</option>
                                        <option class="region8" value="Leyte">Leyte</option>
                                        <option class="region8" value="Northern Samar">Northern Samar</option>
                                        <option class="region8" value="Western Samar">Western Samar</option>
                                        <option class="region8" value="Southern Leyte">Southern Leyte</option>
                                        <option class="region9" value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                                        <option class="region9" value="Zamboanga del Norte">Zamboanga del Norte</option>
                                        <option class="region9" value="Zamboanga del Sur">Zamboanga del Sur</option>
                                        <option class="region10" value="Bukidnon">Bukidnon</option>
                                        <option class="region10" value="Camiguin">Camiguin</option>
                                        <option class="region10" value="Misamis Occidental">Misamis Occidental</option>
                                        <option class="region10" value="Msamis Oriental">Msamis Oriental</option>
                                        <option class="region10" value="Lanao del Norte">Lanao del Norte</option>
                                        <option class="region11" value="Davao del Norte">Davao del Norte</option>
                                        <option class="region11" value="Davao del Sur">Davao del Sur</option>
                                        <option class="region11" value="Davao Oriental">Davao Oriental</option>
                                        <option class="region11" value="Comostela Valley">Comostela Valley</option>
                                        <option class="region12" value="North Cotabato">North Cotabato</option>
                                        <option class="region12" value="Sultan Kudarat">Sultan Kudarat</option>
                                        <option class="region12" value="South Cotabato">South Cotabato</option>
                                        <option class="region12" value="Saranggani">Saranggani</option>
                                        <option class="region13" value="Agustan del Norte">Agustan del Norte</option>
                                        <option class="region13" value="Augustan del Sur">Augustan del Sur</option>
                                        <option class="region13" value="Suriago del Norte">Suriago del Norte</option>
                                        <option class="region13" value="Suriago del Sur">Suriago del Sur</option>
                                        <option class="regioncar" value="Abra">Abra</option>
                                        <option class="regioncar" value="Benguet">Benguet</option>
                                        <option class="regioncar" value="Ifugao">Ifugao</option>
                                        <option class="regioncar" value="Kalinga">Kalinga</option>
                                        <option class="regioncar" value="Apayao">Apayao</option>
                                        <option class="regioncar" value="Mountain Province">Mountain Province</option>
                                        <option class="regionarmm" value="Basilan">Basilan</option>
                                        <option class="regionarmm" value="Sulu">Sulu</option>
                                        <option class="regionarmm" value="Tawi-Tawi">Tawi-Tawi</option>
                                        <option class="regionarmm" value="Lanao del Sur">Lanao del Sur</option>
                                        <option class="regionarmm" value="Magrindanao">Magrindanao</option>
                                        <option class="regionncr" value="Manila">Manila</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"> City </label>

                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="city" placeholder="Any City" @if(isset($product_params)) value="{{$product_params[7]}}" @endif>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label"> Description </label>

                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="description" placeholder="Any Description" @if(isset($product_params)) value="{{$product_params[8]}}" @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button id="search-product-btn" type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="retailers" class="tab-pane fade @if(isset($retailers)) in active @endif">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('search.retailer') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-4 control-label"> First Name </label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="first_name" placeholder="Any Name" @if(isset($retailer_params)) value="{{$retailer_params[0]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Last Name </label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="last_name" placeholder="Any Name" @if(isset($retailer_params)) value="{{$retailer_params[1]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Region </label>

                        <div class="col-md-8">
                            <select id="retailer-region-list"  class="form-control" name="region">
                                <option value="">Any Region</option>
                                <option value="ARMM">ARMM</option>
                                <option value="CAR">CAR</option>
                                <option value="NCR">NCR</option>
                                <option value="Region 1">Region 1</option>
                                <option value="Region 2">Region 2</option>
                                <option value="Region 3">Region 3</option>
                                <option value="Region 4a">Region 4a</option>
                                <option value="Region 4b">Region 4b</option>
                                <option value="Region 5">Region 5</option>
                                <option value="Region 6">Region 6</option>
                                <option value="Region 7">Region 7</option>
                                <option value="Region 8">Region 8</option>
                                <option value="Region 9">Region 9</option>
                                <option value="Region 10">Region 10</option>
                                <option value="Region 11">Region 11</option>
                                <option value="Region 12">Region 12</option>
                                <option value="Region 13">Region 13</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Province </label>

                        <div class="col-md-8">
                            <select id="retailer-province-list"  class="form-control" name="province">
                                <option value="">Any Province</option>
                                <option class="region1" value="Illocos Norte">Illocos Norte</option>
                                <option class="region1" value="Illocos Sur">Illocos Sur</option>
                                <option class="region1" value="La Union">La Union</option>
                                <option class="region1" value="Pangasinan">Pangasinan</option>
                                <option class="region2" value="Batanes">Batanes</option>
                                <option class="region2" value="Cagayan">Cagayan</option>
                                <option class="region2" value="Isabela">Isabela</option>
                                <option class="region2" value="Nueva Viscaya">Nueva Viscaya</option>
                                <option class="region2" value="Quirino">Quirino</option>
                                <option class="region3" value="Aurora">Aurora</option>
                                <option class="region3" value="Bataan">Bataan</option>
                                <option class="region3" value="Bulacan">Bulacan</option>
                                <option class="region3" value="Nueva Ecija">Nueva Ecija</option>
                                <option class="region3" value="Pampanga">Pampanga</option>
                                <option class="region3" value="Tarlac">Tarlac</option>
                                <option class="region3" value="Zambales">Zambales</option>
                                <option class="region4a" value="Batangas">Batangas</option>
                                <option class="region4a" value="Cavite">Cavite</option>
                                <option class="region4a" value="Laguna">Laguna</option>
                                <option class="region4a" value="Quezon">Quezon</option>
                                <option class="region4a" value="Rizal">Rizal</option>
                                <option class="region4b" value="Marinduque">Marinduque</option>
                                <option class="region4b" value="Occidental Mindoro">Occidental Mindoro</option>
                                <option class="region4b" value="Oriental Mindoro">Oriental Mindoro</option>
                                <option class="region4b" value="Palawan">Palawan</option>
                                <option class="region4b" value="Romblon">Romblon</option>
                                <option class="region5" value="Albay">Albay</option>
                                <option class="region5" value="Camarines Norte">Camarines Norte</option>
                                <option class="region5" value="Camarines Sur">Camarines Sur</option>
                                <option class="region5" value="Catanduanes">Catanduanes</option>
                                <option class="region5" value="Masbate">Masbate</option>
                                <option class="region5" value="Sorsogon">Sorsogon</option>
                                <option class="region6" value="Aklan">Aklan</option>
                                <option class="region6" value="Antique">Antique</option>
                                <option class="region6" value="Capiz">Capiz</option>
                                <option class="region6" value="Iloilo">Iloilo</option>
                                <option class="region6" value="Guimaras">Guimaras</option>
                                <option class="region6" value="Negros Occidental">Negros Occidental</option>
                                <option class="region7" value="Bohol">Bohol</option>
                                <option class="region7" value="Cebu">Cebu</option>
                                <option class="region7" value="Guimaras">Guimaras</option>
                                <option class="region7" value="Negro Oriental">Negro Oriental</option>
                                <option class="region7" value="Siquijor">Siquijor</option>
                                <option class="region8" value="Biliran">Biliran</option>
                                <option class="region8" value="Eastern Samar">Eastern Samar</option>
                                <option class="region8" value="Leyte">Leyte</option>
                                <option class="region8" value="Northern Samar">Northern Samar</option>
                                <option class="region8" value="Western Samar">Western Samar</option>
                                <option class="region8" value="Southern Leyte">Southern Leyte</option>
                                <option class="region9" value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                                <option class="region9" value="Zamboanga del Norte">Zamboanga del Norte</option>
                                <option class="region9" value="Zamboanga del Sur">Zamboanga del Sur</option>
                                <option class="region10" value="Bukidnon">Bukidnon</option>
                                <option class="region10" value="Camiguin">Camiguin</option>
                                <option class="region10" value="Misamis Occidental">Misamis Occidental</option>
                                <option class="region10" value="Msamis Oriental">Msamis Oriental</option>
                                <option class="region10" value="Lanao del Norte">Lanao del Norte</option>
                                <option class="region11" value="Davao del Norte">Davao del Norte</option>
                                <option class="region11" value="Davao del Sur">Davao del Sur</option>
                                <option class="region11" value="Davao Oriental">Davao Oriental</option>
                                <option class="region11" value="Comostela Valley">Comostela Valley</option>
                                <option class="region12" value="North Cotabato">North Cotabato</option>
                                <option class="region12" value="Sultan Kudarat">Sultan Kudarat</option>
                                <option class="region12" value="South Cotabato">South Cotabato</option>
                                <option class="region12" value="Saranggani">Saranggani</option>
                                <option class="region13" value="Agustan del Norte">Agustan del Norte</option>
                                <option class="region13" value="Augustan del Sur">Augustan del Sur</option>
                                <option class="region13" value="Suriago del Norte">Suriago del Norte</option>
                                <option class="region13" value="Suriago del Sur">Suriago del Sur</option>
                                <option class="regioncar" value="Abra">Abra</option>
                                <option class="regioncar" value="Benguet">Benguet</option>
                                <option class="regioncar" value="Ifugao">Ifugao</option>
                                <option class="regioncar" value="Kalinga">Kalinga</option>
                                <option class="regioncar" value="Apayao">Apayao</option>
                                <option class="regioncar" value="Mountain Province">Mountain Province</option>
                                <option class="regionarmm" value="Basilan">Basilan</option>
                                <option class="regionarmm" value="Sulu">Sulu</option>
                                <option class="regionarmm" value="Tawi-Tawi">Tawi-Tawi</option>
                                <option class="regionarmm" value="Lanao del Sur">Lanao del Sur</option>
                                <option class="regionarmm" value="Magrindanao">Magrindanao</option>
                                <option class="regionncr" value="Manila">Manila</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> City </label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="city" placeholder="Any City" @if(isset($retailer_params)) value="{{$retailer_params[4]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Email </label>

                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email" placeholder="Any Email" @if(isset($retailer_params)) value="{{$retailer_params[5]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Description </label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="description" placeholder="Any Description" @if(isset($retailer_params)) value="{{$retailer_params[6]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Products </label>

                        <div class="col-md-8">
                            <label class="checkbox-inline"><input type="checkbox" name="has_chicken" @if(isset($retailer_params) && $retailer_params[7]) checked @endif>Chicken &nbsp</label>
                            <label align="right" class="checkbox-inline"><input type="checkbox" name="has_cow" @if(isset($retailer_params) && $retailer_params[8]) checked @endif>Cow</label><br>

                            <label class="checkbox-inline"><input type="checkbox" name="has_goat" @if(isset($retailer_params) && $retailer_params[9]) checked @endif>Goat &nbsp &nbsp &nbsp</label>
                            <label align="right" class="checkbox-inline"><input type="checkbox" name="has_pig" @if(isset($retailer_params) && $retailer_params[10]) checked @endif>Pig</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="buyers" class="tab-pane fade @if(isset($buyers)) in active @endif">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('search.buyer') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-4 control-label"> First Name </label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="first_name" placeholder="Any Name" @if(isset($buyer_params)) value="{{$buyer_params[0]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Last Name </label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="last_name" placeholder="Any Name" @if(isset($buyer_params)) value="{{$buyer_params[1]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Region </label>

                        <div class="col-md-8">
                            <select id="buyer-region-list"  class="form-control" name="region">
                                <option value="">Any Region</option>
                                <option value="ARMM">ARMM</option>
                                <option value="CAR">CAR</option>
                                <option value="NCR">NCR</option>
                                <option value="Region 1">Region 1</option>
                                <option value="Region 2">Region 2</option>
                                <option value="Region 3">Region 3</option>
                                <option value="Region 4a">Region 4a</option>
                                <option value="Region 4b">Region 4b</option>
                                <option value="Region 5">Region 5</option>
                                <option value="Region 6">Region 6</option>
                                <option value="Region 7">Region 7</option>
                                <option value="Region 8">Region 8</option>
                                <option value="Region 9">Region 9</option>
                                <option value="Region 10">Region 10</option>
                                <option value="Region 11">Region 11</option>
                                <option value="Region 12">Region 12</option>
                                <option value="Region 13">Region 13</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Province </label>

                        <div class="col-md-8">
                            <select id="buyer-province-list"  class="form-control" name="province">
                                <option value="">Any Province</option>
                                <option class="region1" value="Illocos Norte">Illocos Norte</option>
                                <option class="region1" value="Illocos Sur">Illocos Sur</option>
                                <option class="region1" value="La Union">La Union</option>
                                <option class="region1" value="Pangasinan">Pangasinan</option>
                                <option class="region2" value="Batanes">Batanes</option>
                                <option class="region2" value="Cagayan">Cagayan</option>
                                <option class="region2" value="Isabela">Isabela</option>
                                <option class="region2" value="Nueva Viscaya">Nueva Viscaya</option>
                                <option class="region2" value="Quirino">Quirino</option>
                                <option class="region3" value="Aurora">Aurora</option>
                                <option class="region3" value="Bataan">Bataan</option>
                                <option class="region3" value="Bulacan">Bulacan</option>
                                <option class="region3" value="Nueva Ecija">Nueva Ecija</option>
                                <option class="region3" value="Pampanga">Pampanga</option>
                                <option class="region3" value="Tarlac">Tarlac</option>
                                <option class="region3" value="Zambales">Zambales</option>
                                <option class="region4a" value="Batangas">Batangas</option>
                                <option class="region4a" value="Cavite">Cavite</option>
                                <option class="region4a" value="Laguna">Laguna</option>
                                <option class="region4a" value="Quezon">Quezon</option>
                                <option class="region4a" value="Rizal">Rizal</option>
                                <option class="region4b" value="Marinduque">Marinduque</option>
                                <option class="region4b" value="Occidental Mindoro">Occidental Mindoro</option>
                                <option class="region4b" value="Oriental Mindoro">Oriental Mindoro</option>
                                <option class="region4b" value="Palawan">Palawan</option>
                                <option class="region4b" value="Romblon">Romblon</option>
                                <option class="region5" value="Albay">Albay</option>
                                <option class="region5" value="Camarines Norte">Camarines Norte</option>
                                <option class="region5" value="Camarines Sur">Camarines Sur</option>
                                <option class="region5" value="Catanduanes">Catanduanes</option>
                                <option class="region5" value="Masbate">Masbate</option>
                                <option class="region5" value="Sorsogon">Sorsogon</option>
                                <option class="region6" value="Aklan">Aklan</option>
                                <option class="region6" value="Antique">Antique</option>
                                <option class="region6" value="Capiz">Capiz</option>
                                <option class="region6" value="Iloilo">Iloilo</option>
                                <option class="region6" value="Guimaras">Guimaras</option>
                                <option class="region6" value="Negros Occidental">Negros Occidental</option>
                                <option class="region7" value="Bohol">Bohol</option>
                                <option class="region7" value="Cebu">Cebu</option>
                                <option class="region7" value="Guimaras">Guimaras</option>
                                <option class="region7" value="Negro Oriental">Negro Oriental</option>
                                <option class="region7" value="Siquijor">Siquijor</option>
                                <option class="region8" value="Biliran">Biliran</option>
                                <option class="region8" value="Eastern Samar">Eastern Samar</option>
                                <option class="region8" value="Leyte">Leyte</option>
                                <option class="region8" value="Northern Samar">Northern Samar</option>
                                <option class="region8" value="Western Samar">Western Samar</option>
                                <option class="region8" value="Southern Leyte">Southern Leyte</option>
                                <option class="region9" value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                                <option class="region9" value="Zamboanga del Norte">Zamboanga del Norte</option>
                                <option class="region9" value="Zamboanga del Sur">Zamboanga del Sur</option>
                                <option class="region10" value="Bukidnon">Bukidnon</option>
                                <option class="region10" value="Camiguin">Camiguin</option>
                                <option class="region10" value="Misamis Occidental">Misamis Occidental</option>
                                <option class="region10" value="Msamis Oriental">Msamis Oriental</option>
                                <option class="region10" value="Lanao del Norte">Lanao del Norte</option>
                                <option class="region11" value="Davao del Norte">Davao del Norte</option>
                                <option class="region11" value="Davao del Sur">Davao del Sur</option>
                                <option class="region11" value="Davao Oriental">Davao Oriental</option>
                                <option class="region11" value="Comostela Valley">Comostela Valley</option>
                                <option class="region12" value="North Cotabato">North Cotabato</option>
                                <option class="region12" value="Sultan Kudarat">Sultan Kudarat</option>
                                <option class="region12" value="South Cotabato">South Cotabato</option>
                                <option class="region12" value="Saranggani">Saranggani</option>
                                <option class="region13" value="Agustan del Norte">Agustan del Norte</option>
                                <option class="region13" value="Augustan del Sur">Augustan del Sur</option>
                                <option class="region13" value="Suriago del Norte">Suriago del Norte</option>
                                <option class="region13" value="Suriago del Sur">Suriago del Sur</option>
                                <option class="regioncar" value="Abra">Abra</option>
                                <option class="regioncar" value="Benguet">Benguet</option>
                                <option class="regioncar" value="Ifugao">Ifugao</option>
                                <option class="regioncar" value="Kalinga">Kalinga</option>
                                <option class="regioncar" value="Apayao">Apayao</option>
                                <option class="regioncar" value="Mountain Province">Mountain Province</option>
                                <option class="regionarmm" value="Basilan">Basilan</option>
                                <option class="regionarmm" value="Sulu">Sulu</option>
                                <option class="regionarmm" value="Tawi-Tawi">Tawi-Tawi</option>
                                <option class="regionarmm" value="Lanao del Sur">Lanao del Sur</option>
                                <option class="regionarmm" value="Magrindanao">Magrindanao</option>
                                <option class="regionncr" value="Manila">Manila</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> City </label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="city" placeholder="Any City" @if(isset($buyer_params)) value="{{$buyer_params[4]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Email </label>

                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email" placeholder="Any Email" @if(isset($buyer_params)) value="{{$buyer_params[5]}}" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"> Description </label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="description" placeholder="Any Description" @if(isset($buyer_params)) value="{{$buyer_params[6]}}" @endif>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){


    $(".chicken-breed").hide();
    $(".cow-breed").hide();
    $(".goat-breed").hide();
    $(".pig-breed").hide();

    $(".region1").hide();
    $(".region2").hide();
    $(".region3").hide();
    $(".region4a").hide();
    $(".region4b").hide();
    $(".region5").hide();
    $(".region6").hide();
    $(".region7").hide();
    $(".region8").hide();
    $(".region9").hide();
    $(".region10").hide();
    $(".region11").hide();
    $(".region12").hide();
    $(".region13").hide();
    $(".regionarmm").hide();
    $(".regioncar").hide();
    $(".regionncr").hide();

    @if(isset($product_params))

        $("#animal_type").val('{{$product_params[0]}}');
        $("#breed-list").val('{{$product_params[1]}}');
        $("#region-list").val('{{$product_params[5]}}');
        $("#province-list").val('{{$product_params[6]}}');

        @if($product_params[0] == 1)
            $(".chicken-breed").show();
        @elseif($product_params[0] == 2)
            $(".cow-breed").show();
        @elseif($product_params[0] == 3)
            $(".goat-breed").show();
        @elseif($product_params[0] == 4)
            $(".pig-breed").show();
        @endif

        @if($product_params[5] == "Region 1")
            $(".region1").show();
        @elseif($product_params[5] == "Region 2")
            $(".region2").show();
        @elseif($product_params[5] == "Region 3")
            $(".region3").show();
        @elseif($product_params[5] == "Region 4a")
            $(".region4a").show();
        @elseif($product_params[5] == "Region 4b")
            $(".region4b").show();
        @elseif($product_params[5] == "Region 5")
            $(".region5").show();
        @elseif($product_params[5] == "Region 6")
            $(".region6").show();
        @elseif($product_params[5] == "Region 7")
            $(".region7").show();
        @elseif($product_params[5] == "Region 8")
            $(".region8").show();
        @elseif($product_params[5] == "Region 9")
            $(".region9").show();
        @elseif($product_params[5] == "Region 10")
            $(".region10").show();
        @elseif($product_params[5] == "Region 11")
            $(".region11").show();
        @elseif($product_params[5] == "Region 12")
            $(".region12").show();
        @elseif($product_params[5] == "Region 13")
            $(".region13").show();
        @elseif($product_params[5] == "ARMM")
            $(".regionarmm").show();
        @elseif($product_params[5] == "CAR")
            $(".regioncar").show();
        @elseif($product_params[5] == "NCR")
            $(".regionncr").show();
        @endif
    @endif

    @if(isset($retailer_params))

        $("#retailer-region-list").val('{{$retailer_params[2]}}');
        $("#retailer-province-list").val('{{$retailer_params[3]}}');

        @if($retailer_params[2] == "Region 1")
            $(".region1").show();
        @elseif($retailer_params[2] == "Region 2")
            $(".region2").show();
        @elseif($retailer_params[2] == "Region 3")
            $(".region3").show();
        @elseif($retailer_params[2] == "Region 4a")
            $(".region4a").show();
        @elseif($retailer_params[2] == "Region 4b")
            $(".region4b").show();
        @elseif($retailer_params[2] == "Region 5")
            $(".region5").show();
        @elseif($retailer_params[2] == "Region 6")
            $(".region6").show();
        @elseif($retailer_params[2] == "Region 7")
            $(".region7").show();
        @elseif($retailer_params[2] == "Region 8")
            $(".region8").show();
        @elseif($retailer_params[2] == "Region 9")
            $(".region9").show();
        @elseif($retailer_params[2] == "Region 10")
            $(".region10").show();
        @elseif($retailer_params[2] == "Region 11")
            $(".region11").show();
        @elseif($retailer_params[2] == "Region 12")
            $(".region12").show();
        @elseif($retailer_params[2] == "Region 13")
            $(".region13").show();
        @elseif($retailer_params[2] == "ARMM")
            $(".regionarmm").show();
        @elseif($retailer_params[2] == "CAR")
            $(".regioncar").show();
        @elseif($retailer_params[2] == "NCR")
            $(".regionncr").show();
        @endif
    @endif

    @if(isset($buyer_params))

        $("#buyer-region-list").val('{{$buyer_params[2]}}');
        $("#buyer-province-list").val('{{$buyer_params[3]}}');

        @if($buyer_params[2] == "Region 1")
            $(".region1").show();
        @elseif($buyer_params[2] == "Region 2")
            $(".region2").show();
        @elseif($buyer_params[2] == "Region 3")
            $(".region3").show();
        @elseif($buyer_params[2] == "Region 4a")
            $(".region4a").show();
        @elseif($buyer_params[2] == "Region 4b")
            $(".region4b").show();
        @elseif($buyer_params[2] == "Region 5")
            $(".region5").show();
        @elseif($buyer_params[2] == "Region 6")
            $(".region6").show();
        @elseif($buyer_params[2] == "Region 7")
            $(".region7").show();
        @elseif($buyer_params[2] == "Region 8")
            $(".region8").show();
        @elseif($buyer_params[2] == "Region 9")
            $(".region9").show();
        @elseif($buyer_params[2] == "Region 10")
            $(".region10").show();
        @elseif($buyer_params[2] == "Region 11")
            $(".region11").show();
        @elseif($buyer_params[2] == "Region 12")
            $(".region12").show();
        @elseif($buyer_params[2] == "Region 13")
            $(".region13").show();
        @elseif($buyer_params[2] == "ARMM")
            $(".regionarmm").show();
        @elseif($buyer_params[2] == "CAR")
            $(".regioncar").show();
        @elseif($buyer_params[2] == "NCR")
            $(".regionncr").show();
        @endif
    @endif

    $('#animal_type').on('change', function() {

        $("#breed-list").val("");

        $(".chicken-breed").hide();
        $(".cow-breed").hide();
        $(".goat-breed").hide();
        $(".pig-breed").hide();
        
        switch(this.value) {
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
    });

    $('#region-list').on('change', function() {

        $("#province-list").val("");

        $(".region1").hide();
        $(".region2").hide();
        $(".region3").hide();
        $(".region4a").hide();
        $(".region4b").hide();
        $(".region5").hide();
        $(".region6").hide();
        $(".region7").hide();
        $(".region8").hide();
        $(".region9").hide();
        $(".region10").hide();
        $(".region11").hide();
        $(".region12").hide();
        $(".region13").hide();
        $(".regionarmm").hide();
        $(".regioncar").hide();
        $(".regionncr").hide();
        
        switch(this.value) {
            case "Region 1":
                $(".region1").show();
                break;
            case "Region 2":
                $(".region2").show();
                break;
            case "Region 3":
                $(".region3").show();
                break;
            case "Region 4a":
                $(".region4a").show();
                break;
            case "Region 4b":
                $(".region4b").show();
                break;
            case "Region 5":
                $(".region5").show();
                break;
            case "Region 6":
                $(".region6").show();
                break;
            case "Region 7":
                $(".region7").show();
                break;
            case "Region 8":
                $(".region8").show();
                break;
            case "Region 9":
                $(".region9").show();
                break;
            case "Region 10":
                $(".region10").show();
                break;
            case "Region 11":
                $(".region11").show();
                break;
            case "Region 12":
                $(".region12").show();
                break;
            case "Region 13":
                $(".region13").show();
                break;
            case "CAR":
                $(".regioncar").show();
                break;
            case "ARMM":
                $(".regionarmm").show();
                break;
            case "NCR":
                $(".regionncr").show();
                break;
        }
    });

    $('#retailer-region-list').on('change', function() {

        $("#retailer-province-list").val("");

        $(".region1").hide();
        $(".region2").hide();
        $(".region3").hide();
        $(".region4a").hide();
        $(".region4b").hide();
        $(".region5").hide();
        $(".region6").hide();
        $(".region7").hide();
        $(".region8").hide();
        $(".region9").hide();
        $(".region10").hide();
        $(".region11").hide();
        $(".region12").hide();
        $(".region13").hide();
        $(".regionarmm").hide();
        $(".regioncar").hide();
        $(".regionncr").hide();
        
        switch(this.value) {
            case "Region 1":
                $(".region1").show();
                break;
            case "Region 2":
                $(".region2").show();
                break;
            case "Region 3":
                $(".region3").show();
                break;
            case "Region 4a":
                $(".region4a").show();
                break;
            case "Region 4b":
                $(".region4b").show();
                break;
            case "Region 5":
                $(".region5").show();
                break;
            case "Region 6":
                $(".region6").show();
                break;
            case "Region 7":
                $(".region7").show();
                break;
            case "Region 8":
                $(".region8").show();
                break;
            case "Region 9":
                $(".region9").show();
                break;
            case "Region 10":
                $(".region10").show();
                break;
            case "Region 11":
                $(".region11").show();
                break;
            case "Region 12":
                $(".region12").show();
                break;
            case "Region 13":
                $(".region13").show();
                break;
            case "CAR":
                $(".regioncar").show();
                break;
            case "ARMM":
                $(".regionarmm").show();
                break;
            case "NCR":
                $(".regionncr").show();
                break;
        }
    });

    $('#buyer-region-list').on('change', function() {

        $("#buyer-province-list").val("");

        $(".region1").hide();
        $(".region2").hide();
        $(".region3").hide();
        $(".region4a").hide();
        $(".region4b").hide();
        $(".region5").hide();
        $(".region6").hide();
        $(".region7").hide();
        $(".region8").hide();
        $(".region9").hide();
        $(".region10").hide();
        $(".region11").hide();
        $(".region12").hide();
        $(".region13").hide();
        $(".regionarmm").hide();
        $(".regioncar").hide();
        $(".regionncr").hide();
        
        switch(this.value) {
            case "Region 1":
                $(".region1").show();
                break;
            case "Region 2":
                $(".region2").show();
                break;
            case "Region 3":
                $(".region3").show();
                break;
            case "Region 4a":
                $(".region4a").show();
                break;
            case "Region 4b":
                $(".region4b").show();
                break;
            case "Region 5":
                $(".region5").show();
                break;
            case "Region 6":
                $(".region6").show();
                break;
            case "Region 7":
                $(".region7").show();
                break;
            case "Region 8":
                $(".region8").show();
                break;
            case "Region 9":
                $(".region9").show();
                break;
            case "Region 10":
                $(".region10").show();
                break;
            case "Region 11":
                $(".region11").show();
                break;
            case "Region 12":
                $(".region12").show();
                break;
            case "Region 13":
                $(".region13").show();
                break;
            case "CAR":
                $(".regioncar").show();
                break;
            case "ARMM":
                $(".regionarmm").show();
                break;
            case "NCR":
                $(".regionncr").show();
                break;
        }
    });

    $("#ex2").slider({
        tooltip: 'always'
    });

});
</script>