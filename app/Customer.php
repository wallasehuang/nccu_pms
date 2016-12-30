<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = 'customers';

    protected $fillable = array('id', 'name', 'phone', 'password', 'email', 'address');

    protected $hidden = ['password', 'remember_token'];

    public function market_info()
    {
        return $this->hasOne('App\CMarket', 'customer_id', 'id');
    }

    public function order()
    {
        return $this->hasMany('App\COrder', 'customer_id', 'id');
    }
}
