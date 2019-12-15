<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['user_id', 'name', 'image', 'address','description'];

    protected $table = 'stores';
    
    public function fashions(){
    	$this->hasMany('App\Fashion');
    }

    public function user(){
    	$this->belongsTo('App\User');
    }
}
