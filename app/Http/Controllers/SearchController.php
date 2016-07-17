<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

use App\User as User;
use App\Product as Product;

class SearchController extends Controller
{
    // display all approved retailers product
    public function index()
    {
        $products = Product::select('products.*')
                    ->join('users', 'products.user_id', '=', 'users.id')
                    ->OfApproved()
                    ->OfQuantity()
                    ->orderBy('products.name')
                    ->get();

        return view('search.index')
            ->with('products', $products);
    }

    // search product base on parameters given
    public function search_product(Request $request)
    {
        $price = explode(",", $request->price);

        $products = Product::select('products.*')
                    ->join('users', 'products.user_id', '=', 'users.id')
                    ->OfAnimalType($request->animal_type)
                    ->OfBreed($request->breed)
                    ->OfName($request->name)
                    ->OfPriceMin($price[0])
                    ->OfPriceMax($price[1])
                    ->OfDescription($request->description)
                    ->OfApproved()
                    ->OfQuantity()
                    ->OfRegion($request->region)
                    ->OfProvince($request->province)
                    ->OfCity($request->city)
                    ->orderBy('products.name')
                    ->get();

        $product_params = [$request->animal_type, $request->breed, $request->name, $price[0], $price[1], $request->region, $request->province, $request->city, $request->description];

        return view('search.index')
            ->with('products', $products)
            ->with('product_params', $product_params);
    }

    // search retailers based on the parameters given
    public function search_retailer(Request $request)
    {
        $retailers = User::where('user_type', 2)
                    ->OfFirstName($request->first_name)
                    ->OfLastName($request->last_name)
                    ->OfRegion($request->region)
                    ->OfProvince($request->province)
                    ->OfCity($request->city)
                    ->OfEmail($request->email)
                    ->OfDescription($request->description)
                    ->OfChicken($request->has_chicken)
                    ->OfCow($request->has_cow)
                    ->OfGoat($request->has_goat)
                    ->OfPig($request->has_pig)
                    ->orderBy('first_name')
                    ->get();

        $retailer_params = [$request->first_name, $request->last_name, $request->region, $request->province, $request->city, $request->email, $request->description, $request->has_chicken, $request->has_cow, $request->has_goat, $request->has_pig];

        return view('search.index')
            ->with('retailers', $retailers)
            ->with('retailer_params', $retailer_params);
    }

    // search buyers based on the parameters given
    public function search_buyer(Request $request)
    {
        $buyers = User::where('user_type', 1)
                    ->OfFirstName($request->first_name)
                    ->OfLastName($request->last_name)
                    ->OfRegion($request->region)
                    ->OfProvince($request->province)
                    ->OfCity($request->city)
                    ->OfEmail($request->email)
                    ->OfDescription($request->description)
                    ->orderBy('first_name')
                    ->get();

        $buyer_params = [$request->first_name, $request->last_name, $request->region, $request->province, $request->city, $request->email, $request->description];

        return view('search.index')
            ->with('buyers', $buyers)
            ->with('buyer_params', $buyer_params);
    }
}
