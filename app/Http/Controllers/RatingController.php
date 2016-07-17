<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Rating as Rating;

class RatingController extends Controller
{
    // Rate Retailers by Buyers.
    public function rate_retailer(Request $request, $retailer_id, $transaction_id){
        $count = Rating::where('transaction_id', $transaction_id)->count();

        if($count == 0){
            $rating = New Rating;
            $rating->retailer_id = $retailer_id;
            $rating->buyer_id = Auth::User()->id;
            $rating->transaction_id = $transaction_id;
            $rating->rate = $request->score;
            $rating->comment = $request->comment;
            $rating->save();
        }else{
            $rating = Rating::where('transaction_id', $transaction_id)->first();
            $rating->rate = $request->score;
            $rating->comment = $request->comment;
            $rating->save();
        }

        return redirect()->route('transaction.index');
    }
}
