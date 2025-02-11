<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon; 

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class CashController extends Controller
{
     public function CashOrder(Request $request){


    	if (Session::has('coupon')) {
    		$total_amount = Session::get('coupon')['total_amount'];
			$coupon_name=Session::get('coupon')['coupon_name'];
			$coupon_discount=Session::get('coupon')['coupon_discount'];
    	}else{
    		$total_amount = round(Cart::total());
			$coupon_name=null;
			$coupon_discount=null;
    	}
 
	 

	  // dd($charge);

     $order_id = Order::insertGetId([
     	'user_id' => Auth::id(),
     	'division_id' => $request->division_id,
     	'district_id' => $request->district_id,
     	'state_id' => $request->state_id,
     	'name' => $request->name,
     	'email' => $request->email,
     	'phone' => $request->phone,
     	'post_code' => $request->post_code,
     	'notes' => $request->notes,
         'address'=>$request->address,

     	'payment_type' => 'Cash on delivery',
     	'payment_method' => 'Cash on delivery',
     	 
     	'currency' =>  'usd',
     	'amount' => $total_amount,
         'coupon_name'=>$coupon_name,
		 'coupon_discount'=>$coupon_discount,

     	'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
     	'order_date' => Carbon::now(),
     	'order_month' => Carbon::now()->format('F'),
     	'order_year' => Carbon::now()->format('Y'),
     	'status' => 'pending',
     	'created_at' => Carbon::now(),	 

     ]);

 
	 $invoice = Order::with('division','district','state','user')->where('id',$order_id)->first();
     
	 if($invoice->coupon_name!=NULL){
		$data = [
			'invoice_no' => $invoice->invoice_no,
			'amount' => $total_amount,
			'name' => $invoice->name,
			'email' => $invoice->email,
			'address'=>$invoice->address,
			'phone'=>$invoice->phone,
			'division' => $invoice->division->division_name,
			'district' => $invoice->district->district_name,
			'state' => $invoice->state->state_name,
			'coupon_discount'=>$invoice->coupon_discount,
			'coupon_name'=>$invoice->coupon_name
		];
	 }
	 else{
		$data = [
			'invoice_no' => $invoice->invoice_no,
			'amount' => $total_amount,
			'name' => $invoice->name,
			'email' => $invoice->email,
			'address'=>$invoice->address,
			'phone'=>$invoice->phone,
			'division' => $invoice->division->division_name,
			'district' => $invoice->district->district_name,
			'state' => $invoice->state->state_name,
			'coupon_discount'=>'',
			'coupon_name'=>''
		];
	 }

     	Mail::to($request->email)->send(new OrderMail($data));

     // End Send Email 


     $carts = Cart::content();
     foreach ($carts as $cart) {
     	OrderItem::insert([
     		'order_id' => $order_id, 
     		'product_id' => $cart->id,
     		'color' => $cart->options->color,
     		'size' => $cart->options->size,
     		'qty' => $cart->qty,
     		'price' => $cart->price,
     		'created_at' => Carbon::now(),
			 'item_status'=>'pending'
     	]);
     }


     if (Session::has('coupon')) {
     	Session::forget('coupon');
     }

     Cart::destroy();

     $notification = array(
			'message' => 'Your order was placed successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('dashboard')->with($notification);
 

    } // end method 





}