<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Auth;
use Carbon\Carbon;
use PDF;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShippedOrderMail;



class OrderController extends Controller
{

	// Pending Orders 
	public function PendingOrders()
	{
		$orders = Order::where('status', 'pending')->orderBy('created_at', 'DESC')->get();
		return view('backend.orders.pending_orders', compact('orders'));
	} // end mehtod 


	// Pending Order Details 
	public function PendingOrdersDetails($order_id)
	{

		$order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();
		$orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
		return view('backend.orders.pending_orders_details', compact('order', 'orderItem'));
	} // end method 



	// Confirmed Orders 
	public function ConfirmedOrders()
	{
		$orders = Order::where('status', 'confirmed')->orderBy('created_at', 'DESC')->get();
		return view('backend.orders.confirmed_orders', compact('orders'));
	} // end mehtod 


	// Processing Orders 
	public function ProcessingOrders()
	{
		$orders = Order::where('status', 'processing')->orderBy('created_at', 'DESC')->get();
		return view('backend.orders.processing_orders', compact('orders'));
	} // end mehtod 


	// Picked Orders 
	public function PickedOrders()
	{
		$orders = Order::where('status', 'picked')->orderBy('created_at', 'DESC')->get();
		return view('backend.orders.picked_orders', compact('orders'));
	} // end mehtod 



	// Shipped Orders 
	public function ShippedOrders()
	{
		$orders = Order::where('status', 'shipped')->orderBy('created_at', 'DESC')->get();
		return view('backend.orders.shipped_orders', compact('orders'));
	} // end mehtod 


	// Delivered Orders 
	public function DeliveredOrders()
	{
		$orders = Order::where('status', 'delivered')->orderBy('created_at', 'DESC')->get();
		return view('backend.orders.delivered_orders', compact('orders'));
	} // end mehtod 


	// Cancel Orders 
	public function CancelOrders()
	{
		$orders = Order::where('status', 'cancelled')->orWhere('status', 'user cancelled')->orderBy('created_at', 'DESC')->get();
		return view('backend.orders.cancelled_orders', compact('orders'));
	} // end mehtod 




	public function PendingToConfirm($order_id)
	{
		$product = OrderItem::where('order_id', $order_id)->get();
		foreach ($product as $item) {
			Product::where('id', $item->product_id)
				->update(['product_qty' => DB::raw('product_qty-' . $item->qty)]);
		}
		Order::findOrFail($order_id)->update(['status' => 'confirmed', 'confirmed_date' => Carbon::now()]);
		OrderItem::where('order_id', $order_id)->update(['item_status'=>'confirmed']);

		$notification = array(
			'message' => 'Order confirmed successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('pending-orders')->with($notification);
	} // end method





	public function ConfirmToProcessing($order_id)
	{

		
		Order::findOrFail($order_id)->update(['status' => 'processing', 'processing_date' => Carbon::now()]);
		OrderItem::where('order_id', $order_id)->update(['item_status'=>'processing']);
		$notification = array(
			'message' => 'Order processed successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('confirmed-orders')->with($notification);
	} // end method



	public function ProcessingToPicked($order_id)
	{

		Order::findOrFail($order_id)->update(['status' => 'picked', 'picked_date' => Carbon::now()]);
		OrderItem::where('order_id', $order_id)->update(['item_status'=>'picked']);
		$notification = array(
			'message' => 'Order picked successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('processing-orders')->with($notification);
	} // end method


	public function PickedToShipped($order_id)
	{

		Order::findOrFail($order_id)->update(['status' => 'shipped', 'shipped_date' => Carbon::now()]);
		OrderItem::where('order_id', $order_id)->update(['item_status'=>'shipped']);
		$notification = array(
			'message' => 'Order shipped successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('picked-orders')->with($notification);
	} // end method


	public function ShippedToDelivered($order_id)
	{
		Order::findOrFail($order_id)->update(['status' => 'delivered', 'delivered_date' => Carbon::now()]);
		OrderItem::where('order_id', $order_id)->update(['item_status'=>'delivered']);
		$notification = array(
			'message' => 'Order delivered successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('shipped-orders')->with($notification);
	} // end method

	public function Cancelled($order_id)
	{

		Order::findOrFail($order_id)->update(['status' => 'cancelled', 'cancel_date' => Carbon::now()]);
		OrderItem::where('order_id', $order_id)->update(['item_status'=>'cancelled']);
		$notification = array(
			'message' => 'Order cancelled successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('cancel-orders')->with($notification);
	} // end method


	public function AdminInvoiceDownload($order_id)
	{

		$order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();
		$orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

		$pdf = PDF::loadView('backend.orders.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
			'tempDir' => public_path(),
			'chroot' => public_path(),
		]);
		return $pdf->download('invoice.pdf');
	} // end method 

	

	public function UpdateShippingInformation(Request $request){
		$request->validate([
            'courier_name' => 'required',
            'tracking_number' => 'required',
            
        ]);

		Order::findOrFail($request->order_id)->update(['courier_name' => $request->courier_name, 'tracking_number' => $request->tracking_number]);
		$order = Order::where('id',$request->order_id)->first();
		Mail::to($order->email)->send(new ShippedOrderMail($order));

        $notification = array(
            'message' => 'Shipping information updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
	}


}
