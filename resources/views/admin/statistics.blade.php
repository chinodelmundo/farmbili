<div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#stats">
        <h4 class="panel-title">
            <a href="#" >
                Statistics <span class="caret"></span>
            </a>
        </h4>
    </div>
    <div id="stats" class="panel-collapse collapse in">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">           
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>Total Users</b>
                                        </th>
                                        <td>
                                            <a href="users/all"><b>{{ $users_stats[0] }}</b></a>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Buyers
                                        </td>
                                        <td  align="right">
                                            <a href="users/buyers">{{ $users_stats[1] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Retailers
                                        </td>
                                        <td  align="right">
                                            <a href="users/retailers">{{ $users_stats[2] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Unapproved Retailers
                                        </td>
                                        <td align="right">
                                            <a href="users/unapproved">{{ $users_stats[3] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Administrators
                                        </td>
                                        <td  align="right">
                                            <a href="users/admins">{{ $users_stats[4] }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">           
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>Total Products</b>
                                        </th>
                                        <td align="right">
                                            <a href="products/all"><b>{{ $products_stats[0] }}</b></a>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Chicken 
                                        </td>
                                        <td align="right">
                                            <a href="products/type/1">{{ $products_stats[1] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Cow
                                        </td>
                                        <td align="right">
                                            <a href="products/type/2">{{ $products_stats[2] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Goat
                                        </td>
                                        <td align="right">
                                            <a href="products/type/3">{{ $products_stats[3] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Pig
                                        </td>
                                        <td align="right">    
                                            <a href="products/type/4">{{ $products_stats[4] }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>Total Transactions</b>
                                        </th>
                                        <td>
                                            <a href="transactions/all"><b>{{ $transactions_stats[0] }}</b></a>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Approved
                                        </td>
                                        <td align="right">
                                            <a href="transactions/type/1">{{ $transactions_stats[1] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Pending
                                        </td>
                                        <td align="right">
                                            <a href="transactions/type/0">{{ $transactions_stats[2] }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Rejected
                                        </td>
                                        <td align="right">
                                            <a href="transactions/type/2">{{ $transactions_stats[3] }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            &nbsp
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><b>Last Month's Activities</b></h4>      
                            <table class="table">
                                <tr>
                                    <td>
                                        New Users
                                    </td>
                                    <td align="right">
                                        <a href="users/{{substr($dates_array[1], 0, 4)}}/{{substr($dates_array[1], 5, 6)}}"> {{ $monthly_stats[1][0] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        New Products
                                    </td>
                                    <td align="right">
                                        <a href="products/{{substr($dates_array[1], 0, 4)}}/{{substr($dates_array[1], 5, 6)}}"> {{  $monthly_stats[1][1] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Transactions Created
                                    </td>
                                    <td align="right">
                                        <a href="transactions/{{substr($dates_array[1], 0, 4)}}/{{substr($dates_array[1], 5, 6)}}">{{  $monthly_stats[1][2] }}</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><b>Current Month's Activities</b></h4>      
                            <table class="table">
                                <tr>
                                    <td>
                                        New Users
                                    </td>
                                    <td align="right">
                                        <a href="users/{{substr($dates_array[0], 0, 4)}}/{{substr($dates_array[0], 5, 6)}}"> {{  $monthly_stats[0][0] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        New Products
                                    </td>
                                    <td align="right">
                                        <a href="products/{{substr($dates_array[0], 0, 4)}}/{{substr($dates_array[0], 5, 6)}}"> {{  $monthly_stats[0][1] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Transactions Created
                                    </td>
                                    <td align="right">
                                        <a href="transactions/{{substr($dates_array[0], 0, 4)}}/{{substr($dates_array[0], 5, 6)}}">{{  $monthly_stats[0][2] }}</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            &nbsp
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><b>Activities Graph</b></h4>      
                            <div class="panel-body">
                                <div>
                                    <canvas id="canvas"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var lineChartData = {
                        labels : ["{{$dates_array[4]}}", "{{$dates_array[3]}}", "{{$dates_array[2]}}", "{{$dates_array[1]}}", "{{$dates_array[0]}}"],
                        datasets : [
                            {
                                label: "New Users",
                                fillColor : "rgba(100,100,220,0.2)",
                                strokeColor : "rgba(100,100,220,1)",
                                pointColor : "rgba(100,100,220,1)",
                                pointStrokeColor : "#fff",
                                pointHighlightFill : "#fff",
                                pointHighlightStroke : "rgba(100,100,220,1)",
                                data : [{{$monthly_stats[4][0]}}, {{$monthly_stats[3][0]}}, {{$monthly_stats[2][0]}}, {{$monthly_stats[1][0]}}, {{$monthly_stats[0][0]}}]
                            },
                            {
                                label: "New Products",
                                fillColor : "rgba(151,187,205,0.2)",
                                strokeColor : "rgba(151,187,205,1)",
                                pointColor : "rgba(151,187,205,1)",
                                pointStrokeColor : "#fff",
                                pointHighlightFill : "#fff",
                                pointHighlightStroke : "rgba(151,187,205,1)",
                                data : [{{$monthly_stats[4][1]}}, {{$monthly_stats[3][1]}}, {{$monthly_stats[2][1]}}, {{$monthly_stats[1][1]}}, {{$monthly_stats[0][1]}}]
                            },
                            {
                                label: "Transactions Created",
                                fillColor : "rgba(100,100,100,0.2)",
                                strokeColor : "rgba(100,100,100,1)",
                                pointColor : "rgba(100,100,100,1)",
                                pointStrokeColor : "#fff",
                                pointHighlightFill : "#fff",
                                pointHighlightStroke : "rgba(100,100,300,1)",
                                data : [{{$monthly_stats[4][2]}}, {{$monthly_stats[3][2]}}, {{$monthly_stats[2][2]}}, {{$monthly_stats[1][2]}}, {{$monthly_stats[0][2]}}]
                            }
                        ]

                    }

                window.onload = function(){
                    var ctx = document.getElementById("canvas").getContext("2d");
                    window.myLine = new Chart(ctx).Line(lineChartData, {
                        responsive: true
                    });
                }
            </script>
        </div>
    </div>
</div>