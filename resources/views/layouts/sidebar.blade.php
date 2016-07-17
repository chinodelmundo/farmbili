<div class="navbar-default sidebar">
    <!--div class="sidebar-nav-fixed affix"-->
        <div class="sidebar-nav nav-collapse">
            <ul class="nav" id="side-menu">
            <li>
                <a href="{{ route('home') }}">
                    @if(Auth::User()->user_type == 0)
                        <span class="fa fa-bar-chart-o"></span> Dashboard
                    @else
                        <span class="fa fa-home"></span> Home
                    @endif
                </a>
            </li>
            @if(Auth::User()->user_type == 0)
                <li>
                    <a href="#"><span class="fa fa-list"></span> Lists<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('list.users')}}">Users</a>
                        </li>
                        <li>
                            <a href="{{route('list.products')}}">Products</a>
                        </li>
                        <li>
                            <a href="{{route('list.transactions')}}">Transactions</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="{{ url('profile') }}"><span class="glyphicon glyphicon-user"></span> Profile</a>
            </li>
            @if(Auth::user()->user_type == 2 || Auth::user()->user_type == 3)
                <li>
                    <a href="{{ route('product.index') }}"><span class="fa fa-clipboard"></span> Inventory</a>
                </li>
            @endif
            @if(Auth::user()->user_type != 0)
                @if(Auth::user()->user_type == 1)
                    <li>
                        <a href="{{ route('cart.index') }}"><span class="fa fa-shopping-cart"></span> Cart</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('transaction.index') }}"><span class="fa fa-shopping-cart"></span> Transactions</a>
                    </li>
                @endif
            @endif
            <li> 
                <a href="{{ url('search') }}"><span class="fa fa-search"></span> Search</a>
            </li>
            <li>
                <a href="{{ route('report.index') }}"><span class="fa fa-folder-open"></span> Reports</a>
            </li>
        </ul>
    </div>
</div>