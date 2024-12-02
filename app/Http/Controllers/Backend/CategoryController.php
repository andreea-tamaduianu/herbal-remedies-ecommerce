<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;


class CategoryController extends Controller
{
	public function AllCategories()
	{

		$category = Category::latest()->get();
		return view('backend.category.category_view', compact('category'));
	}

	public function CategoryStore(Request $request)
	{

		$request->validate([
			'category_name_en' => 'required',
			'category_name_ro' => 'required',
			'category_icon' => 'required',
			'category_image' =>'required',
			
		], [
			'category_name_en.required' => 'Input category English name',
			'category_name_ro.required' => 'Input category Romanian name',
		]);

		$image = $request->file('category_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(600, 400)->save('upload/category/' . $name_gen);
        $save_url = 'upload/category/' . $name_gen;

		Category::insert([
			'category_name_en' => $request->category_name_en,
			'category_name_ro' => $request->category_name_ro,
			'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
			'category_slug_ro' => strtolower(str_replace(' ', '-', $request->category_name_ro)),
			'category_icon' => $request->category_icon,
			'category_image' => $save_url,
			'category_discount'=>$request->category_discount,
			'category_status' => 1,
		]);

		$notification = array(
			'message' => 'Category inserted successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
	} // end method 


	public function CategoryEdit($id)
	{
		$category = Category::findOrFail($id);
		return view('backend.category.category_edit', compact('category'));
	}


	public function CategoryUpdate(Request $request)
	{

		$old_img = $request->old_image;
		$category_id = $request->id;
		if ($request->file('category_image')) {

            unlink($old_img);
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 400)->save('upload/category/' . $name_gen);
            $save_url = 'upload/category/' . $name_gen;
			Category::findOrFail($category_id)->update([
				'category_name_en' => $request->category_name_en,
				'category_name_ro' => $request->category_name_ro,
				'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
				'category_slug_ro' =>  strtolower(str_replace(' ', '-', $request->category_name_ro)),
				'category_icon' => $request->category_icon,
				'category_image' =>$save_url,
				'category_discount'=>$request->category_discount,
			]);
               
        }
		else{
			Category::findOrFail($category_id)->update([
				'category_name_en' => $request->category_name_en,
				'category_name_ro' => $request->category_name_ro,
				'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
				'category_slug_ro' =>  strtolower(str_replace(' ', '-', $request->category_name_ro)),
				'category_icon' => $request->category_icon,
				'category_discount'=>$request->category_discount,
	
			]);
		}
		

		$notification = array(
			'message' => 'Category updated successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('all.categories')->with($notification);
	} // end method


	public function CategoryDelete($id)
	{
		$category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img);

		Category::findOrFail($id)->delete();

		$notification = array(
			'message' => 'Category deleted successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
	} // end method 

	public function CategoryInactive($id)
    {
        Category::findOrFail($id)->update(['category_status' => 0]);
        $notification = array(
            'message' => 'Category inactivated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function CategoryActive($id)
    {
        Category::findOrFail($id)->update(['category_status' => 1]);
        $notification = array(
            'message' => 'Category activated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


}
