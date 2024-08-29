<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class OrdersController extends Controller
{
  
    public function index()
    {    
        $orders = Order::paginate(10);
        $msj_success =  "";
        return inertia('Orders/index',['orders' => $orders]);
    }


    public function create()
    {
        return inertia('Orders/create');
    }


    public function store(Request $request)
    {
      
        $user = auth()->id();
        $newOrder =   Order::create([
            'user_id' => $user,
            'total_amount' => $request->amount,
        ]);

        $orders = Order::paginate(10);
        return inertia('Orders/index',['orders' => $orders]);
    }

    public function checkout(Request $request)
    {
      $amount = $request->amount;
      $order_id = $request->order_id;
        Stripe::setApiKey(config('stripe.test.sk'));

        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => 'pants',
                        ],
                        'unit_amount'  => $amount,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('orders.success',$order_id),
            'cancel_url'  => route('orders.cancelcheckout', $order_id),
        ]);

        session()->flash('flash.checkoutlink', $session->url);
        return redirect()->back();
    }


    public function success(String $id)
    {    
    
       $order = Order::where('id', $id)->first();
       $order->payment_status = 1;
       $order->update();

       $orders = Order::paginate(10);
       $msj_success =  "La orden ha sido pagada desde la plataforma stripe";
       return inertia('Orders/index',['orders' => $orders, 'msj_success' => $msj_success]);
    }

    public function cancelcheckout(String $id)
    {    
       $orders = Order::paginate(10);
       $msj_success =  "El pago de la orden numero ".$id." no pudo ser procesado por stripe";
       return inertia('Orders/index',['orders' => $orders, 'msj_success' => $msj_success]);
    }

}
