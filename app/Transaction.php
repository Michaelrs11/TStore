<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id','fashion_id','quantity'];

    protected $table = 'transactions';

    public function fashion(){
        return $this->belongsTo('App\Fashion');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
