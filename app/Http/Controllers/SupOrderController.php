<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\sOrder;
use View;

class SupOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->index_fun();
        $sup_order = SOrder::all();
        return view('sup_order.list')->withSupOrder($sup_order);
    }

    public function index_fun()
    {
        $sup_order = SOrder::where('state', 1)->get();
        foreach ($sup_order as $order) {
            $period  = "+" . $order->product->period . " days";
            $created = strtotime($order->created_at);
            $arrived = strtotime($period, $created);

            if ($arrived <= strtotime("now")) {
                $order->state = 2;
                $order->save();
                $order->product->increment('quantity', $order->quantity);
            }

        }
    }
}
