<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function product(){
    	return $this->belongsTo('App\Product');
    }

    public function retailer(){
        return $this->belongsTo('App\User', 'retailer_id');
    }

    public function rating()
    {
        return $this->hasOne('App\Rating');
    }

    public function dialogues(){
        return $this->hasMany('App\Dialogue');
    }

    public function get_status(){

        switch($this->status){
            case 0:
                $status = "Pending";
                break;
            case 1:
                $status = "Approved";
                break;
            case 2:
                $status = "Rejected";
                break;
        }
        
        return $status;
    }

    public function get_status_text_class(){

        switch($this->status){
            case 0:
                $class = "text-primary";
                break;
            case 1:
                $class = "text-success";
                break;
            case 2:
                $class = "text-danger";
                break;
        }
        
        return $class;
    }
}