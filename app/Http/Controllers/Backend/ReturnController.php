<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ReturnRequests;
use App\Models\User;
use App\Mail\ProductReturnRequest;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ReturnController extends Controller
{
    public function ReturnRequest(){

    	//$orders = Order::where('returned_order',1)->orderBy('id','DESC')->get();
              
        $return_requests = ReturnRequests::where('return_status', 'pending')->get();
    	return view('backend.return_order.return_request',compact('return_requests'));

    }

    public function ReturnRequestUpdate(Request $request){
    	          
        $return_request = ReturnRequests::where('id', $request->return_id)->first();
        $product_code = Product::where('id', $return_request->product_id)->get('product_code')->first();
        $product_name = Product::where('id', $return_request->product_id)->get('product_name_en')->first();

        ReturnRequests::where('id', $request->return_id)->update(['return_status'=>$request->return_status]);

        OrderItem::where(['order_id' => $return_request->order_id, 'product_id' => $return_request->product_id])->update(['item_status'=>'return '.strtolower($request->return_status)]);

        $userDetails = User::select('email')->where('id', $return_request->user_id)->first();
        $return_request = ReturnRequests::where('id', $request->return_id)->first();

        $messageData=['userDetails'=>$userDetails, 'return_request'=>$return_request, 'product_name'=>$product_name];
        Mail::to($userDetails->email)->send(new ProductReturnRequest($messageData));


        $requests=ReturnRequests::where(['order_id' => $return_request->order_id, 'return_status' => 'approved'])->count();

        $items=OrderItem::where(['order_id' => $return_request->order_id])->count();

        // if($requests==$items){
        //     Order::findOrFail($return_request->order_id)->update([
        //             'return_date' => Carbon::now(),
        //             'returned_order' => 2,
        //         ]);
        // }
    	$notification = array(
            'message' => 'Return request updated successfully and an email was sent to the user.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
  
  

    public function ReturnRequestApprove($order_id){

    	Order::where('id',$order_id)->update(['returned_order' => 2]);

    	$notification = array(
            'message' => 'Order returned successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // end mehtod 


    public function ReturnAllRequest(){

    	// $orders = Order::where('returned_order',2)->orderBy('id','DESC')->get();
    	// return view('backend.return_order.all_return_request',compact('orders'));

        $return_requests = ReturnRequests::all();
    	return view('backend.return_order.all_return_request',compact( 'return_requests'));

    }


}