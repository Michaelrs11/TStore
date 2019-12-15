<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id','fashion_id','quantity'];

    protected $table = 'carts';

    public function fashion(){
        return $this->belongsTo('App\Fashion');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
