<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FarmBili</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">


    <!-- Styles -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-slider.css')}}" rel="stylesheet">

    <!-- JavaScripts -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/Chart.js')}}"></script>
    <script src="{{asset('js/jquery.raty.js')}}"></script>

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/open-sans.css')}}">
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
        <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="/">
                    <img class="logo" src="/images/farmbili.png">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa fa-shopping-cart" style="font-size:1.5em"></span>
                            </a>

                            <div class="dropdown-menu" role="menu">
                                @if(null !== session('guest.products'))
                                    <div class="custom-dropdown">
                                        <table class="table table-condensed">
                                            @foreach(session('guest.products') as $product)
                                                <tr>
                                                    <td>
                                                        @if($product[0]->images()->count() > 0)
                                                            <img class="img-rounded" src="/images/uploads/{{$product[0]->images()->first()->file_name}}" width="90" height="60">
                                                        @else
                                                            @if($product[0]->animal_type == 1)
                                                                <img class="img-rounded" src="{{ asset('images/chicken.png') }}" alt="chicken"height="100">
                                                            @elseif($product[0]->animal_type == 2)
                                                                <img class="img-rounded" src="{{ asset('images/cow.png') }}" alt="cow" height="100">
                                                            @elseif($product[0]->animal_type == 3)
                                                                <img class="img-rounded" src="{{ asset('images/goat.png') }}" alt="goat" height="100">
                                                            @elseif($product[0]->animal_type == 4)
                                                                <img class="img-rounded" src="{{ asset('images/pig.png') }}" alt="pig" height="100">
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td colspan="2">
                                                                    <b>{{$product[0]->name}}</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="45%">
                                                                    Quantity: 
                                                                </td>
                                                                <td>
                                                                    {{$product[1]}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Total Price:
                                                                </td>
                                                                <td>
                                                                    {{$product[2]}}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="pull-right" style="padding: 5px; margin-right: 10px;">
                                        <a href="/login"> Login to complete check-out.</a>
                                        New here? <a href="/register"> Sign up!</a>
                                    </div>
                                @else
                                    No Products on Cart.
                                @endif
                            </div>
                        </li>
                        <li><a href="{{ URL('/login') }}">Login</a></li>
                        <li><a href="{{ URL('/register') }}">Register</a></li>
                        @if(session('guest.products') !== NULL)
                            <li><span class="badge badge-notify">{{count(session('guest.products'))}}</span></li>
                        @endif
                    @else
                        @if(Auth::User()->user_type == 1)
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="fa fa-shopping-cart" style="font-size:1.5em"></span>
                                </a>

                                <div class="dropdown-menu" role="menu">
                                    @if(null !== session('guest.products'))
                                        <table class="table table-condensed">
                                            @foreach(session('guest.products') as $product)
                                                <tr>
                                                    <td>
                                                        @if($product[0]->images()->count() > 0)
                                                            <img class="img-rounded" src="/images/uploads/{{$product[0]->images()->first()->file_name}}" width="90" height="60">
                                                        @else
                                                            @if($product[0]->animal_type == 1)
                                                                <img class="img-rounded" src="{{ asset('images/chicken.png') }}" alt="chicken"height="100">
                                                            @elseif($product[0]->animal_type == 2)
                                                                <img class="img-rounded" src="{{ asset('images/cow.png') }}" alt="cow" height="100">
                                                            @elseif($product[0]->animal_type == 3)
                                                                <img class="img-rounded" src="{{ asset('images/goat.png') }}" alt="goat" height="100">
                                                            @elseif($product[0]->animal_type == 4)
                                                                <img class="img-rounded" src="{{ asset('images/pig.png') }}" alt="pig" height="100">
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td colspan="2">
                                                                    <b>{{$product[0]->name}}</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="45%">
                                                                    Quantity: 
                                                                </td>
                                                                <td>
                                                                    {{$product[1]}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Total Price:
                                                                </td>
                                                                <td>
                                                                    {{$product[2]}}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        @if($product[0]->fixed_price == 0)   
                                                            <a href="{{ route('transaction.deal', $product[0]->id) }}" class="btn btn-primary btn-sm">Confirm</a>
                                                        @else
                                                            <a href="{{ route('product.buy', $product[0]->id) }}" class="btn btn-primary btn-sm">Confirm</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        No Products on Cart.
                                    @endif
                                </div>
                            </li>
                        @endif
                        <li class="dropdown">
                            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->get_name() }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li align="center">Logged in as: 
                                    {{ Auth::user()->get_user_type() }}
                                </li>
                                <li align="center"><a href="{{ URL('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                            </ul>
                        </li>
                        @if(Auth::User()->user_type == 1)
                            @if(session('guest.products') !== NULL)
                                <li><span class="badge badge-notify-buyer">{{count(session('guest.products'))}}</span></li>
                            @endif
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/metisMenu.min.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('js/bootstrap-slider.js')}}"></script>

</body>
</html>
