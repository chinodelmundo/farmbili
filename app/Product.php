<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function scopeOfAnimalType($query, $animal_type){

        if($animal_type == 0){
            return $query->where('animal_type', '>', 0);
        }else{
            return $query->where('animal_type', $animal_type);
        }
    }

    public function scopeOfBreed($query, $breed){

        if($breed == ""){
            return $query->where('breed', '<>', '');
        }else{
            return $query->where('breed', $breed);
        }
    }

    public function scopeOfName($query, $name){

        if($name == ""){
            return $query->where('products.name', '<>', '');
        }else{
            return $query->where('products.name', 'like', '%'.$name.'%');
        }
    }

    public function scopeOfPriceMin($query, $min){
        return $query->where('price', '>=', $min);
    }

    public function scopeOfPriceMax($query, $max){
        if($max > 0){
            return $query->where('price', '<=', $max);
        }else{
            return $query->where('price', '>', 0);
        }
    }

    public function scopeOfDescription($query, $desc){
        if($desc != ""){
            return $query->where('products.description', 'like', '%'.$desc.'%');
        }else{
            return $query;
        }
    }

    public function scopeOfApproved($query){
       return $query->where('user_type', '2');
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

    public function scopeOfQuantity($query){

        return $query->where('products.quantity', '>', '0');
    }

    public function get_animal_type(){

    	switch($this->animal_type){
    		case 1: 
    			$animal_type = "Chicken";
    			break;
    		case 2: 
    			$animal_type = "Cow";
    			break;
    		case 3: 
    			$animal_type = "Goat";
    			break;
    		case 4: 
    			$animal_type = "Pig";
    			break;
    		default:
    			$animal_type = "";
    	}

    	return $animal_type;
    }

    public function get_animal_breeds(){

    	switch($this->animal_type){
    		case 1: //chicken
    			$animal_breeds = ['Chicken Breed 1', 'Chicken Breed 2'];
    			break;
    		case 2: //cow
    			$animal_breeds = ['Cow Breed 1', 'Cow Breed 2'];
    			break;
    		case 3: //goat
    			$animal_breeds = ['Goat Breed 1', 'Goat Breed 2'];
    			break;
    		case 4: //pig
    			$animal_breeds = ['Pig Breed 1', 'Pig Breed 2'];
    			break;
    		default:
    			$animal_breeds = [''];
    	}

    	return $animal_breeds;
    }
}
