<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class COrder extends Model
{
    protected $table = 'c_orders';

    protected $fillable = array('id', 'customer_id', 'product_id', 'quantity');

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

}
