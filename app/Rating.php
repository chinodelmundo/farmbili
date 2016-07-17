<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function buyer(){
    	return $this->belongsTo('App\User', 'buyer_id');
    }
}
