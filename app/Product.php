<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    protected $fillable = array('id', 'name', 'cost', 'price', 'supplier_id', 'color', 'quantity', 'period', 'img_url', 'safty_stock', 'demand_quantity', 'eoq');

    public function c_order()
    {
        return $this->hasMany('App\COrder', 'product_id', 'id');
    }

    public function s_order()
    {
        return $this->hasMany('App\SOrder', 'product_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'supplier_id', 'id');
    }

    public function color()
    {
        switch ($this->color) {
            case '黑色':
                return 'black';
                break;
            case '白色':
                return 'white';
                break;
            case '灰色':
                return 'gray';
                break;
            case '紅色':
                return 'red';
                break;
            case '綠色':
                return 'green';
                break;
            case '藍色':
                return 'blue';
                break;
            default:
                return null;
                break;
        }
    }
}
