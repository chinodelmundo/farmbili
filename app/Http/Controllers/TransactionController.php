<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Transaction as Transaction;
use App\Product as Product;
use App\Activity as Activity;
use App\Dialogue as Dialogue;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::User()->user_type == 0){
            $transactions = Transaction::where('user_id', '>', 0)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('admin.list.transactions')
                ->with('transactions', $transactions);
        }else{
            if(Auth::User()->user_type == 1){
                $transactions = Transaction::where('user_id', Auth::User()->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }else{
                $transactions = Transaction::where('retailer_id', Auth::User()->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            return view('transactions.index')
                ->with('transactions', $transactions);
        }
    }

    // Add to cart. Fixed price products
    public function buy_product($id){
        $product = Product::find($id);

        return view('transactions.add_transaction')
            ->with('product', $product);
    }

    // Add to cart. Negotiable price products
    public function deal_product($id){
        $product = Product::find($id);

        return view('transactions.start_transaction')
            ->with('product', $product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = New Transaction;
        $transaction->user_id = Auth::User()->id;
        $transaction->product_id = $request->product_id;
        $transaction->retailer_id = $request->retailer_id;
        $transaction->quantity = $request->quantity;
        $transaction->total_price = $request->quantity * $request->price;
        $transaction->type = 1;
        $transaction->status = 0;
        $transaction->save();

        $activity = new Activity;
        $activity->user_id = Auth::User()->id;
        $activity->action = "Buy Product";
        $activity->target_id = $transaction->id;
        $activity->target_name = $request->product_name;
        $activity->target_type = 5;
        $activity->save();

        return redirect()->route('transaction.index');
    }

    // Insert first deal on Transaction. Negotiable price product.
    public function start_deal(Request $request)
    {
        $transaction = New Transaction;
        $transaction->user_id = Auth::User()->id;
        $transaction->product_id = $request->product_id;
        $transaction->retailer_id = $request->retailer_id;
        $transaction->quantity = $request->quantity;
        $transaction->total_price = $request->total_price;
        $transaction->type = 2;
        $transaction->status = 0;
        $transaction->save();

        $dialogue = New Dialogue;
        $dialogue->transaction_id = $transaction->id;
        $dialogue->user_id = Auth::User()->id;
        $dialogue->quantity = $request->quantity;
        $dialogue->total_price = $request->total_price;
        $dialogue->comment = $request->comment;
        $dialogue->buyer_approved = 1;
        $dialogue->retailer_approved = 0;
        $dialogue->save();

        $activity = new Activity;
        $activity->user_id = Auth::User()->id;
        $activity->action = "Start Transaction";
        $activity->target_id = $transaction->id;
        $activity->target_name = $request->product_name;
        $activity->target_type = 5;
        $activity->save();

        return redirect()->route('transaction.index');
    }

    // Add another deal on Transaction. Negotiable price product.
    public function add_deal(Request $request)
    {
        $transaction = Transaction::find($request->transaction_id);
        $transaction->quantity = $request->quantity;
        $transaction->total_price = $request->total_price;
        $transaction->save();

        $dialogue = New Dialogue;
        $dialogue->transaction_id = $transaction->id;
        $dialogue->user_id = Auth::User()->id;
        $dialogue->quantity = $request->quantity;
        $dialogue->comment = $request->comment;
        $dialogue->total_price = $request->total_price;

        if(Auth::User()->user_type == 1){
            $dialogue->buyer_approved = 1;
            $dialogue->retailer_approved = 0;
        }else{
            $dialogue->buyer_approved = 0;
            $dialogue->retailer_approved = 1;
        }

        $dialogue->save();

        return redirect()->route('transaction.view', $transaction->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        if($transaction->type == 2){

            return redirect()->route('transaction.view', $transaction->id);
        }else{
            return view('transactions.view_transaction')
                ->with('transaction', $transaction);
        }
    }

    // View Transaction details
    public function view_transaction($id)
    {
        $transaction = Transaction::find($id);

        if(Auth::User()->id == $transaction->user->id || Auth::User()->id == $transaction->retailer->id || Auth::User()->user_type == 0){  
            return view('transactions.view_transaction_dialogues')
                ->with('transaction', $transaction);   
        }else{
            return redirect()->route('home');
        }
    }

    // Approve Transaction
    public function approve($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 1;
        $transaction->save();

        $product = Product::find($transaction->product_id);
        $product->quantity -= $transaction->quantity;
        $product->save();

        $activity = new Activity;
        $activity->user_id = Auth::User()->id;
        $activity->action = "Appove Transaction";
        $activity->target_id = $id;
        $activity->target_name = $transaction->user->get_name();
        $activity->target_type = 5;
        $activity->save();

        return redirect()->route('transaction.index');
    }

    // Reject Transaction.
    public function unapprove($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 2;
        $transaction->save();

        $activity = new Activity;
        $activity->user_id = Auth::User()->id;
        $activity->action = "Reject Transaction";
        $activity->target_id = $id;
        $activity->target_name = $transaction->user->get_name();
        $activity->target_type = 5;
        $activity->save();

        return redirect()->route('transaction.index');
    }

    // List all transactions with certain type/status
    public function list_transactions_with_type($status_type)
    {
        $transactions =  Transaction::where('status', $status_type)
            ->orderBy('created_at','desc')
            ->get();

        switch($status_type){
            case 0:
                $title = "Pending Transactions";
                break;
            case 1:
                $title = "Approved Transactions";
                break;
            case 2:
                $title = "Rejected Transactions";
                break;
            default:
                $title = "";
        }

        return view('transactions.list_with_type')
            ->with('transactions', $transactions)
            ->with('title', $title);

    }

    // List all transactions created on a certain month and year.
    public function list_transactions_with_date($year, $month)
    {
        $transactions = Transaction::whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year)
            ->orderBy('created_at', 'desc')
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

        $title = "Transactions on ". $month_text .' '. $year;

        return view('admin.list.transactions_with_date')
            ->with('transactions', $transactions)
            ->with('title', $title)
            ->with('year', $year)
            ->with('month', $month);
    }
}
