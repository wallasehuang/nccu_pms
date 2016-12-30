<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CMarket extends Model
{
    protected $table = 'c_markets';

    protected $fillable = array('id', 'customer_id', 'red', 'green', 'blue', 'white', 'black', 'gray');

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

}
