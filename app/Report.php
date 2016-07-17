<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function retailer(){
        return $this->belongsTo('App\User', 'retailer_id');
    }

    public function get_status(){

        switch($this->status){
            case 0:
                $status = "Unanswered";
                break;
            case 1:
                $status = "Answered";
                break;
        }
        
        return $status;
    }

    public function scopeUnanswered($query){
        return $query->where('status', '0');
    }

    public function scopeAnswered($query){
        return $query->where('status', '1');
    }
}
