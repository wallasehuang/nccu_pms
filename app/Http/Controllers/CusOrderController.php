<?php
namespace App\Http\Controllers;

use App\COrder;
use App\Http\Controllers\Controller;
use View;

class CusOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cus_order = COrder::all()->sortByDesc('created_at');
        return view('cus_order.list')->withCusOrder($cus_order);
    }
}
