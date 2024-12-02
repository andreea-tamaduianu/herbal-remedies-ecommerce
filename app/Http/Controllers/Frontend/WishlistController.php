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

class WishlistController extends Controller
{
    // add to wishlist mehtod 

    public function AddToWishlist(Request $request, $product_id){

        if (Auth::check()) {

            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if (!$exists) {
               Wishlist::insert([
                'user_id' => Auth::id(), 
                'product_id' => $product_id, 
                'created_at' => Carbon::now(), 
            ]);
           return response()->json(['success' => 'Product added successfully to wishlist']);

            }else{

                return response()->json(['error' => 'This product is already in your wishlist']);

            }            
            
        }else{

            return response()->json(['error' => 'You have to login to add the product to wishlist']);

        }

    } // end method 

    public function ViewWishlist(){
		return view('frontend.wishlist.wishlist_view');
	}

	public function GetWishlistProduct(){

		$wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
		return response()->json($wishlist);
	} // end mehtod 


	public function RemoveWishlistProduct($id){

		Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
		return response()->json(['success' => 'Product successfully removed from wishlist']);
	}
}