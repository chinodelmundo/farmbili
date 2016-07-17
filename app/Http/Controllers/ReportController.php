<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Report as Report;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::User()->user_type == 0){
            $unanswered = Report::where('id','>',0)
                ->unanswered()
                ->orderBy('created_at','desc')
                ->get();

            $answered = Report::where('id','>',0)
                ->answered()
                ->orderBy('created_at','desc')
                ->get();

            return view('reports.reports')
                ->with('unanswered', $unanswered)
                ->with('answered', $answered);
        }else{
            $reports = Report::where('user_id', Auth::User()->id)
                ->orderBy('created_at','desc')
                ->get();

            return view('reports.reports')
                ->with('reports', $reports);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.add_report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report = new Report;

        $report->user_id = Auth::User()->id;
        $report->subject = $request->subject;
        $report->category = $request->category;
        $report->message = $request->message;
        $report->status = 0;

        $report->save();

        return redirect()->route('report.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::find($id);

        if($report->user_id == Auth::User()->id || Auth::User()->user_type == 0){
            return view('reports.view_report')
                ->with('report', $report);
        }else{
            return redirect()->route('home');
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::where('id', $id)
            ->firstOrFail();

        if(Auth::User()->user_type == 0){
            return view('reports.edit_report')
                ->with('report', $report);
        }else{
            return redirect()->route('home');
        }
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
        if(Auth::User()->user_type == 0){

            $report = Report::find($id);
            $report->reply = $request->reply;

            if($request->reply <> ""){
                $report->status = 1;
            }else{
                $report->status = 0;
            }

            $report->save();

            return redirect()->route('report.show', $report->id);
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
