<?php

namespace App\Http\Controllers\ShopWeb;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Validator;

class LoginController extends Controller
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
        return view('shop-web.login');
    }

    public function login(Request $request)
    {
        $data      = $request->all();
        $rules     = ['email' => 'required', 'password' => 'required'];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('web/login')->withErrors($validator)->withInput(Input::except('password'));
        }

        $attempt = Auth::guard('customers')->attempt([
            'email'    => $data['email'],
            'password' => $data['password'],
        ]);
        if (!$attempt) {
            return Redirect::to('web/login')->withErrors(['fail' => 'account or password is wrong!']);
        }

        return Redirect::to('web');
    }

    public function logout()
    {
        Auth::guard('customers')->logout();
        return Redirect::to('web');
    }
}
