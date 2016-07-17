<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Storage;
use Carbon\Carbon;
use Session;

use App\Announcement as Announcement;
use App\User as User;
use App\Product as Product;
use App\Transaction as Transaction;
use App\Activity as Activity;
use App\Dialogue as Dialogue;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user's home page with their corresponding information.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::User()->user_type == 0){
            $announcements = Announcement::all();

            $users_stats = array();
            $users_stats[0] = User::all()->count();
            $users_stats[1] = User::where('user_type', 1)->count();
            $users_stats[2] = User::where('user_type', 2)->count();
            $users_stats[3] = User::where('user_type', 3)->count();
            $users_stats[4] = User::where('user_type', 0)->count();

            $products_stats = array();
            $products_stats[0] = Product::all()->count();
            $products_stats[1] = Product::where('animal_type', 1)->count();
            $products_stats[2] = Product::where('animal_type', 2)->count();
            $products_stats[3] = Product::where('animal_type', 3)->count();
            $products_stats[4] = Product::where('animal_type', 4)->count();

            $transactions_stats = array();
            $transactions_stats[0] = Transaction::all()->count();
            $transactions_stats[1] = Transaction::where('status', 1)->count();
            $transactions_stats[2] = Transaction::where('status', 0)->count();
            $transactions_stats[3] = Transaction::where('status', 2)->count();

            $monthly_stats = array();
            $dates_array = array();

            for($i = 0; $i < 5; $i++){
                $monthly_stats[$i][0] = User::whereMonth('created_at', '=', Carbon::today()->month - $i)
                    ->count();
                $monthly_stats[$i][1] = Product::whereMonth('created_at', '=', Carbon::today()->month - $i)
                    ->count();
                $monthly_stats[$i][2] = Transaction::whereMonth('created_at', '=', Carbon::today()->month - $i)
                    ->count();
                $dates_array[$i] = substr(Carbon::today()->subMonth($i)->toDateString(), 0, 7);
            }

            $activities = Activity::where('user_id', '>','0')
                ->orderBy('created_at','desc')
                ->get();

            return view('home')
                ->with('announcements',$announcements)
                ->with('activities', $activities)
                ->with('users_stats', $users_stats)
                ->with('products_stats', $products_stats)
                ->with('transactions_stats', $transactions_stats)
                ->with('monthly_stats', $monthly_stats)
                ->with('dates_array', $dates_array);
        }else{
            if(Auth::User()->user_type == 3){
                $user_type = 2;
            }else{
                $user_type = Auth::User()->user_type;
            }
            $announcements = Announcement::where('user_type', $user_type);

            $announcements = Announcement::where('user_type', 9)
                ->union($announcements)
                ->get();

            if($user_type == 2){
                $monthly_stats = array();
                $dates_array = array();

                for($i = 0; $i < 5; $i++){
                    $monthly_stats[$i][0] = Product::where('user_id', Auth::User()->id)->whereMonth('created_at', '=', Carbon::today()->month - $i)
                        ->count();
                    $monthly_stats[$i][1] = Transaction::where('retailer_id', Auth::User()->id)->whereMonth('created_at', '=', Carbon::today()->month - $i)
                        ->count();
                    $dates_array[$i] = substr(Carbon::today()->subMonth($i)->toDateString(), 0, 7);
                }

                return view('home')
                    ->with('announcements',$announcements)
                    ->with('monthly_stats', $monthly_stats)
                    ->with('dates_array', $dates_array);

            }else{
                if(count(session('guest.products')) > 0){
                    $products = session('guest.products');

                    foreach($products as $product){

                        //buy
                        $transaction = New Transaction;
                        $transaction->user_id = Auth::User()->id;
                        $transaction->product_id = $product[0]->id;
                        $transaction->retailer_id = $product[0]->user->id;
                        $transaction->quantity = $product[1];
                        $transaction->total_price = $product[2];
                        $transaction->type = $product[3];
                        $transaction->status = 0;
                        $transaction->save();

                        if($product[3] == 1){
                            $activity = new Activity;
                            $activity->user_id = Auth::User()->id;
                            $activity->action = "Buy Product";
                            $activity->target_id = $transaction->id;
                            $activity->target_name = $product[0]->name;
                            $activity->target_type = 5;
                            $activity->save();
                        }else{
                            $dialogue = New Dialogue;
                            $dialogue->transaction_id = $transaction->id;
                            $dialogue->user_id = Auth::User()->id;
                            $dialogue->quantity = $product[1];
                            $dialogue->total_price = $product[2];
                            $dialogue->buyer_approved = 1;
                            $dialogue->retailer_approved = 0;
                            $dialogue->save();

                            $activity = new Activity;
                            $activity->user_id = Auth::User()->id;
                            $activity->action = "Start Transaction";
                            $activity->target_id = $transaction->id;
                            $activity->target_name = $product[0]->name;
                            $activity->target_type = 5;
                            $activity->save();
                        }
                    }

                    Session::forget('guest.products');

                    return view('home')
                        ->with('announcements', $announcements)
                        ->with('message', 'The products have been added to your cart');
                }else{

                    return view('home')
                        ->with('announcements',$announcements);
                }
            }
        }
    }
}
