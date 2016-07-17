<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Storage;
use File;
use Carbon\Carbon;
use DB;
use Session;

use App\Product as Product;
use App\Activity as Activity;
use App\Image as Image;
use App\Transaction as Transaction;

class ProductController extends Controller
{

    // Display featured products on welcome page
    public function welcome(){
        if(Auth::Guest()){
            $featured_products = Product::select(DB::raw('count(transactions.product_id) as t_count, products.*'))
                    ->join('transactions', 'transactions.product_id', '=', 'products.id')
                    ->groupBy('transactions.product_id')
                    ->orderBy('t_count', 'desc')
                    ->take(4)
                    ->get();

            $newest_products = Product::where('id', '>', 0)
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();

            return view('welcome')
                ->with('featured_products', $featured_products)
                ->with('newest_products', $newest_products);
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::User()->id)
            ->orderBy('name')
            ->get();

        return view('products.products')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.add_product');
    }

    /**
     * Store a newly created resource in storage.
     *

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;

        $product->user_id = $request->user_id;
        $product->animal_type = $request->animal_type;
        $product->breed = $request->breed;
        $product->name = $request->name;
        $product->price = $request->price;
        if($request->fixed_price){
            $product->fixed_price = 1;
        }else{
            $product->fixed_price = 0;   
        }
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->gender = $request->gender;
        $product->description = $request->description;

        $product->save();


        $file = $request->image;
        if($file != null){
            $extension = $file->getClientOriginalExtension();

            $image = new Image;
            $image->product_id = $product->id;
            $image->file_name = $product->id.'_'.rand(11111,99999).'.'.$extension;
            $image->mime = $file->getClientMimeType();
            $image->original_file_name = $file->getClientOriginalName();
            $image->is_primary = 1;
            $image->save();

            $file = $file->move('images/uploads',  $image->file_name );    
        }
        

        $activity = new Activity;

        $activity->user_id = Auth::User()->id;
        $activity->action = "Add Product";
        $activity->target_id = $product->id;
        $activity->target_name = $product->name;
        $activity->target_type = 4;

        $activity->save();

        return redirect()->route('product.index')
            ->with('status', $product->name .' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $transactions = Transaction::where('product_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('products.view_product')
            ->with('product', $product)
            ->with('transactions', $transactions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)
            ->firstOrFail();

        if($product->user_id == Auth::User()->id || Auth::User()->user_type == 0){
            return view('products.edit_product')
                ->with('product', $product);
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
        $product = Product::find($id);

        $product->animal_type = $request->animal_type;
        $product->breed = $request->breed;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->gender = $request->gender;
        $product->description = $request->description;

        $product->save();


        $activity = new Activity;

        $activity->user_id = Auth::User()->id;
        $activity->action = "Edit Product";
        $activity->target_id = $product->id;
        $activity->target_name = $product->name;
        $activity->target_type = 4;

        $activity->save();

        if(Auth::User()->user_type == 0){
            return redirect()->route('home')
                ->with('status', $product->name .' has been updated.');
        }else{
            return redirect()->route('product.index')
                ->with('status', $product->name .' has been updated.');
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
        $product = Product::find($id);

        $activity = new Activity;

        $activity->user_id = Auth::User()->id;
        $activity->action = "Delete Product";
        $activity->target_id = $product->id;
        $activity->target_name = $product->name;
        $activity->target_type = 4;

        $activity->save();

        $text = $product->name . ' has been deleted successfully.';
        $product->delete();

        return redirect()->route('product.index')
            ->with('status', $text);
    }

    // Change order by of retailer's products
    public function product_order(Request $request)
    {

        switch($request->order_by){
            case 1:
                $products = Product::where('user_id', Auth::User()->id)
                    ->orderBy('name')
                    ->get();
                break;
            case 2:
                $products = Product::where('user_id', Auth::User()->id)
                    ->orderBy('animal_type')
                    ->get();
                break;
            case 3:
                $products = Product::where('user_id', Auth::User()->id)
                    ->orderBy('price')
                    ->get();
                break;
            case 4:
                $products = Product::where('user_id', Auth::User()->id)
                    ->orderBy('quantity')
                    ->get();
                break;
            case 5:
                $products = Product::where('user_id', Auth::User()->id)
                    ->orderBy('created_at')
                    ->get();
                break;
            default:
                $products = Product::where('user_id', Auth::User()->id)
                    ->orderBy('name')
                    ->get();
        }
        
        return view('products.products')
            ->with('products', $products)
            ->with('order_by', $request->order_by);
    }

    // list all products on the database
    public function list_all_products()
    {
        $products = Product::where('id', '>', 0)
            ->orderBy('name')
            ->get();

        $title = "Products";

        return view('admin.list.products')
            ->with('products', $products)
            ->with('title', $title);
    }

    // list all products of certain type
    public function list_all_products_with_type($animal_type)
    {
        $products = Product::where('animal_type', $animal_type)
                ->orderBy('name')
                ->get();

        return view('admin.list.products_with_type')
            ->with('products', $products)
            ->with('animal_type', $animal_type);
    }

    // list all products added on a certain month and year
    public function list_products_with_date($year, $month)
    {
        $products = Product::whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year)
            ->orderBy('name')
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

        $title = "Products added on ". $month_text .' '. $year;

        return view('admin.list.products_with_date')
            ->with('products', $products)
            ->with('title', $title)
            ->with('year', $year)
            ->with('month', $month);
    }

    // visitor add to cart. fixed price product
    public function guest_buy(Request $request){
        $product = Product::find($request->product_id);
        Session::push('guest.products', [$product, $request->quantity, $product->price * $request->quantity, 1]);

        return redirect()->route('product.show', $request->product_id);
    }

    // visitor add to cart. negotiable price product
    public function guest_deal(Request $request){
        $product = Product::find($request->product_id);
        Session::push('guest.products', [$product, $request->quantity, $request->total_price, 2]);

        return redirect()->route('product.show', $request->product_id);
    }

    // display visitors cart
    public function guest_cart(Request $request){
        return view('guest.cart');
    }
}