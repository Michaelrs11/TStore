<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fashion extends Model
{
    protected $fillable = ['store_id', 'category_id', 'name', 'price', 'stock', 'description', 'image'];

    protected $table = 'fashions';

    public function store(){
    	return $this->belongsTo('App\Store');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function cart(){
        return $this->hasMany('App\Cart');
    }
}
