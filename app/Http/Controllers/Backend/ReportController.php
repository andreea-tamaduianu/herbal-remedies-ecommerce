<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DateTime;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
	public function ReportView()
	{

		return view('backend.report.report_view');
	}


	public function ReportByDate(Request $request)
	{
		// return $request->all();
		$date = new DateTime($request->date);
		$formatDate1 = Carbon::parse($date);
		$formatDate2 = Carbon::parse($date)->addDays(1);
		// return $formatDate;
		//echo "<pre>"; print_r($formatDate1);print_r($formatDate2); die;
		$orders = Order::whereBetween('order_date', [$formatDate1, $formatDate2])->latest()->get();
		return view('backend.report.report_show', compact('orders'));
	} // end mehtod 



	public function ReportByMonth(Request $request)
	{

		$orders = Order::where('order_month', $request->month)->where('order_year', $request->year_name)->latest()->get();
		return view('backend.report.report_show', compact('orders'));
	} // end mehtod 


	public function ReportByYear(Request $request)
	{

		$orders = Order::where('order_year', $request->year)->latest()->get();
		return view('backend.report.report_show', compact('orders'));
	} // end mehtod 

	public function ReportViewGraphs()
	{
		//Users
		$current_month_users = User::whereMonth('created_at', Carbon::now()->month)->count();
		$before_1_month_users = User::whereMonth('created_at', Carbon::now()->subMonth(1))->count();
		$before_2_months_users = User::whereMonth('created_at', Carbon::now()->subMonth(2))->count();
		$before_3_months_users = User::whereMonth('created_at', Carbon::now()->subMonth(3))->count();
		$usersCount = array($current_month_users, $before_1_month_users, $before_2_months_users, $before_3_months_users);


		//Orders
		$current_month_orders = Order::whereMonth('created_at', Carbon::now()->month)->count();
		$before_1_month_orders = Order::whereMonth('created_at', Carbon::now()->subMonth(1))->count();
		$before_2_months_orders = Order::whereMonth('created_at', Carbon::now()->subMonth(2))->count();
		$before_3_months_orders = Order::whereMonth('created_at', Carbon::now()->subMonth(3))->count();
		$ordersCount = array($current_month_orders, $before_1_month_orders, $before_2_months_orders, $before_3_months_orders);

		//echo "<pre>"; print_r($ordersCount); die;


		//Categories
		$categories=Category::where('category_status',1)->orderBy('category_name_en', 'ASC')->get();
		$sales=array();
		foreach($categories as $category){
			//$amount = Category::with(['orderItems'])->where('category_name_en', $category->category_name_en)->sum('qty * price ');
			$amount = OrderItem::query()->selectRaw('count(order_items.qty) as count')->join('products','products.id', '=','order_items.product_id')->join('categories', 'categories.id','=','products.category_id')->where('categories.category_name_en', $category->category_name_en)->first();
			
			
				
				array_push($sales, $amount->toArray());
		
			
		}

		$total = OrderItem::query()->selectRaw('count(order_items.qty) as count')->join('products','products.id', '=','order_items.product_id')->join('categories', 'categories.id','=','products.category_id')->where('categories.category_status', 1)->first();
		$total=$total->toArray();
		
		//echo "<pre>"; print_r($total); die;
		return view('backend.report.report_graphs_view', compact('usersCount', 'ordersCount', 'categories', 'sales', 'total'));
	}
}
