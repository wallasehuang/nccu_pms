<?php
namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;
use View;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customer = Customer::all();
        return view('customer.list')->withCustomers($customer);
    }

    public function detail($id)
    {
        $customer    = Customer::find($id);
        $consumption = 0;
        foreach ($customer->order as $order) {
            $consumption += $order->quantity * $order->product->price;
        }
        return view('customer.detail')->withConsumption($consumption)->withCustomer($customer);

    }
}
