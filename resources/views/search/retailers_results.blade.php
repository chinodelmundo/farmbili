
<div class="row">
    <div class="col-md-3 col-md-offset-9">
        <button class="btn" id="grid-view-btn" data-toggle="tooltip" title="Grid View" style="padding: 3px; padding-left:5px; padding-right:5px; padding-bottom: 3px;border-color:#cccccc;">
            <div class ="white-button">
                <i class="fa fa-th fa-2x"></i>
            </div>  
        </button>
        
             &nbsp;
        <button class="btn" id="list-view-btn" data-toggle="tooltip" title="List View" style="padding: 3px; padding-left:5px; padding-right:5px; padding-bottom: 3px;border-color:#cccccc;">
            <div class ="white-button">
                <i class="fa fa-align-justify fa-2x"></i>
            </div>
        </button>
        <p></p>
    </div>
</div>

<div class="panel panel-default" id="grid-panel">
    <div class="panel-heading">Search Results: {{ $retailers->count() }} found</div>
    <div class="panel-body">
        @if($retailers->count() > 0)
            @foreach($retailers as $retailer)
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <center>
                                @if(isset($retailer->images()->where('is_primary', 1)->first()->id))
                                    <a href="#" data-toggle="modal" data-target="#imageModal1{{$retailer->id}}">
                                        <!--div class = "image-cropper"-->
                                        <img class="img-rounded" src="/images/uploads/{{$retailer->images()->where('is_primary', 1)->first()->file_name}}" alt="retailer" style="height: 150px; margin-bottom: 10px;">
                                    <!--/div-->
                                    </a>
                                    <div id="imageModal1{{$retailer->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">     
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <img class="img-rounded" src="/images/uploads/{{$retailer->images()->first()->file_name}}" width="100%" height="100%">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!--div class = "image-cropper"-->
                                    <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" style="height: 150px; margin-bottom: 10px;">
                                    <!--/div-->
                                @endif
                            </center>
                            <table class="table">
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $retailer->get_name() }}</td>
                                </tr>
                                <tr>
                                    <td>Region</td>
                                    <td>{{ $retailer->region }}</td>
                                </tr>
                                <tr>
                                    <td>Province</td>
                                    <td>{{ $retailer->province }}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{ $retailer->city }}</td>
                                </tr>
                                <tr>
                                    <td>Products</td>
                                    <td>{{ $retailer->products->count() }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="rating" data-score="{{ $retailer->ratings()->avg('rate') + 0 }}"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table class="table-condensed">
                                            <tr>
                                                <td>
                                                    <a href="{{ route('retailer.view', $retailer->id) }}" class="btn btn-primary btn-sm darkred-btn"> View </a>
                                                </td>
                                                @if(Auth::Guest())
                                                @else
                                                    @if(Auth::User()->id == $retailer->id || Auth::User()->user_type == 0)    
                                                        <td>
                                                            <a href="{{ route('profile.edit', $retailer->id) }}" class="btn btn-primary btn-sm yellow-btn"> Edit </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            No Retailers found.
        @endif
    </div>
</div>

<div class="panel panel-default" id="list-panel">
    <div class="panel-heading">Search Results</div>
    <div class="panel-body">
        @if($retailers->count() > 0)
            <table class="table table-striped table-hover table-bordered" id="retailers-table" data-order='[[ 1, "asc" ]]'>
                <thead>    
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Region</th>
                        <th>Province</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($retailers as $retailer)
                        <tr>
                            <td>
                                @if(isset($retailer->images()->first()->id))
                                    <a href="#" data-toggle="modal" data-target="#imageModal{{$retailer->id}}">
                                        <center>
                                        <img class="img-rounded" src="/images/uploads/{{$retailer->images()->where('is_primary', 1)->first()->file_name}}" alt="retailer" width="80px" height="60px" style="width: 80px; height: 60px; margin-bottom: 10px; position: center;" >
                                    </a></center>
                                    <div id="imageModal{{$retailer->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">     
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img class="img-rounded" src="/images/uploads/{{$retailer->images()->where('is_primary', 1)->first()->file_name}}" width="100%" height="100%" >
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <center>
                                        <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" height="50px" width="50px" style="width: 80px; height: 60px; margin-bottom: 10px; position: center;">
                                    </center>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('retailer.view', $retailer->id) }}"> {{ $retailer->get_name() }} </a>
                            </td>
                            <td>{{ $retailer->region }}</td>
                            <td>{{ $retailer->province }}</td>
                            <td>{{ $retailer->city }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            No Retailers found.
        @endif
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#retailers-table').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 0}
        ]
    });

        $('#list-panel').hide();

        $('#list-view-btn').on('click', function() {
            $('#grid-panel').hide();
            $('#list-panel').show();
        });

        $('#grid-view-btn').on('click', function() {
            $('#list-panel').hide();
            $('#grid-panel').show();
        });

        $('[data-toggle="tooltip"]').tooltip(); 

        $('.rating').raty({
        path: function() {
            return '/images';
        },
        score: function() {
            return $(this).attr('data-score');
        },
        readOnly: true,
        hints: ['','','','',''],
        scoreName: 'score'
    });
    });
</script>
