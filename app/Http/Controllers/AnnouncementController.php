<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Announcement as Announcement;

class AnnouncementController extends Controller
{

    /*
        User will have to be an administrator to access functions in this class.
    */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announcements.add_announcement');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $announcement = New Announcement;

        $announcement->message = $request->message;
        $announcement->user_type = $request->user_type;
        $announcement->user_id = $request->user_id;

        $announcement->save();

        return redirect()->route('home')
            ->with('status', 'Announcement has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::find($id);

        return view('admin.announcements.edit_announcement')
            ->with('announcement', $announcement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);

        $announcement->message = $request->message;
        $announcement->user_type = $request->user_type;
        $announcement->user_id = $request->user_id;

        $announcement->save();

        return redirect()->route('home')
            ->with('status', 'Announcement has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Announcement::destroy($id);

        return redirect()->route('home')
            ->with('status', 'Announcement has been deleted successfully.');
    }
}
