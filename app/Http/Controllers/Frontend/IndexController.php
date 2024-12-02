<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\MultiImage;
use App\Models\Message;
use App\Models\NewsletterSubscriber;
use App\Models\ProductAttributes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{
	public function index()
	{
		$blogpost = BlogPost::latest()->get();
		$categories = Category::orderBy('category_name_en', 'ASC')->where('category_status', 1)->get();
		$sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
		$products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
		$featured = Product::where('featured', 1)->where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
		$hot_deals = Product::where('hot_deals', 1)->where('status', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();
		$skip_category_0 = Category::skip(1)->first();
		$skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->get();

		$skip_category_1 = Category::skip(2)->first();
		$skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();

		$skip_brand_1 = Brand::skip(3)->first();
		$skip_brand_product_1 = Product::where('status', 1)->where('brand_id', $skip_brand_1->id)->orderBy('id', 'DESC')->get();

		return view('frontend.index', compact('categories', 'sliders', 'skip_brand_product_1', 'skip_brand_1', 'products', 'featured', 'blogpost', 'hot_deals', 'skip_category_0', 'skip_category_1', 'skip_product_1', 'skip_product_0'));
	}

	public function UserLogout()
	{
		Auth::logout();
		return Redirect()->route('dashboard');
	}

	public function UserProfile()
	{
		$id = Auth::user()->id;
		$user = User::find($id);
		return view('frontend.profile.user_profile', compact('user'));
	}

	public function UserProfileStore(Request $request)
	{
		$data = User::find(Auth::user()->id);
		$data->name = $request->name;
		$data->email = $request->email;
		$data->phone = $request->phone;


		if ($request->file('profile_photo_path')) {
			$file = $request->file('profile_photo_path');
			@unlink(public_path('upload/user_images/' . $data->profile_photo_path));
			$filename = date('YmdHi') . $file->getClientOriginalName();
			$file->move(public_path('upload/user_images'), $filename);
			$data['profile_photo_path'] = $filename;
		}
		$data->save();

		$notification = array(
			'message' => 'User profile updated successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('dashboard')->with($notification);
	} // end method 


	public function UserChangePassword()
	{
		$id = Auth::user()->id;
		$user = User::find($id);
		return view('frontend.profile.user_change_password', compact('user'));
	}


	public function UserUpdatePassword(Request $request)
	{
		$request->validate([
			'oldpassword' => 'required',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required|same:password',
		], [
			'password_confirmation.same' => 'The confirmation password must be the same as the new password!',

		]);

		$hashedPassword = Auth::user()->password;


		if (Hash::check($request->oldpassword, $hashedPassword)) {

			if (!Hash::check($request->password, $hashedPassword)) {

				$user = User::find(Auth::id());
				$user->password = Hash::make($request->password);
				$user->save();


				$notification = array(
					'message' => 'Password was changed successfully',
					'alert-type' => 'success'
				);
				return redirect()->back()->with($notification);
			} else {
				$notification = array(
					'message' => 'Your new password cannot be the old password!',
					'alert-type' => 'error'
				);
				return redirect()->back()->with($notification);
			}
		} else {
			$notification = array(
				'message' => 'Your old password does not match!',
				'alert-type' => 'error'
			);
			return redirect()->back()->with($notification);
		}
	} // end method

	public function ProductDetails($id, Request $request)
	{
		$product = Product::with('category', 'subcategory', 'subsubcategory', 'attributes')->where('status', 1)->findOrFail($id);

		$data = $request->all();
		// $color_en = $product->product_color_en;
		// $product_color_en = explode(',', $color_en);

		// $color_ro = $product->product_color_ro;
		// $product_color_ro = explode(',', $color_ro);

		$size_en = $product->product_size_en;
		// $product_size_en = explode(',', $size_en);

		$size_ro = $product->product_size_ro;
		// $product_size_ro = explode(',', $size_ro);


		// $selected_size = null;
		// $price_per_size = null;
		// $stock_per_size = null;
		// if (isset($data['size']) && !empty($data['size'])) {
		// 	$attribute = ProductAttributes::where('product_id', $id)->where('size', $data['size'])->first();
		// 	$price_per_size = $attribute->price;
		// 	$stock_per_size = $attribute->stock;
		// 	$selected_size = $data['size'];
		// }

		$multiImag = MultiImage::where('product_id', $id)->get();
		$total_stock = ProductAttributes::where('product_id', $id)->sum('stock');
		$cat_id = $product->category_id;
		$relatedProduct = Product::where('category_id', $cat_id)->where('status', 1)->where('id', '!=', $id)->inRandomOrder()->orderBy('id', 'DESC')->get();
		return view('frontend.product.product_details', compact('product', 'multiImag', 'relatedProduct'));
	}



	public function TagWiseProduct($tag, Request $request)
	{	$data = $request->all();
		$products = Product::where('status', 1)->where('product_tags_en', $tag)->orWhere('product_tags_ro', $tag);
		$categories = Category::orderBy('category_name_en', 'ASC')->get();
		
		if (isset($data['sort']) && !empty($data['sort'])) {
			if ($data['sort'] == "product_latest") {
				$products->orderBy('id', 'Desc');
			} else if ($data['sort'] == "product_name_a_z") {
				$products->orderBy('product_name_en', 'Asc');
			} else if ($data['sort'] == "product_name_z_a") {
				$products->orderBy('product_name_en', 'Desc');
			} else if ($data['sort'] == "price_lowest") {

				$products->orderBy('discount_price', 'Asc');
			} else if ($data['sort'] == "price_highest") {
				$products->orderBy('discount_price', 'Desc');
			}
		} else {
			$products->orderBy('id', 'Desc');
		}

		$products = $products->paginate(3);

		return view('frontend.tags.tags_view', compact('products', 'categories', 'tag'));
	}

	public function BrandWiseProduct(Request $request, $slug)
	{
		Paginator::useBootstrap();
		$data = $request->all();
		
		$breadbrand = Brand::where('brand_slug_en', $slug)->first();


		$brandCount = Brand::where(['brand_slug_en' => $slug])->count();
		if ($brandCount > 0) {
			$products = Product::with(['brand'])->where('status', 1)->where('brand_id', $breadbrand->id);

			$selected_category = null;
			if (isset($data['categoryFilter']) && !empty($data['categoryFilter'])) {
				$category = Category::where('category_name_en', $data['categoryFilter'])->first();
				$products->where('products.category_id', $category->id);
				$selected_category = $data['categoryFilter'];
				// echo "<pre>";
				// print_r($selected_category);
				// die;
			}

			$selected_subcategory = null;
			if (isset($data['subcategoryFilter']) && !empty($data['subcategoryFilter'])) {
				$subcategory = Subcategory::where('subcategory_name_en', $data['subcategoryFilter'])->first();
				$products->where('products.subcategory_id', $subcategory->id);
				$selected_subcategory = $data['subcategoryFilter'];
			}

			$selected_subsubcategory = null;
			if (isset($data['subsubcategoryFilter']) && !empty($data['subsubcategoryFilter'])) {
				$subsubcategory = Subsubcategory::where('subsubcategory_name_en', $data['subsubcategoryFilter'])->first();
				$products->where('products.subsubcategory_id', $subsubcategory->id);
				$selected_subsubcategory = $data['subsubcategoryFilter'];
			}


			$selected_brand = null;
			if (isset($data['brandFilter']) && !empty($data['brandFilter'])) {
				$brand = Brand::where('brand_name_en', $data['brandFilter'])->first();
				$products->where('products.brand_id', $brand->id);
				$selected_brand = $data['brandFilter'];
			}

			$selected_benefit = null;
			if (isset($data['benefitFilter']) && !empty($data['benefitFilter'])) {

				$products->whereIn('products.product_benefit_en', $data['benefitFilter']);
				$selected_benefit = $data['benefitFilter'];
			}

			$selected_type = null;
			if (isset($data['typeFilter']) && !empty($data['typeFilter'])) {

				$products->whereIn('products.product_type_en', $data['typeFilter']);
				$selected_type = $data['typeFilter'];
			}

			$selected_destination = null;
			if (isset($data['destinationFilter']) && !empty($data['destinationFilter'])) {

				$products->whereIn('products.destinated_to_en', $data['destinationFilter']);
				$selected_destination = $data['destinationFilter'];
			}

			$selected_use = null;
			if (isset($data['useFilter']) && !empty($data['useFilter'])) {

				$products->whereIn('products.mode_of_use_en', $data['useFilter']);
				$selected_use = $data['useFilter'];
			}

			$selected_size = null;
			if (isset($data['sizeFilter']) && !empty($data['sizeFilter'])) {
				$products->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
					->select('products.*', 'product_attributes.product_id', 'product_attributes.size')

					->whereIn('product_attributes.size', $data['sizeFilter']);
				$selected_size = $data['sizeFilter'];
			}


			$selected_max_price = null;
			if (isset($data['product_max_price'])) {
				$products->where('selling_price', '<=', $data['product_max_price']);
				$selected_max_price = $data['product_max_price'];
			}

			$selected_min_price = null;
			if (isset($data['product_min_price'])) {
				$products->where('selling_price', '>=', $data['product_min_price']);
				$selected_min_price = $data['product_min_price'];
			}


			if (isset($data['sort']) && !empty($data['sort'])) {
				if ($data['sort'] == "product_latest") {
					$products->orderBy('id', 'Desc');
				} else if ($data['sort'] == "product_name_a_z") {
					$products->orderBy('product_name_en', 'Asc');
				} else if ($data['sort'] == "product_name_z_a") {
					$products->orderBy('product_name_en', 'Desc');
				} else if ($data['sort'] == "price_lowest") {

					$products->orderBy('discount_price', 'Asc');
				} else if ($data['sort'] == "price_highest") {
					$products->orderBy('discount_price', 'Desc');
				}
			} else {
				$products->orderBy('products.id', 'Desc');
			}



			$products = $products->paginate(3);

			//  Load More Product with Ajax 
			
			return view('frontend.product.brand_view', compact('products', 'slug', 'breadbrand', 'selected_brand', 'selected_destination', 'selected_use', 'selected_benefit', 'selected_size', 'selected_min_price', 'selected_max_price', 'selected_subcategory', 'selected_subsubcategory', 'selected_category', 'selected_type'));
		}
	}

	public function CatWiseProduct(Request $request, $slug)
	{
		Paginator::useBootstrap();
		$data = $request->all();
		
		$breadcat = Category::where('category_slug_en', $slug)->first();


		$categoryCount = Category::where(['category_slug_en' => $slug, 'category_status' => 1])->count();
		if ($categoryCount > 0) {
			$products = Product::with(['category', 'brand'])->where('products.status', 1)->where('category_id', $breadcat->id);

			$selected_category = null;
			if (isset($data['categoryFilter']) && !empty($data['categoryFilter'])) {
				$category = Category::where('category_name_en', $data['categoryFilter'])->first();
				$products->where('products.category_id', $category->id);
				$selected_category = $data['categoryFilter'];
				// echo "<pre>";
				// print_r($selected_category);
				// die;
			}

			$selected_subcategory = null;
			if (isset($data['subcategoryFilter']) && !empty($data['subcategoryFilter'])) {
				$subcategory = Subcategory::where('subcategory_name_en', $data['subcategoryFilter'])->first();
				$products->where('products.subcategory_id', $subcategory->id);
				$selected_subcategory = $data['subcategoryFilter'];
			}

			$selected_subsubcategory = null;
			if (isset($data['subsubcategoryFilter']) && !empty($data['subsubcategoryFilter'])) {
				$subsubcategory = Subsubcategory::where('subsubcategory_name_en', $data['subsubcategoryFilter'])->first();
				$products->where('products.subsubcategory_id', $subsubcategory->id);
				$selected_subsubcategory = $data['subsubcategoryFilter'];
			}


			$selected_brand = null;
			if (isset($data['brandFilter']) && !empty($data['brandFilter'])) {
				$brand = Brand::where('brand_name_en', $data['brandFilter'])->first();
				$products->where('products.brand_id', $brand->id);
				$selected_brand = $data['brandFilter'];
			}

			$selected_benefit = null;
			if (isset($data['benefitFilter']) && !empty($data['benefitFilter'])) {

				$products->whereIn('products.product_benefit_en', $data['benefitFilter']);
				$selected_benefit = $data['benefitFilter'];
			}

			$selected_type = null;
			if (isset($data['typeFilter']) && !empty($data['typeFilter'])) {

				$products->whereIn('products.product_type_en', $data['typeFilter']);
				$selected_type = $data['typeFilter'];
			}

			$selected_destination = null;
			if (isset($data['destinationFilter']) && !empty($data['destinationFilter'])) {

				$products->whereIn('products.destinated_to_en', $data['destinationFilter']);
				$selected_destination = $data['destinationFilter'];
			}

			$selected_use = null;
			if (isset($data['useFilter']) && !empty($data['useFilter'])) {

				$products->whereIn('products.mode_of_use_en', $data['useFilter']);
				$selected_use = $data['useFilter'];
			}

			$selected_size = null;
			if (isset($data['sizeFilter']) && !empty($data['sizeFilter'])) {
				$products->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
					->select('products.*', 'product_attributes.product_id', 'product_attributes.size')

					->whereIn('product_attributes.size', $data['sizeFilter']);
				$selected_size = $data['sizeFilter'];
			}


			$selected_max_price = null;
			if (isset($data['product_max_price'])) {
				$products->where('selling_price', '<=', $data['product_max_price']);
				$selected_max_price = $data['product_max_price'];
			}

			$selected_min_price = null;
			if (isset($data['product_min_price'])) {
				$products->where('selling_price', '>=', $data['product_min_price']);
				$selected_min_price = $data['product_min_price'];
			}


			if (isset($data['sort']) && !empty($data['sort'])) {
				if ($data['sort'] == "product_latest") {
					$products->orderBy('id', 'Desc');
				} else if ($data['sort'] == "product_name_a_z") {
					$products->orderBy('product_name_en', 'Asc');
				} else if ($data['sort'] == "product_name_z_a") {
					$products->orderBy('product_name_en', 'Desc');
				} else if ($data['sort'] == "price_lowest") {

					$products->orderBy('discount_price', 'Asc');
				} else if ($data['sort'] == "price_highest") {
					$products->orderBy('discount_price', 'Desc');
				}
			} else {
				$products->orderBy('products.id', 'Desc');
			}



			$products = $products->paginate(3);

			//  Load More Product with Ajax 
			
			return view('frontend.product.category_view', compact('products', 'slug', 'breadcat', 'selected_brand', 'selected_destination', 'selected_use', 'selected_benefit', 'selected_size', 'selected_min_price', 'selected_max_price', 'selected_subcategory', 'selected_subsubcategory', 'selected_category', 'selected_type'));
		}
	}

	// Subcategory wise data
	public function SubCatWiseProduct(Request $request, $slug)
	{
		Paginator::useBootstrap();
		$data = $request->all();
		$subcat_id = Subcategory::where('subcategory_slug_en', $slug)->pluck('id')->first();

		// $sizes=ProductAttributes::where('product_id', $id)->pluck('size')->toArray();
		//$products = Product::where('status', 1)->where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(1);

		$categories = Category::orderBy('category_name_en', 'ASC')->get();

		$breadsubcat = Subcategory::with(['category'])->where('subcategory_slug_en', $slug)->first();


		$subcategoryCount = Subcategory::where(['subcategory_slug_en' => $slug, 'subcategory_status' => 1])->count();
		if ($subcategoryCount > 0) {
			$products = Product::with(['subcategory', 'brand'])->where('products.status', 1)->where('subcategory_id', $breadsubcat->id);

			$selected_category = null;
			if (isset($data['categoryFilter']) && !empty($data['categoryFilter'])) {
				$category = Category::where('category_name_en', $data['categoryFilter'])->first();
				$products->where('products.category_id', $category->id);
				$selected_category = $data['categoryFilter'];
				// echo "<pre>";
				// print_r($selected_category);
				// die;
			}

			$selected_subcategory = null;
			if (isset($data['subcategoryFilter']) && !empty($data['subcategoryFilter'])) {
				$subcategory = Subcategory::where('subcategory_name_en', $data['subcategoryFilter'])->first();
				$products->where('products.subcategory_id', $subcategory->id);
				$selected_subcategory = $data['subcategoryFilter'];
			}

			$selected_subsubcategory = null;
			if (isset($data['subsubcategoryFilter']) && !empty($data['subsubcategoryFilter'])) {
				$subsubcategory = Subsubcategory::where('subsubcategory_name_en', $data['subsubcategoryFilter'])->first();
				$products->where('products.subsubcategory_id', $subsubcategory->id);
				$selected_subsubcategory = $data['subsubcategoryFilter'];
			}


			$selected_brand = null;
			if (isset($data['brandFilter']) && !empty($data['brandFilter'])) {
				$brand = Brand::where('brand_name_en', $data['brandFilter'])->first();
				$products->where('products.brand_id', $brand->id);
				$selected_brand = $data['brandFilter'];
			}

			$selected_benefit = null;
			if (isset($data['benefitFilter']) && !empty($data['benefitFilter'])) {

				$products->whereIn('products.product_benefit_en', $data['benefitFilter']);
				$selected_benefit = $data['benefitFilter'];
			}

			$selected_type = null;
			if (isset($data['typeFilter']) && !empty($data['typeFilter'])) {

				$products->whereIn('products.product_type_en', $data['typeFilter']);
				$selected_type = $data['typeFilter'];
			}

			$selected_destination = null;
			if (isset($data['destinationFilter']) && !empty($data['destinationFilter'])) {

				$products->whereIn('products.destinated_to_en', $data['destinationFilter']);
				$selected_destination = $data['destinationFilter'];
			}

			$selected_use = null;
			if (isset($data['useFilter']) && !empty($data['useFilter'])) {

				$products->whereIn('products.mode_of_use_en', $data['useFilter']);
				$selected_use = $data['useFilter'];
			}

			$selected_size = null;
			if (isset($data['sizeFilter']) && !empty($data['sizeFilter'])) {
				$products->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
					->select('products.*', 'product_attributes.product_id', 'product_attributes.size')

					->whereIn('product_attributes.size', $data['sizeFilter']);
				$selected_size = $data['sizeFilter'];
			}


			$selected_max_price = null;
			if (isset($data['product_max_price'])) {
				$products->where('selling_price', '<=', $data['product_max_price']);
				$selected_max_price = $data['product_max_price'];
			}

			$selected_min_price = null;
			if (isset($data['product_min_price'])) {
				$products->where('selling_price', '>=', $data['product_min_price']);
				$selected_min_price = $data['product_min_price'];
			}


			if (isset($data['sort']) && !empty($data['sort'])) {
				if ($data['sort'] == "product_latest") {
					$products->orderBy('id', 'Desc');
				} else if ($data['sort'] == "product_name_a_z") {
					$products->orderBy('product_name_en', 'Asc');
				} else if ($data['sort'] == "product_name_z_a") {
					$products->orderBy('product_name_en', 'Desc');
				} else if ($data['sort'] == "price_lowest") {

					$products->orderBy('discount_price', 'Asc');
				} else if ($data['sort'] == "price_highest") {
					$products->orderBy('discount_price', 'Desc');
				}
			} else {
				$products->orderBy('products.id', 'Desc');
			}



			$products = $products->paginate(3);

			//  Load More Product with Ajax 
			if ($request->ajax()) {
				$grid_view = view('frontend.product.grid_view_product', compact('products'))->render();

				$list_view = view('frontend.product.list_view_product', compact('products'))->render();
				return response()->json(['grid_view' => $grid_view, 'list_view', $list_view]);
			}
			//  End Load More Product with Ajax 
			return view('frontend.product.subcategory_view', compact('products', 'slug', 'breadsubcat', 'selected_brand', 'selected_destination', 'selected_use', 'selected_benefit', 'selected_size', 'selected_min_price', 'selected_max_price', 'selected_subcategory', 'selected_subsubcategory', 'selected_category', 'selected_type'));
		}
	}

	// Sub-Subcategory wise data
	public function SubSubCatWiseProduct($slug, Request $request)
	{
		Paginator::useBootstrap();
		$breadsubsubcat = Subsubcategory::with(['category', 'subcategory'])->where('subsubcategory_slug_en', $slug)->first();
		$categories = Category::orderBy('category_name_en', 'ASC')->get();
		//if ($request->ajax()) {
		$data = $request->all();
		//echo "<pre>"; print_r($data); die;
		//$url = $data['url'];
		$subsubcategoryCount = Subsubcategory::where(['subsubcategory_slug_en' => $slug, 'subsubcategory_status' => 1])->count();
		if ($subsubcategoryCount > 0) {
			$products = Product::with(['subsubcategory', 'brand'])->where('products.status', 1)->where('subsubcategory_id', $breadsubsubcat->id);

			$selected_category = null;
			if (isset($data['categoryFilter']) && !empty($data['categoryFilter'])) {
				$category = Category::where('category_name_en', $data['categoryFilter'])->first();
				$products->where('products.category_id', $category->id);
				$selected_category = $data['categoryFilter'];
				// echo "<pre>";
				// print_r($selected_category);
				// die;
			}

			$selected_subcategory = null;
			if (isset($data['subcategoryFilter']) && !empty($data['subcategoryFilter'])) {
				$subcategory = Subcategory::where('subcategory_name_en', $data['subcategoryFilter'])->first();
				$products->where('products.subcategory_id', $subcategory->id);
				$selected_subcategory = $data['subcategoryFilter'];
			}

			$selected_subsubcategory = null;
			if (isset($data['subsubcategoryFilter']) && !empty($data['subsubcategoryFilter'])) {
				$subsubcategory = Subsubcategory::where('subsubcategory_name_en', $data['subsubcategoryFilter'])->first();
				$products->where('products.subsubcategory_id', $subsubcategory->id);
				$selected_subsubcategory = $data['subsubcategoryFilter'];
			}


			$selected_brand = null;
			if (isset($data['brandFilter']) && !empty($data['brandFilter'])) {
				$brand = Brand::where('brand_name_en', $data['brandFilter'])->first();
				$products->where('products.brand_id', $brand->id);
				$selected_brand = $data['brandFilter'];
			}

			$selected_benefit = null;
			if (isset($data['benefitFilter']) && !empty($data['benefitFilter'])) {

				$products->whereIn('products.product_benefit_en', $data['benefitFilter']);
				$selected_benefit = $data['benefitFilter'];
			}

			$selected_type = null;
			if (isset($data['typeFilter']) && !empty($data['typeFilter'])) {

				$products->whereIn('products.product_type_en', $data['typeFilter']);
				$selected_type = $data['typeFilter'];
			}

			$selected_destination = null;
			if (isset($data['destinationFilter']) && !empty($data['destinationFilter'])) {

				$products->whereIn('products.destinated_to_en', $data['destinationFilter']);
				$selected_destination = $data['destinationFilter'];
			}

			$selected_use = null;
			if (isset($data['useFilter']) && !empty($data['useFilter'])) {

				$products->whereIn('products.mode_of_use_en', $data['useFilter']);
				$selected_use = $data['useFilter'];
			}

			$selected_size = null;
			if (isset($data['sizeFilter']) && !empty($data['sizeFilter'])) {
				$products->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
					->select('products.*', 'product_attributes.product_id', 'product_attributes.size')

					->whereIn('product_attributes.size', $data['sizeFilter']);
				$selected_size = $data['sizeFilter'];
			}


			$selected_max_price = null;
			if (isset($data['product_max_price'])) {
				$products->where('selling_price', '<=', $data['product_max_price']);
				$selected_max_price = $data['product_max_price'];
			}

			$selected_min_price = null;
			if (isset($data['product_min_price'])) {
				$products->where('selling_price', '>=', $data['product_min_price']);
				$selected_min_price = $data['product_min_price'];
			}


			if (isset($data['sort']) && !empty($data['sort'])) {
				if ($data['sort'] == "product_latest") {
					$products->orderBy('id', 'Desc');
				} else if ($data['sort'] == "product_name_a_z") {
					$products->orderBy('product_name_en', 'Asc');
				} else if ($data['sort'] == "product_name_z_a") {
					$products->orderBy('product_name_en', 'Desc');
				} else if ($data['sort'] == "price_lowest") {

					$products->orderBy('discount_price', 'Asc');
				} else if ($data['sort'] == "price_highest") {
					$products->orderBy('discount_price', 'Desc');
				}
			} else {
				$products->orderBy('products.id', 'Desc');
			}
			$products = $products->paginate(3);
			return view('frontend.product.sub_subcategory_view', compact('products', 'slug', 'breadsubsubcat', 'selected_brand', 'selected_destination', 'selected_use', 'selected_benefit', 'selected_size', 'selected_min_price', 'selected_max_price', 'selected_subcategory', 'selected_subsubcategory', 'selected_category', 'selected_type'));
		}





		// } else {
		// 	$url = Route::getFacadeRoot()->current()->uri();
		// 	$subsubcategoryCount = Subsubcategory::where(['subsubcategory_slug_en' => $slug, 'subsubcategory_status' => 1])->count();
		// 	if ($subsubcategoryCount > 0) {
		// 		$products = Product::with(['subsubcategory'])->where('status', 1)->where('subsubcategory_id', $breadsubsubcat->id);
		// 		$products = $products->paginate(2);

		// 		return view('frontend.product.sub_subcategory_view')->with(compact('products', 'slug', 'breadsubsubcat', 'categories'));
		// 	} else {
		// 		abort(404);
		// 	}
		// }
	}



	/// Product View With Ajax
	public function ProductViewAjax($id)
	{
		$product = Product::with('category', 'brand', 'attributes')->where('status', 1)->findOrFail($id);
		// $sizes = ProductAttributes::where('product_id', $id)->pluck('size')->toArray();
		$total_stock = $product->product_qty;
		// $color = $product->product_color_en;
		// $product_color = explode(',', $color);

		$size = $product->product_size_en;
		

		return response()->json(array(
			'product' => $product,
			// 'color' => $product_color,
			'size' => $size,
			// 'sizes' => $sizes,
			'total_stock' => $total_stock,

		));
	} // end method 

	public function ProductSearch(Request $request)
	{

		$request->validate(["search" => "required"]);
		$data = $request->all();
		$item = $request->search;
		// echo "$item";
        $categories = Category::orderBy('category_name_en','ASC')->get();
		$products = Product::where('product_name_en','LIKE',"%$item%");

		if (isset($data['sort']) && !empty($data['sort'])) {
			if ($data['sort'] == "product_latest") {
				$products->orderBy('id', 'Desc');
			} else if ($data['sort'] == "product_name_a_z") {
				$products->orderBy('product_name_en', 'Asc');
			} else if ($data['sort'] == "product_name_z_a") {
				$products->orderBy('product_name_en', 'Desc');
			} else if ($data['sort'] == "price_lowest") {

				$products->orderBy('discount_price', 'Asc');
			} else if ($data['sort'] == "price_highest") {
				$products->orderBy('discount_price', 'Desc');
			}
		} else {
			$products->orderBy('id', 'Desc');
		}
		$products=$products->get();
	
		return view('frontend.product.search_product',compact('products','categories'));
	} // end method 

	public function ProductSearchVoice(Request $request)
	{
		$data = $request->all();
		$q = $request->q;
		$item=addslashes($q);
		// echo "$item";
        $categories = Category::orderBy('category_name_en','ASC')->get();
		$products = Product::where('product_name_en','LIKE',"%$item%");

		if (isset($data['sort']) && !empty($data['sort'])) {
			if ($data['sort'] == "product_latest") {
				$products->orderBy('id', 'Desc');
			} else if ($data['sort'] == "product_name_a_z") {
				$products->orderBy('product_name_en', 'Asc');
			} else if ($data['sort'] == "product_name_z_a") {
				$products->orderBy('product_name_en', 'Desc');
			} else if ($data['sort'] == "price_lowest") {

				$products->orderBy('discount_price', 'Asc');
			} else if ($data['sort'] == "price_highest") {
				$products->orderBy('discount_price', 'Desc');
			}
		} else {
			$products->orderBy('id', 'Desc');
		}
		$products=$products->get();
	
		return view('frontend.product.search_product',compact('products','categories'));
	} // end method 

	public function ProductSearchFilter(Request $request)
	{

		dd($request->all());
		// $catUrl = "";
		// if (!empty($data['category'])) {
		//    foreach ($data['category'] as $category) {
		// 	  if (empty($catUrl)) {
		// 		 $catUrl .= '&category='.$category;
		// 	  }else{
		// 		$catUrl .= ','.$category;
		// 	  }
		//    } // end foreach condition
		// }

		// return redirect()->route('search.filter',$catUrl);
	} // end method 


	///// Advance Search Options 

	public function AdvancedSearchProduct(Request $request)
	{

		$request->validate(["search" => "required"]);

		$item = $request->search;
		if (session()->get('language') == 'romanian') {
			$products = Product::where('product_name_ro', 'LIKE', "%$item%")->select('product_name_ro', 'product_thumbnail', 'selling_price', 'id', 'product_slug_ro')->limit(5)->get();
		} else {
			$products = Product::where('product_name_en', 'LIKE', "%$item%")->select('product_name_en', 'product_thumbnail', 'selling_price', 'id', 'product_slug_en')->limit(5)->get();
		}
		return view('frontend.product.advanced_search_product', compact('products'));
	} // end method 

	public function Faq(){
		return view('frontend.common.faq_view');
	}
	public function TermsAndConditions(){
		return view('frontend.common.terms_and_conditions_view');
	}

	public function ContactUs(){
		return view('frontend.common.contact_view');
	}

	public function AboutUs(){
		return view('frontend.common.about_view');
	}

	public function SendMessage(Request $request){
		$request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
			'body' => 'required',
        ]);



        Message::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Message sent successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
	}

	public function AddSubscriber(Request $request){
		
			$data=$request->all();
			$subscriberCount = NewsletterSubscriber::where('email',$data['subscriber_email'])->count();
			if($subscriberCount>0){
				$notification = array(
					'message' => 'Subscriber email already exists!',
					'alert-type' => 'error'
				);
		
				return redirect()->back()->with($notification);
				
			}
			else{
				NewsletterSubscriber::insert([
					
					'email' =>$data['subscriber_email'],
					'status' => 1,
					
					'created_at' => Carbon::now(),
		
				]);
				$notification = array(
					'message' => 'Thank you for subscribing!',
					'alert-type' => 'success'
				);
		
				return redirect()->back()->with($notification);
				
			}
		
	}

}
