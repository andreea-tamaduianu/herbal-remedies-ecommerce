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

use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\ReturnRequests;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use PDF;

class AllUserController extends Controller
{
    public function MyOrders()
    {

        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.order_view', compact('orders'));
    } // end mehtod 



    public function OrderDetails($order_id)
    {

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.order_details', compact('order', 'orderItem', 'order_id'));
    } // end mehtod 



    public function InvoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // return view('frontend.user.order.order_invoice',compact('order','orderItem'));
        $pdf = PDF::loadView('frontend.user.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    } // end mehtod 


    public function ReturnOrder(Request $request, $order_id)
    {

        // Order::findOrFail($order_id)->update([
        //     'return_date' => Carbon::now()->format('d F Y'),
        //     'return_reason' => $request->return_reason,
        //     'returned_order' => 1,
        // ]);

        $productArr = explode("-", $request->product_info);
        $product_code = $productArr[0];
        $product_name = $productArr[1];
        //echo "<pre>"; print_r($request->product_info); die;

        $product_id = Product::where('product_code', $product_code)->get('id')->first();
        $count_items=OrderItem::where(['order_id' => $order_id])->count();
        $count_requests=ReturnRequests::where(['order_id' => $order_id])->count();

        
        OrderItem::where(['order_id' => $order_id, 'product_id' => $product_id->id])->update(['item_status' => 'return initiated']);
        ReturnRequests::insert(['order_id' => $order_id,'product_id'=>$product_id->id, 'user_id' => Auth::user()->id, 'return_reason' => $request->return_reason, 'comment' => $request->comment, 'return_status' => 'pending',  'created_at' => Carbon::now()]);

        $notification = array(
            'message' => 'Return request sent successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 



    public function ReturnOrderList()
    {

        
        $return_requests = ReturnRequests::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
    	return view('frontend.user.order.returned_orders_view',compact( 'return_requests'));

        //$orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', NULL)->orderBy('id', 'DESC')->get();
        // return view('frontend.user.order.returned_orders_view', compact('orders'));
    } // end method 



    public function CancelledOrders()
    {

        $orders = Order::where('user_id', Auth::id())->where('status', 'cancelled')->orWhere('status', 'user cancelled')->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.cancelled_orders_view', compact('orders'));
    } // end method

    public function CancelOrder(Request $request, $order_id)
    {

        Order::findOrFail($order_id)->update(['status' => 'user cancelled', 'cancellation_reason' => $request->cancellation_reason, 'cancel_date' => Carbon::now()]);
        OrderItem::where('order_id', $order_id)->update(['item_status' => 'user cancelled']);
        $notification = array(
            'message' => 'Order cancelled successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


        // return view('frontend.user.order.order_details',compact('order_id'));

    }



    ///////////// Order Traking ///////

    public function OrderTracking(Request $request)
    {

        $invoice = $request->code;

        $track = Order::where('invoice_no', $invoice)->first();

        if ($track) {

            // echo "<pre>";
            // print_r($track);

            return view('frontend.tracking.track_order', compact('track'));
        } else {

            $notification = array(
                'message' => 'Invoice code is invalid',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // end mehtod 

    public function Contact()
    {
        return view('frontend.common.contact_view');
    }
}
