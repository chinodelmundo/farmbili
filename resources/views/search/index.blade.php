@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row"> 
            <div class="col-md-4">
                <div class = "fixed-position">
                     @if (Auth::guest())
                     @else
                        <div class="panel panel-default">
                            <div class="panel-heading" data-toggle="collapse" data-target="#navigate">
                                <a class="panel-title" href="#">
                                    Site Navigation <span class="caret"></span>
                                </a>
                            </div>
                            
                            <div id="navigate" class="collapse">
                                <div class="panel-body">
                                    @include('layouts.sidebar')
                                </div>
                            </div>
                        </div>
                    @endif
                        
                    @include('search.searchbar')

                </div>
            </div>
            <div class="col-md-8">
                <div class="container-fluid">
                    @if(isset($products))
                        @include('search.products_results')
                    @elseif(isset($retailers))
                        @include('search.retailers_results')
                    @elseif(isset($buyers))
                        @include('search.buyers_results')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
