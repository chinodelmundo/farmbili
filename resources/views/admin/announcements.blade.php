<div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#announcements">
        <h4 class="panel-title">
            <a href="#" >
                Announcements <span class="caret"></span>
            </a>
        </h4>
    </div>
    <div id="announcements" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-8">
                    <a href="{{ route('announcement.create') }}" class="btn btn-success btn-sm"> Add Announcement </a>
                    <a href="{{ route('email.create') }}" class="btn btn-success btn-sm"><span class="fa fa-envelope-o"></span> Send Email </a>
                    <p></p>
                </div>
            </div>

            <table class="table table-hover table-condensed">
                            
                @if($announcements->count() > 0)
                    <thead>
                        <tr>
                            <th width="40%">
                                Message
                            </th>
                            <th>
                                User Type
                            </th>
                            <th>
                                Last Modified By
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcements as $announcement)
                            <tr>
                                <td>
                                    {{ $announcement->message }}
                                </td>
                                <td>
                                    {{ $announcement->get_user_type() }}
                                </td>
                                <td>
                                    {{ $announcement->user->get_name() }}
                                </td>
                                <td>
                                    <table class="table-condensed">
                                        <tr>
                                            <td>
                                                <a href="{{ route('announcement.edit', $announcement->id) }}" class="btn btn-primary btn-sm"> Edit </a>
                                            </td>
                                            <td>
                                                <input type="button" class="btn btn-danger btn-sm" value="Delete" data-toggle="modal" data-target="#delete{{$announcement->id}}">
                                            
                                                <div id="delete{{$announcement->id}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">      
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-9">
                                                                        <p>You are about to delete an announcement.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-md-offset-6">
                                                                        <table class="table-condensed">
                                                                            <tr>
                                                                                <td>
                                                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                                                                </td>
                                                                                <td>
                                                                                    <form  method="POST" action="{{ route('announcement.destroy', $announcement->id) }}">
                                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                        <input type="submit" class="btn btn-primary btn-sm" value="Continue">
                                                                                    </form>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    No announcements.
                @endif
            </table>
        </div>
    </div>
</div>