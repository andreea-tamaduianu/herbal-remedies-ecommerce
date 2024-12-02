<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function AddToCompare($product_id){
        

        $countComparableProducts=Product::where('is_comparable', 1)->count();

        if($countComparableProducts>=4){
            $notification = array(
                'message' => 'There are already 4 products in the comparison list. You can\'t add another!',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        }
        else{
            Product::findOrFail($product_id)->update([
                'is_comparable'=>1
    
            ]);
    
            $notification = array(
                'message' => 'Product successfully added to product comparison list.',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
        
       
    }

    public function RemoveFromCompare($id){
        Product::findOrFail($id)->update(['is_comparable' => 0]);
        $notification = array(
            'message' => 'Product successfully removed from product comparison list.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ViewProductComparison(){
        $comparableProducts=Product::with(['category','subcategory', 'subsubcategory', 'brand'])->where('is_comparable', 1)->orderBy('id', 'DESC')->limit(4)->get();
        return view('frontend.product.product_comparison', compact('comparableProducts'));
    }
}
