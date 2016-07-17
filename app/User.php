<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','user_type', 'region', 'province', 'city', 'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function activities(){
        return $this->hasMany('App\Activity');
    }

    public function ratings(){
        return $this->hasMany('App\Rating', 'retailer_id');
    }

    public function scopeOfFirstName($query, $firstName){
        if($firstName == ""){
            return $query->where('first_name', '<>', '');
        }else{
            return $query->where('first_name', 'like', '%'.$firstName.'%');
        }
    }

    public function scopeOfLastName($query, $lastName){
        if($lastName == ""){
            return $query->where('last_name', '<>', '');
        }else{
            return $query->where('last_name', 'like', '%'.$lastName.'%');
        }
    }

    public function scopeOfRegion($query, $region){
        if($region == ""){
            return $query;
        }else{
            return $query->where('region', $region);
        }
    }

    public function scopeOfProvince($query, $province){
        if($province == ""){
            return $query;
        }else{
            return $query->where('province', $province);
        }
    }

    public function scopeOfCity($query, $city){
        if($city == ""){
            return $query;
        }else{
            return $query->where('city', 'like', '%'.$city.'%');
        }
    }


    public function scopeOfEmail($query, $email){
        if($email == ""){
            return $query;
        }else{
            return $query->where('email', $email);
        }
    }

    public function scopeOfDescription($query, $description){
        if($description == ""){
            return $query;
        }else{
            return $query->where('description', 'like', '%'.$description.'%');
        }
    }

    public function scopeOfChicken($query, $has_chicken){
        if($has_chicken){
            return $query->whereExists(function ($query) {
                                            $query->select(DB::raw(1))
                                                ->from('products')
                                                ->whereRaw('products.user_id = users.id')
                                                ->whereRaw('products.animal_type = 1');
                                        });
        }else{
            return $query;
        }
    }

    public function scopeOfCow($query, $has_cow){
        if($has_cow){
            return $query->whereExists(function ($query) {
                                            $query->select(DB::raw(1))
                                                ->from('products')
                                                ->whereRaw('products.user_id = users.id')
                                                ->whereRaw('products.animal_type = 2');
                                        });
        }else{
            return $query;
        }
    }

    public function scopeOfGoat($query, $has_goat){
        if($has_goat){
            return $query->whereExists(function ($query) {
                                            $query->select(DB::raw(1))
                                                ->from('products')
                                                ->whereRaw('products.user_id = users.id')
                                                ->whereRaw('products.animal_type = 3');
                                        });
        }else{
            return $query;
        }
    }

    public function scopeOfPig($query, $has_pig){
        if($has_pig){
            return $query->whereExists(function ($query) {
                                            $query->select(DB::raw(1))
                                                ->from('products')
                                                ->whereRaw('products.user_id = users.id')
                                                ->whereRaw('products.animal_type = 4');
                                        });
        }else{
            return $query;
        }
    }

    public function get_user_type(){

        switch($this->user_type){
            case 0:
                $user_type = "Admin";
                break;
            case 1:
                $user_type = "Buyer";
                break;
            case 2:
                $user_type = "Retailer";
                break;
            case 3:
                $user_type = "Retailer (Unapproved)";
                break;
            default:
                $user_type = "";

        }
        
        return $user_type;
    }

    public function get_status_text_class(){

        switch($this->user_type){
            case 2:
                $class = "text-success";
                break;
            case 3:
                $class = "text-danger";
                break;
            default:
                $class = "";
        }
        
        return $class;
    }

    public function get_name(){

        $name = $this->first_name." ".$this->last_name;
        
        return $name;
    }

}