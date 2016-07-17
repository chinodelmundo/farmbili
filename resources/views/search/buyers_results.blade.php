
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
    <div class="panel-heading">Search Results: {{ $buyers->count() }} found.</div>
    <div class="panel-body">
        @if($buyers->count() > 0)
            @foreach($buyers as $buyer)
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <center>
                                @if(isset($buyer->images()->first()->id))
                                    <a href="#" data-toggle="modal" data-target="#imageModal1{{$buyer->id}}">
                                        <!--div class = "image-cropper"-->
                                            <img class="img-rounded" src="/images/uploads/{{$buyer->images()->where('is_primary', 1)->first()->file_name}}" alt="buyer" width="180" height="100" style="height: 150px; margin-bottom: 10px;">
                                        <!--/div-->
                                    </a>
                                    <div id="imageModal1{{$buyer->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">     
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img class="img-rounded" src="/images/uploads/{{$buyer->images()->where('is_primary', 1)->first()->file_name}}" width="100%" height="100%">
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
                                    <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" height="100" style="height: 150px; margin-bottom: 10px;">
                                    <!--/div-->
                                @endif
                            </center>
                            <table class="table">
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $buyer->get_name() }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $buyer->email }}</td>
                                </tr>
                                <tr>
                                    <td>Region</td>
                                    <td>{{ $buyer->region }}</td>
                                </tr>
                                <tr>
                                    <td>Province</td>
                                    <td>{{ $buyer->province }}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{ $buyer->city }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table class="table-condensed">
                                            <tr>
                                                <td>
                                                    <a href="{{ route('buyer.view', $buyer->id) }}" class="btn btn-primary btn-sm darkred-btn"> View </a>
                                                </td>

                                                @if(Auth::User()->id == $buyer->id || Auth::User()->user_type == 0)    
                                                    <td>
                                                        <a href="{{ route('profile.edit', $buyer->id) }}" class="btn btn-primary btn-sm yellow-btn"> Edit </a>
                                                    </td>
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
            No Buyers found.
        @endif
    </div>
</div>

<div class="panel panel-default" id="list-panel">
    <div class="panel-heading">Search Results</div>
    <div class="panel-body">
        @if($buyers->count() > 0)
            <table class="table table-striped table-hover table-bordered table-condensed" id="buyers-table" data-order='[[ 1, "asc" ]]'>
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
                    @foreach($buyers as $buyer)
                        <tr>
                            <td>
                                @if(isset($buyer->images()->first()->id))
                                    <a href="#" data-toggle="modal" data-target="#imageModal{{$buyer->id}}">
                                        <center>
                                            <img class="img-rounded" src="/images/uploads/{{$buyer->images()->where('is_primary', 1)->first()->file_name}}" alt="buyer" width="80" height="60" style="width: 80px; height: 60px; margin-bottom: 10px; position: center;">
                                        </center>
                                    </a>
                                    <div id="imageModal{{$buyer->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">     
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img class="img-rounded" src="/images/uploads/{{$buyer->images()->where('is_primary', 1)->first()->file_name}}" width="100%" height="100%">
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
                                        <img class="img-rounded" src="{{ asset('images/user.png') }}" alt="user" height="50" style="width: 80px; height: 60px; margin-bottom: 10px; position: center;">
                                    </center>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('buyer.view', $buyer->id) }}"> {{ $buyer->get_name() }}</a>
                            </td>
                            <td>{{ $buyer->region }}</td>
                            <td>{{ $buyer->province }}</td>
                            <td>{{ $buyer->city }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#buyers-table').DataTable({
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
    });
</script>