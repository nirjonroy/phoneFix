<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Auth;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderProducts')->where('user_id', Auth::id())->latest()->get();

        return view('frontend.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'orderProducts')->findOrFail($id);

        $view = view('frontend.order.show', compact('order'))->render();
        return response()->json([
            'status' => true,
            'html' => $view,
        ]);
    }    
    
    public function print($id)
    {
        $order = Order::with('user', 'orderProducts')->findOrFail($id);
        return view('frontend.order.print', compact('order'));
    }
    
    public function thanks_page()
    {
      	
        return view('frontend.order.thanks_page');
    }
    
    public function payment($id){
        $order_inv = Order::with('orderProducts', 'orderAddress')->where('id', $id)->first();
        // dd($order_inv);
        return view('frontend.cart.payment', compact('order_inv'));
        
    }
}
