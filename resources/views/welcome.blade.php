@extends('layouts.app')

@section('content')

<div class = "jumbotron" style="font-weight: 200; margin: 0; height: 320px; padding-bottom: 120px;">
        <div class = "container">
            <center>
                <img src="{{ asset('images/farmbili-logo.png') }}">
                <p> Through FarmBili, you will be able to view and select various breeds of different livestocks from certified retailers of the Philippines. 
                Whether for farming, breeding, business, or food production, we provide you convenient and secured purchases online. </p>
            </center>
        </div>
</div>

<div id="welcome-search" class="jumbotron" style = "background: #df5845; margin: 0;" >
    <div class = "container"  >
        <div class = "row">
            <div class = "col-md-7 col-md-offset-2" >
                @include('search.searchbar')
            </div>
        </div>
    </div>
</div>

@endsection

<script>
var jumboHeight = $('.jumbotron').outerHeight();
function parallax(){
    var scrolled = $(window).scrollTop();
    $('.welcome-banner').css('height', (jumboHeight-scrolled) + 'px');
}

$(window).scroll(function(e){
    parallax();
});
</script>