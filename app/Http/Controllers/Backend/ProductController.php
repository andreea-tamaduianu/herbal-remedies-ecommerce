<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\ProductAttributes;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function ProductAdd()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    }


    public function ProductStore(Request $request)
    {

        // $request->validate([
        //     'file' => 'required|mimes:jpeg,png,jpg,zip,pdf|max:2048',
        // ]);

        // if ($files = $request->file('file')) {
        //   $destinationPath = 'upload/pdf'; // upload path
        //   $digitalItem = date('YmdHis') . "." . $files->getClientOriginalExtension();
        //   $files->move($destinationPath,$digitalItem);
        // }



        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        $video = $request->file('product_video');
        $video_name = $video->getClientOriginalName();
        $extension = $video->getClientOriginalExtension();
        $videoName = $video_name . '-' . rand() . '.' . $extension;
        $video_path = 'upload/products/videos/';
        $video->move($video_path, $videoName);
        $save_url_video = $video_path . $videoName;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ro' => $request->product_name_ro,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ro' => strtolower(str_replace(' ', '-', $request->product_name_ro)),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_quantity,
            'product_weight' => $request->product_weight,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ro' => $request->product_tags_ro,

            'product_benefit_en' => $request->product_benefit_en,
            'product_benefit_ro' => $request->product_benefit_ro,
            'mode_of_use_en' => $request->product_mode_of_use_en,
            'mode_of_use_ro' => $request->product_mode_of_use_ro,
            'destinated_to_en' => $request->product_destinated_to_en,
            'destinated_to_ro' => $request->product_destinated_to_ro,
            'product_type_en' => $request->product_type_en,
            'product_type_ro' => $request->product_type_ro,
            
            'product_size_en' => $request->product_size_en,
            'product_size_ro' => $request->product_size_ro,
            // 'product_color_en' => $request->product_color_en,
            // 'product_color_ro' => $request->product_color_ro,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description_en' => $request->short_description_en,
            'short_description_ro' => $request->short_description_ro,
            'long_description_en' => $request->long_description_en,
            'long_description_ro' => $request->long_description_ro,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'new_arrival' => $request->new_arrival,
            'special_deals' => $request->special_deals,

            'product_thumbnail' => $save_url,
            'product_video' => $save_url_video,
            'product_meta_title' => $request->product_meta_title,
            'product_meta_description' => $request->product_meta_description,
            'product_meta_keywords' => $request->product_meta_keywords,

            // 'digital_file' => $digitalItem,
            'status' => 1,
            'is_comparable' => 0,
            'created_at' => Carbon::now(),

        ]);


        ////////// Multiple Image Upload Start ///////////

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            MultiImage::insert([

                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        }

        ////////// End Multiple Image Upload ///////////


        $notification = array(
            'message' => 'Product inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    } // end method



    public function AllProducts()
    {

        $products = Product::latest()->get();
       
        return view('backend.product.product_view_all', compact('products'));
    }

    public function ProductView($id)
    {

        $multiImgs = MultiImage::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = Subcategory::latest()->get();
        $subsubcategory = Subsubcategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_view', compact('categories', 'brands', 'subcategory', 'subsubcategory', 'products', 'multiImgs'));
    }


    public function ProductEdit($id)
    {

        $multiImgs = MultiImage::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = Subcategory::latest()->get();
        $subsubcategory = Subsubcategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('categories', 'brands', 'subcategory', 'subsubcategory', 'products', 'multiImgs'));
    }




    public function ProductUpdate(Request $request)
    {

        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ro' => $request->product_name_ro,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ro' => strtolower(str_replace(' ', '-', $request->product_name_ro)),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_quantity,
            'product_weight' => $request->product_weight,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ro' => $request->product_tags_ro,

            'product_benefit_en' => $request->product_benefit_en,
            'product_benefit_ro' => $request->product_benefit_ro,
            'mode_of_use_en' => $request->product_mode_of_use_en,
            'mode_of_use_ro' => $request->product_mode_of_use_ro,
            'destinated_to_en' => $request->product_destinated_to_en,
            'destinated_to_ro' => $request->product_destinated_to_ro,
            'product_type_en' => $request->product_type_en,
            'product_type_ro' => $request->product_type_ro,
            
            'product_size_en' => $request->product_size_en,
            'product_size_ro' => $request->product_size_ro,
            // 'product_color_en' => $request->product_color_en,
            // 'product_color_ro' => $request->product_color_ro,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description_en' => $request->short_description_en,
            'short_description_ro' => $request->short_description_ro,
            'long_description_en' => $request->long_description_en,
            'long_description_ro' => $request->long_description_ro,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'new_arrival' => $request->new_arrival,
            'special_deals' => $request->special_deals,

            'product_meta_title' => $request->product_meta_title,
            'product_meta_description' => $request->product_meta_description,
            'product_meta_keywords' => $request->product_meta_keywords,

            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product updated without image successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    } // end method 

    public function ProductManageStock($id)
    {

        $productdata = Product::select('id','product_name_en','product_code','product_color_en','selling_price','product_thumbnail')->with('attributes')->find($id);
        return view('backend.product.product_manage_stock', compact('productdata'));
    }

    public function ProductAddStock(Request $request, $id)
    {

        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        foreach ($data['sku'] as $key => $value) {
            if (!empty($value)) {

                // SKU already exists check
                $attrCountSKU = ProductAttributes::where('sku', $value)->count();
                if ($attrCountSKU > 0) {
                    $notification = array(
                        'message' => 'SKU already exists. Please add another SKU!',
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }

                // Size already exists check
                $attrCountSize = ProductAttributes::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                if ($attrCountSize > 0) {
                    $notification = array(
                        'message' => 'Size already exists. Please add another Size!',
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }

                $attribute = new ProductAttributes;
                $attribute->product_id = $id;
                $attribute->sku = $value;
                $attribute->size = $data['size'][$key];
                $attribute->price = $data['price'][$key];
                $attribute->stock = $data['stock'][$key];
                $attribute->status = 1;
                $attribute->save();
            }
        }

      

        $notification = array(
            'message' => 'Product stock has been added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 


    public function ProductUpdateStock(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            foreach ($data['attrId'] as $key => $attr) {
                if(!empty($attr)){
                    ProductAttributes::where(['id'=>$data['attrId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
            }

            $notification = array(
                'message' => 'Product stock has been updated successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }

    public function ProductUpdateStockStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductAttributes::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
        }
    }

  

    public function ProductDeleteStock($id){
        // Delete Attribute
        ProductAttributes::where('id',$id)->delete();
       
        $notification = array(
            'message' => 'Product stock has been deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /// Multiple Image Update
    public function ProductMultiImageUpdate(Request $request)
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);
        } // end foreach



        $notification = array(
            'message' => 'Product image updated successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end mehtod 


    /// Product Main thumbnail Update /// 
    public function ProductThumbnailImageUpdate(Request $request)
    {
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        unlink($oldImage);

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        Product::findOrFail($pro_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product image thumbnail updated successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method


    public function ProductVideoUpdate(Request $request)
    {
        $pro_id = $request->id;
        $oldVideo = $request->old_video;
        unlink($oldVideo);


        $video = $request->file('product_video');
        $video_name = $video->getClientOriginalName();
        $extension = $video->getClientOriginalExtension();
        $videoName = $video_name . '-' . rand() . '.' . $extension;
        $video_path = 'upload/products/videos/';
        $video->move($video_path, $videoName);
        $save_url_video = $video_path . $videoName;


        Product::findOrFail($pro_id)->update([
            'product_video' => $save_url_video,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product video updated successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method


    //// Multi Image Delete ////
    public function ProductMultiImageDelete($id)
    {
        $oldimg = MultiImage::findOrFail($id);
        unlink($oldimg->photo_name);
        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product image deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 



    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product inactivated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product activated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        unlink($product->product_video);
        Product::findOrFail($id)->delete();

        $images = MultiImage::where('product_id', $id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImage::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 



    // product Stock 
    public function ProductStock()
    {

        $products = Product::latest()->get();
        return view('backend.product.product_stock', compact('products'));
    }
}
