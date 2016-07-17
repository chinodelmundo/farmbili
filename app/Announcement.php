<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    // retrieves user using user_id of the announcement table
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function get_user_type(){

        switch($this->user_type){
            case 0:
                $user_type = "Administrator";
                break;
            case 1:
                $user_type = "Buyer";
                break;
            case 2:
                $user_type = "Retailer";
                break;
            default:
                $user_type = "All User Types";
        }
        
        return $user_type;
    }
}
