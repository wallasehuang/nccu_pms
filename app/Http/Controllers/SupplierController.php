<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use View;

class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $supplier = Supplier::all();
        return view('supplier.list')->withSuppliers($supplier);
    }

    public function add()
    {
        return view('supplier.add');
    }

    public function add_func(Request $request)
    {
        $data  = $request->all();
        $rules = array(
            'name'    => 'required|max:255',
            'phone'   => 'required',
            'address' => 'required',
            'cost'    => 'required',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('supplier/add')->withErrors($validator);
        }
        Supplier::create($data);
        return Redirect::to('supplier/list');
    }

    public function edit($id)
    {
        if ($id == null) {
            return Redirect::to('supplier/list')->withErrors(['errors' => 'id error']);
        }
        $supplier = Supplier::find($id);
        return view('supplier.edit')->withSupplier($supplier);
    }

    public function edit_func(Request $request)
    {
        $data = $request->all();
        if ($data['id'] == null) {
            return Redirect::to('supplier/list')->withErrors(['errors' => 'id error']);
        }
        $rules = array(
            'name'    => 'required',
            'phone'   => 'required',
            'address' => 'required',
            'cost'    => 'required',
        );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('product/edit?id=' . $data['id'])->withErrors($validator);
        }
        Supplier::find($data['id'])->update($data);
        return Redirect::to('supplier/list');
    }
}
