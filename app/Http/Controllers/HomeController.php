<?php

namespace App\Http\Controllers;

use App\COrder;
use App\SOrder;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month_corder = COrder::where(DB::raw('YEAR(created_at)'), 2016)->where(DB::raw('MONTH(created_at)'), date('n'))->get();
        $month_sorder = SOrder::where(DB::raw('YEAR(created_at)'), 2016)->where(DB::raw('MONTH(created_at)'), date('n'))->get();
        $month_sale   = 0;
        if (!is_null($month_corder)) {
            foreach ($month_corder as $order) {
                $month_sale += $order->quantity * $order->product->price;
            }
        }
        $month_scount = $month_sorder->count();
        $month_ccount = $month_corder->count();
        $data         = [
            'month_sale'   => $month_sale,
            'sorder_count' => $month_scount,
            'corder_count' => $month_ccount,
        ];
        return view('home')->withData($data);
    }

    public function home_sale()
    {
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            // $orders_this_month = Order::where(DB::raw('MONTH(created_at)'), '=', date('n'))->get();
            $month_order = COrder::where(DB::raw('YEAR(created_at)'), 2016)->where(DB::raw('MONTH(created_at)'), $i)->get();
            if (is_null($month_order)) {
                $result[] = [$i, 0];
                continue;
            }
            $sum = 0;
            foreach ($month_order as $order) {
                $sum += $order->quantity * $order->product->price;
            }

            $result[] = [$i, $sum];

        }
        return $result;
    }

    public function home_color()
    {
        $orders = COrder::all();
        $data   = [
            'red'   => 0,
            'green' => 0,
            'blue'  => 0,
            'white' => 0,
            'black' => 0,
            'gray'  => 0,
        ];
        foreach ($orders as $order) {
            for ($i = 0; $i < $order->quantity; $i++) {
                $data[$order->product->color()] += 1;
            }
        }
        return $data;
    }

}
