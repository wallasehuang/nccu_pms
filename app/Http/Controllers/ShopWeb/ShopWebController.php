<?php

namespace App\Http\Controllers\ShopWeb;

use App\COrder;
use App\Http\Controllers\Controller;
use App\Product;
use App\SOrder;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Response;
use Validator;

class ShopWebController extends Controller
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

        $recommend = collect();

        if (Auth::guard('customers')->check()) {
            $customer    = Auth::guard('customers')->user();
            $market_info = $customer->market_info;
            $color_sum   = $market_info->red + $market_info->green + $market_info->blue + $market_info->white + $market_info->black + $market_info->gray;
            if ($color_sum != 0) {
                $color_list = collect([
                    ['color' => '紅色', 'count' => $market_info->red, 'rate' => $market_info->red / $color_sum],
                    ['color' => '綠色', 'count' => $market_info->green, 'rate' => $market_info->green / $color_sum],
                    ['color' => '藍色', 'count' => $market_info->blue, 'rate' => $market_info->blue / $color_sum],
                    ['color' => '白色', 'count' => $market_info->white, 'rate' => $market_info->white / $color_sum],
                    ['color' => '黑色', 'count' => $market_info->black, 'rate' => $market_info->black / $color_sum],
                    ['color' => '灰色', 'count' => $market_info->gray, 'rate' => $market_info->gray / $color_sum],
                ]);

                foreach ($color_list->sortByDesc('count') as $item) {
                    $products = Product::where('color', $item['color'])->get()->sortByDesc('quantity');
                    if (round(8 * $item['rate']) <= 0) {
                        continue;
                    }
                    foreach ($products->take(round(8 * $item['rate'])) as $product) {
                        $recommend->push($product);
                    }

                }
            }

        }
        // return $recommend;
        $product = Product::all()->sortByDesc('quantity');
        return view('shop-web.content')->withProducts($product)->withRecommends($recommend);
    }

    public function buy(Request $request)
    {

        if (!Auth::guard('customers')->check()) {
            return Redirect::to('web/login');
        }

        $customer = Auth::guard('customers')->user();
        $data     = $request->all();
        $rule     = [
            'product_id' => 'required',
            'quantity'   => 'required|min:1',
        ];

        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::to('web')->withErrors($validator);
        }

        $product = Product::find($data['product_id']);
        $product->decrement('quantity', $data['quantity']);

        COrder::create([
            'customer_id' => $customer->id,
            'product_id'  => $data['product_id'],
            'quantity'    => $data['quantity'],
        ]);

        $count = 0;
        for ($i = 0; $i < $data['quantity']; $i++) {
            $count++;
        }
        $customer->market_info->increment($product->color(), $count);

        # supplier order
        if ($product->quantity <= $product->safty_stock) {
            $s_order = SOrder::where('product_id', $product->id)->where('state', 1)->get()->last();
            if (is_null($s_order)) {
                SOrder::create([
                    'product_id' => $product->id,
                    'quantity'   => $product->eoq,
                    'state'      => 1,
                ]);
            }

        }
        return Redirect::to('web');

    }

}
