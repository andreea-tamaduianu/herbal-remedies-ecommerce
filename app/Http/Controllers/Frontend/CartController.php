<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;



use App\Models\ShipDivision;
 
class CartController extends Controller
{
    public function AddToCart(Request $request, $id){

        //  if (Session::has('coupon')) {
        //    Session::forget('coupon');
        // }
        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            
           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
        }
          
    	$product = Product::findOrFail($id);

    	if ($product->discount_price == NULL) {
    		Cart::add([
    			'id' => $id, 
    			'name' => $request->product_name, 
    			'qty' => $request->quantity, 
    			'price' => $product->selling_price,
    			'weight' => 1, 
    			'options' => [
    				'image' => $product->product_thumbnail,
    				// 'color' => $request->color,
    				'size' => $request->size,
    			], 
    		]);

    		return response()->json(['success' => 'Product successfully added to cart']);
    		 
    	}else{

    		Cart::add([
    			'id' => $id, 
    			'name' => $request->product_name, 
    			'qty' => $request->quantity, 
    			'price' => $product->discount_price,
    			'weight' => 1, 
    			'options' => [
    				'image' => $product->product_thumbnail,
    				// 'color' => $request->color,
    				'size' => $request->size,
    			],
    		]);
    		return response()->json(['success' => 'Product successfully added to cart']);
    	}

    } // end mehtod 


    // Mini Cart Section
    public function AddMiniCart(){

    	$carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();
       // Cart::setGlobalTax(0);
       

        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
        }

        if (Session::has('coupon')) {
            return response()->json(array(
               
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' =>  session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => round($cartTotal), 
            ));

        }
    } // end method 


/// remove mini cart 
    public function RemoveMiniCart($rowId){
    	Cart::remove($rowId);
        if (Session::has('coupon') and Cart::total()==0) {
            Session::forget('coupon');
         }
        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
        }
    	return response()->json(['success' => 'Product successfully removed from cart']);

    } // end mehtod 


   

	public function MyCart(){
       
    	$cartSubtotal = Cart::subtotal();
        $cartTotal = Cart::total();
        //Cart::setGlobalTax(0);
        //$cartTax = Cart::tax();
        $cartTax = round(Cart::total()*0.09);
    	return view('frontend.cart.mycart_view', compact('cartSubtotal', 'cartTotal', 'cartTax'));

    }


    public function GetCartProducts(){
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();
        //Cart::setGlobalTax(0);

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => round($cartTotal),

    	));

    } //end method 



    public function RemoveCartProduct($rowId){
        Cart::remove($rowId);

        if (Session::has('coupon') and Cart::total()==0) {
           Session::forget('coupon');
        }

        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
        }

        return response()->json(['success' => 'Successfully removed product from cart']);
    }


 // Cart Increment 
    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
        }
 

        return response()->json('increment');

    } // end mehtod 


   // Cart Decrement  
    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
        }

        return response()->json('Decrement');

    }// end mehtod 






}