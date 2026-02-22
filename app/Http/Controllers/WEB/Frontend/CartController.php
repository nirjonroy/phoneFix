<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\FlashSaleProduct;
use App\Models\Shipping;
use Auth;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        dd($cart);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {         
        // dd($request->all());
        
        $item = Product::findOrFail($request->id);
        $cart = session()->get('cart', []);           
       
        $stock = $item->qty - $item->sold_qty;
        if($stock <= 0 || $stock < $request->quantity)
        {
            return response()->json([
                'status' => false,
                'msg' => 'Stock not available!'
                ], 200);
        }

        if(isset($cart[$request->id]))
        {
            if($cart[$request->id]['quantity'] < $stock)
            {
                $cart[$request->id]['quantity'] += 1;
                $cart[$request->id]['variation'] = $request->variation;
            }
            else {
                return response()->json([
                    'status' => false,
                    'msg' => 'Stock not available!'
                    ], 200);
            }

        }

        else{
            $price = !empty($item->offer_price) ? $item->offer_price : $item->price;
            $cart[$request->id] = [
                'name' => $item ->name,
                'image' => $item ->thumb_image,
                'quantity' => $request->quantity,
                'is_free_shipping' => $item->is_free_shipping,
                'price' => $price,
                'coupon_name' => '',
                'offer_type' => 0,
                'variation' => $request->variation ?? '',
            ];
        }

        session()->put('cart', $cart);


        return response()->json([
            'status' => true,
            'totalItems' => totalCartItems(),            
            'msg' => 'Item has been added!',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
  
    

    public function increaseQty($id)
    {
        $item = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id]))
        {
           $newQty = $cart[$id]['quantity'] + 1;
           if($item->qty < $newQty)
           {
                return response()->json([
                    'status' => false,
                    'msg' => 'Stock not available!'
                    ], 200);
           }

           $cart[$id]['quantity'] =  $newQty;
           session()->put('cart', $cart);

           return response()->json([
               'status' => true,
               'totalItems' => totalCartItems(),
               'msg' => 'Item quantity increased!'
           ], 200);
        }
    }    
    
    public function decreaseQty($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id]))
        {
            if($cart[$id]['quantity'] == 1)
            {
                unset($cart[$id]);
                session()->put('cart', $cart);
                return response()->json([
                    'status' => true,
                    'totalItems' => totalCartItems(),
                    'msg' => 'Item has been removed!'
                ], 200);
            }
            else {
                $cart[$id]['quantity'] -= 1;
                session()->put('cart', $cart);
                return response()->json([
                    'status' => true,
                    'msg' => 'Item quantity decreased!'
                ], 200);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id]))
        {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return response()->json([
                'status' => true,
                'totalItems' => totalCartItems(),
                'msg' => 'Item has been removed!',
            ], 200);
        }
    }
    
    
    public function calculateCartTotal($user, $request_coupon, $request_shipping_method_id)
    {
        $total_price = 0;
        $coupon_price = 0;
        $shipping_fee = 0;
        $productWeight = 0;

        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            $notification = trans("Your shopping cart is empty");

            return response()->json(["status"=>false, "msg" => $notification]);
        }

        foreach ($cart as $index => $cartProduct) {
            $variantPrice = 0;

            if (!empty($cartProduct['variation'])) {
                    $item = ProductVariantItem::find(
                        $cartProduct['variation']
                    );

                    if ($item) {
                        $variantPrice = $item->price;
                    }
                }

            $product = Product::select(
                "id",
                "price",
                "offer_price",
                "weight"
            )->find($index);

            $price = $product->offer_price
                ? $product->offer_price
                : $product->price;

            $price = $variantPrice > 0 ? $variantPrice : $price;
            $weight = $product->weight;
            $weight = $weight * $cartProduct['quantity'];
            $productWeight += $weight;
            $isFlashSale = FlashSaleProduct::where([
                "product_id" => $product->id,
                "status" => 1,
            ])->first();

            $today = date("Y-m-d H:i:s");

            if ($isFlashSale) {
                $flashSale = FlashSale::first();
                if ($flashSale->status == 1) {
                    if ($today <= $flashSale->end_time) {
                        $offerPrice = ($flashSale->offer / 100) * $price;

                        $price = $price - $offerPrice;
                    }
                }
            }

            $price = $price * $cartProduct['quantity'];
            $total_price += $price;
        }


        // calculate coupon coast

        if ($request_coupon) {
            $coupon = Coupon::where([
                "code" => $request_coupon,
                "status" => 1,
            ])->first();


            if ($coupon) {
                if ($coupon->expired_date >= date("Y-m-d")) {
                    if ($coupon->apply_qty < $coupon->max_quantity) {
                        if ($coupon->offer_type == 1) {
                            $couponAmount = $coupon->discount;

                            $couponAmount =
                                ($couponAmount / 100) * $total_price;
                        } elseif ($coupon->offer_type == 2) {
                            $couponAmount = $coupon->discount;
                        }

                        $coupon_price = $couponAmount;
                        $qty = $coupon->apply_qty;
                        $qty = $qty + 1;
                        $coupon->apply_qty = $qty;
                        $coupon->save();
                    }
                }
            }

        }

        $shipping = Shipping::find($request_shipping_method_id);

        if (!$shipping) {
            return response()->json(
                ["message" => trans("Shipping method not found")],
                403
            );
        }

        if ($shipping->shipping_fee == 0) {
            $shipping_fee = 0;
        } else {
            $shipping_fee = $shipping->shipping_fee;
        }

        $total_price = $total_price - $coupon_price + $shipping_fee;

        $total_price = str_replace(
            ['\'', '"', ",", ";", "<", ">"],
            "",
            $total_price
        );

        $total_price = number_format($total_price, 2, ".", "");

        $arr = [];
        $arr["total_price"] = $total_price;
        $arr["coupon_price"] = $coupon_price;
        $arr["shipping_fee"] = $shipping_fee;
        $arr["shipping"] = $shipping;
        return $arr;
}
    

    public function applyCoupon(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'exists:coupons'],
        ]);

        $shipping_id = 1;

        $coupon = Coupon::where(['code' => $request->code, 'status' => 1])->first();

        if(!$coupon){
            return response()->json([
                'status' => false,
                'msg' => 'Coupon not found!',
            ]);
        }

        if($coupon->expired_date < date('Y-m-d')){
            return response()->json([
                'status' => false,
                'msg' => 'Coupon already expired!',
            ]);
        }

        if($coupon->apply_qty >=  $coupon->max_quantity ){
            $notification = trans('Sorry! You can not apply this coupon');
            return response()->json(['message' => $notification],403);
        }

        $user = Auth::user();
        
        $total = $this->calculateCartTotal(
            $user,
            $coupon->code,
            $shipping_id
        );

        session()->put('coupon', $coupon);
        return response()->json([
    'status' => true,
    'msg' => 'Coupon has been applied',
    'coupon' => $coupon,
    
]);
    }
}
