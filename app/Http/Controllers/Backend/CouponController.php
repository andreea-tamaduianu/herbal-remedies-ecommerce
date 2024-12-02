<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;

use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function CouponView(){
    	$coupons = Coupon::orderBy('id','DESC')->get();
    	return view('backend.coupon.coupon_view',compact('coupons'));

    }


    public function CouponStore(Request $request){

    	$request->validate([
    		'coupon_name' => 'required',
    		'coupon_discount' => 'required',
    		'coupon_validity' => 'required',
    	 
    	]);

    	 

	Coupon::insert([
		'coupon_name' => strtoupper($request->coupon_name),
		'coupon_discount' => $request->coupon_discount, 
		'coupon_validity' => $request->coupon_validity,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Coupon inserted successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 



    public function CouponEdit($id){
     $coupons = Coupon::findOrFail($id);
    	return view('backend.coupon.coupon_edit',compact('coupons'));
    }


    public function CouponUpdate(Request $request, $id){

      Coupon::findOrFail($id)->update([
		'coupon_name' => strtoupper($request->coupon_name),
		'coupon_discount' => $request->coupon_discount, 
		'coupon_validity' => $request->coupon_validity,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Coupon updated successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('coupon.manage')->with($notification);


    } // end mehtod 


    public function CouponDelete($id){

    	Coupon::findOrFail($id)->delete();
    	$notification = array(
			'message' => 'Coupon deleted successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    }

    

    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100), 
                
            ]);
 
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon applied successfully'
            ));
            
        }else{
            return response()->json(['error' => 'Invalid coupon']);
        }

    } // end method 


    public function CouponCalculation(){

        if (Session::has('coupon')) {
            return response()->json(array(
               
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
                'subtotal_amount' => round(Cart::subtotal()),
                'tax_amount' => round(Cart::total()*0.09),   
                'total_without_discount' => round(Cart::total()),
            ));
        }else{
            return response()->json(array(
                'total' => round(Cart::total()),
                'subtotal' => round(Cart::subtotal()),
                 'tax' => round(Cart::total()*0.09),     
            ));

        }
    } // end method 


 // Remove Coupon 
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon removed successfully']);
    }

}
