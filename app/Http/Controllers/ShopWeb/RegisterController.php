<?php

namespace App\Http\Controllers\ShopWeb;

use App\CMarket;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Validator;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop-web.register');
    }

    public function register(Request $request)
    {
        $data  = $request->all();
        $rules = array(
            'name'     => 'required',
            'email'    => 'required|email|unique:customers,email',
            'password' => 'required|confirmed',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::to('web/register')->withErrors($validator);
        }
        $customer_id = Customer::create([
            'name'     => $data['name'],
            'phone'    => $data['phone'],
            'address'  => $data['address'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ])->id;

        CMarket::create([
            'customer_id' => $customer_id,
            'red'         => 0,
            'green'       => 0,
            'blue'        => 0,
            'while'       => 0,
            'black'       => 0,
            'gray'        => 0,
        ]);

        return Redirect::to('web/login');

    }
}
