<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\ShippingDivision;
use App\Models\ShippingDistrict;
use App\Models\ShippingState;

class CheckoutController extends Controller
{


    // Checkout Method 
    public function CheckoutCreate()
    {

        if (Auth::check()) {
            if (Cart::total() > 0) {
                if (Session::has('coupon')) {
                    $carts = Cart::content();
                    $cartQty = Cart::count();
                    $coupon_name= session()->get('coupon')['coupon_name'];
                    $coupon_discount=session()->get('coupon')['coupon_discount'];
                    $discount_amount=session()->get('coupon')['discount_amount'];
                    $total_amount=session()->get('coupon')['total_amount'];
                    $subtotal_amount=round(Cart::subtotal());
                    $tax_amount=round(Cart::tax()*0.09);
                    $total_without_discount=round(Cart::total());
                    $divisions = ShippingDivision::orderBy('division_name', 'ASC')->get();
                    return view('frontend.checkout.checkout_view', compact('carts','cartQty','coupon_name', 'tax_amount', 'coupon_discount', 'discount_amount', 'total_amount','subtotal_amount','total_without_discount', 'divisions'));
                }
                else{
                    $carts = Cart::content();
                    $cartQty = Cart::count();
                    $cartTotal = round(Cart::total());
                    $cartSubtotal = round(Cart::subtotal());
                    $tax = round(Cart::tax()*0.09);
                    $divisions = ShippingDivision::orderBy('division_name', 'ASC')->get();
                    return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'divisions','cartSubtotal', 'tax'));
                }

                
            } else {

                $notification = array(
                    'message' => 'You need to add a product to your cart to proceed',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }
        } else {

            $notification = array(
                'message' => 'You need to login first',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    } // end method 

    public function DistrictGetAjax($division_id){

    	$ship = ShippingDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
    	return json_encode($ship);

    } // end method 


     public function StateGetAjax($district_id){

    	$ship = ShippingState::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
    	return json_encode($ship);

    } // end method 


    public function CheckoutStore(Request $request){
    	// dd($request->all());
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['post_code'] = $request->post_code;
    	$data['division_id'] = $request->division_id;
    	$data['district_id'] = $request->district_id;
    	$data['state_id'] = $request->state_id;
        $data['address'] = $request->address;
    	$data['notes'] = $request->notes;
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_discount'] = $request->coupon_discount;
    	$cartTotal = round(Cart::total());
        $subtotal_amount=round(Cart::subtotal());
        $tax_amount=round(Cart::total()*0.09);
       
        


    	if ($request->payment_method == 'stripe') {
    		return view('frontend.payment.stripe',compact('data','cartTotal','subtotal_amount', 'tax_amount'));
    	}elseif ($request->payment_method == 'card') {
    		return 'card';
    	}else{
            return view('frontend.payment.cash',compact('data','cartTotal','subtotal_amount', 'tax_amount'));
    	}
    	 

    }// end mehtod. 


}
