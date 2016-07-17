@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">   
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        @if(Auth::User()->user_type == 0)

            <!-- Admin Homepage -->

            <div class="col-md-10">
                @include('layouts.statusmessage')

                <h3 class="page-header"><span class="fa fa-bar-chart-o"></span> Dashboard</h3>
                <div class="panel-group" id="accordion">
                    @include('admin.statistics')
                    @include('admin.announcements')
                    @include('admin.activitylog')
                </div>
            </div>

        @else

            <!-- Buyer/Retailer Homepage -->

            <div class="col-md-7">

                @include('layouts.statusmessage')
                
                @if(Auth::User()->user_type == 3)
                    <div class="panel panel-warning">
                        <div class="panel-body">
                            Your account is still not Approved. <br>
                            You may add new products but other users won't be able to search and buy your products.
                        </div>
                    </div>
                @endif
                @if(Auth::User()->user_type == 1)

                    @if(isset($message))
                        <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ $message }}
                        </div>
                    @endif

                    @include('search.searchbar')
                @endif
                @if(Auth::User()->user_type == 2 || Auth::User()->user_type == 3)

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
                    <script>
                        var lineChartData = {
                                labels : ["{{$dates_array[4]}}", "{{$dates_array[3]}}", "{{$dates_array[2]}}", "{{$dates_array[1]}}", "{{$dates_array[0]}}"],
                                datasets : [
                                    {
                                        label: "Products",
                                        fillColor : "rgba(151,187,205,0.2)",
                                        strokeColor : "rgba(151,187,205,1)",
                                        pointColor : "rgba(151,187,205,1)",
                                        pointStrokeColor : "#fff",
                                        pointHighlightFill : "#fff",
                                        pointHighlightStroke : "rgba(151,187,205,1)",
                                        data : [{{$monthly_stats[4][0]}}, {{$monthly_stats[3][0]}}, {{$monthly_stats[2][0]}}, {{$monthly_stats[1][0]}}, {{$monthly_stats[0][0]}}]
                                    },
                                    {
                                        label: "Transactions",
                                        fillColor : "rgba(100,100,100,0.2)",
                                        strokeColor : "rgba(100,100,100,1)",
                                        pointColor : "rgba(100,100,100,1)",
                                        pointStrokeColor : "#fff",
                                        pointHighlightFill : "#fff",
                                        pointHighlightStroke : "rgba(100,100,300,1)",
                                        data : [{{$monthly_stats[4][1]}}, {{$monthly_stats[3][1]}}, {{$monthly_stats[2][1]}}, {{$monthly_stats[1][1]}}, {{$monthly_stats[0][1]}}]
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
                @endif
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                        <div class="panel-heading" > 
                            Announcements 
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                @if($announcements->count() > 0)
                                    @foreach($announcements as $announcement)
                                        <tr>
                                            <td>
                                                {{ $announcement->message }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    No announcements.
                                @endif
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
