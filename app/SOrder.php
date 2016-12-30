<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SOrder extends Model
{

    /*
     *  state => {
     *      1 => 已下訂，送貨中...
     *      2 => 已到貨
     *  }
     */
    protected $table = 's_orders';

    protected $fillable = array('id', 'product_id', 'quantity', 'state');

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

}
