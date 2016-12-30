<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use Image;
use Redirect;
use Validator;
use View;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $product = Product::all()->sortByDesc('created_at');
        return view('product.list')->withProducts($product);
    }

    public function add()
    {
        $supplier = Supplier::all();
        return view('product.add')->withSuppliers($supplier);
    }

    public function add_func(Request $request)
    {
        $data = $request->all();
        // return $data;
        $rules = array(
            'name'        => 'required|max:255',
            'cost'        => 'required|integer',
            'price'       => 'required|integer',
            'supplier_id' => 'required',
            'color'       => 'required',
            'period'      => 'required|integer',
        );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('product/add')->withErrors($validator);
        }

        $img_url = '';
        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $img_name = \Date("Y-m-d-h-i-sa") . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save(public_path('upload/product/' . $img_name));
            $img_url = url('upload/product/' . $img_name);
        }

        $product = Product::create([
            'name'            => $data['name'],
            'cost'            => $data['cost'],
            'price'           => $data['price'],
            'supplier_id'     => $data['supplier_id'],
            'color'           => $data['color'],
            'quantity'        => 10,
            'period'          => $data['period'],
            'img_url'         => $img_url,
            'safety_stock'    => rand(10, 22),
            'demand_quantity' => rand(20, 44),

        ]);
        # EOQ
        # 儲存成本為10
        $eoq          = round(sqrt(2 * $product->supplier->cost * $product->demand_quantity / 10));
        $product->eoq = $eoq;
        $product->save();
        return Redirect::to('product/list');
    }

    public function edit($id)
    {
        if ($id == null) {
            return Redirect::to('product/list')->withErrors(['errors' => 'id error']);
        }

        $product = Product::find($id);
        return view('product.edit')->withProduct($product);
    }

    public function edit_func(Request $request)
    {
        $data = $request->all();
        if ($data['id'] == null) {
            return Redirect::to('product/list')->withErrors(['errors' => 'id error']);
        }

        $rules = array(
            'name'   => 'required',
            'cost'   => 'required|integer',
            'price'  => 'required|integer',
            'period' => 'required|integer',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('product/edit/' . $data['id'])->withErrors(['errors' => 'id error']);
        }

        Product::find($data['id'])->update($data);
        return Redirect::to('product/list');
    }
}
