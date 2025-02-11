<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function AllBrands()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request)
    {

        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_ro' => 'required',
            'brand_image' => 'required',
        ], [
            'brand_name_en.required' => 'Please input brand English name',
            'brand_name_ro.required' => 'Please input brand Romanian name',
        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(100, 75)->save('upload/brand/' . $name_gen);
        $save_url = 'upload/brand/' . $name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_ro' => $request->brand_name_ro,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_ro' => strtolower(str_replace(' ', '-', $request->brand_name_ro)),
            'brand_image' => $save_url,

        ]);

        $notification = array(
            'message' => 'Brand inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 


    public function BrandEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }


    public function BrandUpdate(Request $request)
    {

        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

            unlink($old_img);
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(100, 75)->save('upload/brand/' . $name_gen);
            $save_url = 'upload/brand/' . $name_gen;

            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ro' => $request->brand_name_ro,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ro' => strtolower(str_replace(' ', '-', $request->brand_name_ro)),
                'brand_image' => $save_url,

            ]);

            $notification = array(
                'message' => 'Brand updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('all.brands')->with($notification);
        } else {

            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ro' => $request->brand_name_ro,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ro' => strtolower(str_replace(' ', '-', $request->brand_name_ro)),


            ]);

            $notification = array(
                'message' => 'Brand updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('all.brands')->with($notification);
        } // end else 
    } // end method 



    public function BrandDelete($id)
    {

        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand deleted successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method 


}
