<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User as User;
use App\Product as Product;
use App\Activity as Activity;
use App\Transaction as Transaction;

use Illuminate\Support\Facades\Auth;
use Storage;
use Carbon\Carbon;
use Hash;
use Mail;

class UserController extends Controller
{

	public function index(){
        $activities = Activity::where('user_id', Auth::User()->id)
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();

    	return view('profile.profile')
    		->with('activities', $activities);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)
            ->firstOrFail();

            if($user->id == Auth::User()->id || Auth::User()->user_type == 0){
                return view('profile.edit_profile')
                    ->with('user', $user);
            }else{
                return redirect()->route('home');
            }
    }

    public function update(Request $request, $id){
    	$user = User::find($id);
    	$user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
    	$user->email = $request->email;
        $user->phone = $request->phone;
        $user->region = $request->region;
        $user->province = $request->province;
        $user->city = $request->city;
        $user->description = $request->description;
    	$user->save();

        $activity = new Activity;
        $activity->user_id = Auth::User()->id;
        $activity->action = "Edit Profile";
        $activity->target_id = $user->id;
        $activity->target_name = $user->get_name();
        $activity->target_type = $user->user_type;
        $activity->save();

        if($user->id != Auth::User()->id){
            if($user->user_type == 1){
                return redirect()->route('buyer.view', $user->id)
                    ->with('status', 'Buyer info has been updated.');
            }elseif($user->user_type == 2 || $user->user_type == 3){
                return redirect()->route('retailer.view', $user->id)
                    ->with('status', 'Retailer info has been updated.');
            }else{
                return redirect()->route('home')
                    ->with('status', $user->get_name().' has been updated successfully.');
            }
        }else{
            return redirect()->route('profile.index')
                ->with('status','Profile has been updated successfully.');
        }
    }

    public function approve_retailer($id){
        $user = User::find($id);

        if($user->user_type == 3 && Auth::User()->user_type == 0){
            $user->user_type = 2;
            $user->save();

            $activity = new Activity;
            $activity->user_id = Auth::User()->id;
            $activity->action = "Approve Retailer";
            $activity->target_id = $user->id;
            $activity->target_name = $user->get_name();
            $activity->target_type = $user->user_type;
            $activity->save();

            return redirect()->route('retailer.view', $user->id)
                ->with('status','Retailer has been approved.');
        }else{
            return redirect('home');
        }
    }

    public function unapprove_retailer($id){
        $user = User::find($id);

        if($user->user_type == 2 && Auth::User()->user_type == 0){
            $user->user_type = 3;
            $user->save();

            $activity = new Activity;

            $activity->user_id = Auth::User()->id;
            $activity->action = "Unapprove Retailer";
            $activity->target_id = $user->id;
            $activity->target_name = $user->get_name();
            $activity->target_type = $user->user_type;
            $activity->save();
            
            return redirect()->route('retailer.view', $user->id)
                ->with('status','Retailer has been unapproved.');
        }else{
            return redirect('home');
        }
    }

	public function view_buyer($id)
    {
        $buyer = User::find($id);

        if($buyer->user_type == 1){

            $transactions = Transaction::where('user_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();

            $activities = Activity::where('user_id', $id)
                ->orderBy('created_at','desc')
                ->take(5)
                ->get();

            return view('profile.view_buyer')
                ->with('buyer', $buyer)
                ->with('activities', $activities)
                ->with('transactions', $transactions);

        }else{
            return redirect('home');
        }
    }

    public function view_retailer($id)
    {
        $retailer = User::find($id);

        if($retailer->user_type == 2 || $retailer->user_type == 3){
            $products = Product::where('user_id', $retailer->id)
            ->orderBy('name')
            ->get();

            if(Auth::Guest()){
                return view('profile.view_retailer')
                    ->with('retailer', $retailer)
                    ->with('products', $products);
            }else{

                $transactions = Transaction::where('retailer_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->get();

                $activities = Activity::where('user_id', $id)
                    ->orderBy('created_at','desc')
                    ->take(5)
                    ->get();

                return view('profile.view_retailer')
                    ->with('retailer', $retailer)
                    ->with('products', $products)
                    ->with('activities', $activities)
                    ->with('transactions', $transactions);
            }
        }else{
            return redirect('home');
        }
    }

    public function view_admin($id)
    {
        $admin = User::find($id);

        if($admin->user_type == 0){

            $activities = Activity::where('user_id', $id)
                ->orderBy('created_at','desc')
                ->take(5)
                ->get();

            return view('profile.view_admin')
                ->with('admin', $admin)
                ->with('activities', $activities);

        }else{
            return redirect('home');
        }
    }

    public function list_all_users()
    {
        $users = User::all();

        return view('admin.list.users')
        	->with('users', $users);
    }

    public function list_all_buyers()
    {
        $users = User::where("user_type", 1)
        	->orderBy('first_name')
        	->get();

        return view('admin.list.buyers')
        	->with('users', $users);
    }

    public function list_all_retailers()
    {
        $users = User::where("user_type", 2)
        	->orderBy('first_name')
        	->get();

        $title = "Users";

        return view('admin.list.retailers')
        	->with('users', $users)
            ->with('title', $title);
    }

    public function list_all_unapproved()
    {
        $users = User::where("user_type", 3)
            ->orderBy('first_name')
            ->get();

        return view('admin.list.unapproved_retailers')
            ->with('users', $users);
    }

    public function list_all_admins()
    {
        $users = User::where("user_type", 0)
        	->orderBy('first_name')
        	->get();

        return view('admin.list.admins')
        	->with('users', $users);
    }

    public function list_users_with_date($year, $month)
    {
        $users = User::whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year)
            ->orderBy('first_name')
            ->get();

        switch($month){
            case 1:
                $month_text = "January";
                break;
            case 2:
                $month_text = "February";
                break;
            case 3:
                $month_text = "March";
                break;
            case 4:
                $month_text = "April";
                break;
            case 5:
                $month_text = "May";
                break;
            case 6:
                $month_text = "June";
                break;
            case 7:
                $month_text = "July";
                break;
            case 8:
                $month_text = "August";
                break;
            case 9:
                $month_text = "September";
                break;
            case 10:
                $month_text = "October";
                break;
            case 11:
                $month_text = "November";
                break;
            case 12:
                $month_text = "December";
                break;
            default:
                $month_text = "";
        }

        $title = "Users registered on ". $month_text .' '. $year;

        return view('admin.list.users_with_date')
            ->with('users', $users)
            ->with('title', $title)
            ->with('year', $year)
            ->with('month', $month);
    }

    public function view_activities()
    {
        $activities = Activity::where('user_id', Auth::User()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.activities')
            ->with('activities', $activities);
    }

    public function change_password()
    {
        return view('profile.change_password');
    }

    public function post_change_password(Request $request){
        $user = User::find(Auth::User()->id);

        if(Hash::check($request->current_password, $user->password)){
            if($request->new_password == $request->new_password2){
                
                $user->password = bcrypt($request->new_password);
                $user->save();

                return redirect()
                    ->route('profile.index')
                    ->with('status', 'Password has been updated.');
            }else{
                return redirect()
                    ->route('profile.change_pw')
                    ->with('status', 'New Password Confirmation doesn\'t match');
            }
        }else{
            return redirect()
                    ->route('profile.change_pw')
                    ->with('status', 'Wrong Current Password');
        }
    }

    public function create_email(){
        $users = User::all();

        return view('email.send_email')
            ->with('users', $users);
    }

    public function send_email(Request $request){
        $user = User::find(Auth::User()->id);

        $emails = $request->emails_list;
        $subject = $request->subject;

        Mail::send('email.template', array('msg' => $request->message), function($message) use ($emails, $subject){
            $message->to($emails)->subject($subject);
            $message->from('farmbili.emailer@gmail.com', 'Farmbili Emailer');
        });

        return redirect()->route('home')
            ->with('status', 'Email has been sent successfully.');
    }

    public function show_user_activities($id){
        $user = User::find($id);
        $activities = Activity::where('user_id', $id)
            ->orderBy('created_at','desc')
            ->get();

        return view('profile.user_activities')
            ->with('user', $user)
            ->with('activities', $activities);
    }

}