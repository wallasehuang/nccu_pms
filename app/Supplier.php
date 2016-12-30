<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = array('id', 'name', 'phone', 'address', 'cost');

    public function s_order()
    {
        return $this->hasMany('App\SOrder', 'supplier_id', 'id');
    }
}
