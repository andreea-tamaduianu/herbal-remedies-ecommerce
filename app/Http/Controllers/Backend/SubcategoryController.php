<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\SubSubCategory;

class SubcategoryController extends Controller
{
    public function AllSubcategories(){

    	$categories = Category::orderBy('category_name_en','ASC')->get();
    	$subcategory = Subcategory::latest()->get();
    	return view('backend.category.subcategory_view',compact('subcategory','categories'));

    }


     public function SubcategoryStore(Request $request){

       $request->validate([
    		'category_id' => 'required',
    		'subcategory_name_en' => 'required',
    		'subcategory_name_ro' => 'required',
    	],[
    		'category_id.required' => 'Please select any option',
    		'subcategory_name_en.required' => 'Input subcategory English name',
    	]);

    	 

	   Subcategory::insert([
		'category_id' => $request->category_id,
		'subcategory_name_en' => $request->subcategory_name_en,
		'subcategory_name_ro' => $request->subcategory_name_ro,
		'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
		'subcategory_slug_ro' => strtolower(str_replace(' ', '-',$request->subcategory_name_ro)),
		 'subcategory_status'=>1,
		 'subcategory_discount'=>$request->subcategory_discount,

    	]);

	    $notification = array(
			'message' => 'Subcategory inserted successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 



     public function SubcategoryEdit($id){
    	$categories = Category::orderBy('category_name_en','ASC')->get();
    	$subcategory = Subcategory::findOrFail($id);
    	return view('backend.category.subcategory_edit',compact('subcategory','categories'));

    }


    public function SubcategoryUpdate(Request $request){

    	$subcat_id = $request->id;

    	 Subcategory::findOrFail($subcat_id)->update([
		'category_id' => $request->category_id,
		'subcategory_name_en' => $request->subcategory_name_en,
		'subcategory_name_ro' => $request->subcategory_name_ro,
		'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
		'subcategory_slug_ro' => strtolower(str_replace(' ', '-',$request->subcategory_name_ro)),
		'subcategory_discount'=>$request->subcategory_discount,

    	]);

	    $notification = array(
			'message' => 'Subcategory updated successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.subcategories')->with($notification);

    }  // end method



    public function SubcategoryDelete($id){

    	Subcategory::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'Subcategory deleted successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    }

	public function SubcategoryInactive($id)
    {
        Subcategory::findOrFail($id)->update(['subcategory_status' => 0]);
        $notification = array(
            'message' => 'Subcategory inactivated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function SubcategoryActive($id)
    {
        Subcategory::findOrFail($id)->update(['subcategory_status' => 1]);
        $notification = array(
            'message' => 'Subcategory activated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


  ///////////////  SUB->SUBCATEGORY ////////////////

 public function AllSubsubcategories(){

 	$categories = Category::orderBy('category_name_en','ASC')->get();
    	$subsubcategory = Subsubcategory::latest()->get();
    	return view('backend.category.sub_subcategory_view',compact('subsubcategory','categories'));

     }

 
     public function GetSubcategory($category_id){

     	$subcat = Subcategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
     	return json_encode($subcat);
     }


       public function GetSubsubCategory($subcategory_id){

        $subsubcat = Subsubcategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
     }



public function SubsubcategoryStore(Request $request){

       $request->validate([
    		'category_id' => 'required',
    		'subcategory_id' => 'required',
    		'subsubcategory_name_en' => 'required',
    		'subsubcategory_name_ro' => 'required',
    	],[
    		'category_id.required' => 'Please select any option',
    		'subsubcategory_name_en.required' => 'Input sub-subcategory English name',
			'subsubcategory_name_ro.required' => 'Input sub-subcategory Romanian name',
    	]);

    	 

	   Subsubcategory::insert([
		'category_id' => $request->category_id,
		'subcategory_id' => $request->subcategory_id,
		'subsubcategory_name_en' => $request->subsubcategory_name_en,
		'subsubcategory_name_ro' => $request->subsubcategory_name_ro,
		'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
		'subsubcategory_slug_ro' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_ro)),
		'subsubcategory_status'=>1,
		'subsubcategory_discount'=>$request->subsubcategory_discount,

    	]);

	    $notification = array(
			'message' => 'Sub-subcategory inserted successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 



    public function SubsubcategoryEdit($id){
    	$categories = Category::orderBy('category_name_en','ASC')->get();
    	$subcategories = Subcategory::orderBy('subcategory_name_en','ASC')->get();
    	$subsubcategories = Subsubcategory::findOrFail($id);
    	return view('backend.category.sub_subcategory_edit',compact('categories','subcategories','subsubcategories'));

    }



    public function SubsubcategoryUpdate(Request $request){

    	$subsubcat_id = $request->id;

    	Subsubcategory::findOrFail($subsubcat_id)->update([
		'category_id' => $request->category_id,
		'subcategory_id' => $request->subcategory_id,
		'subsubcategory_name_en' => $request->subsubcategory_name_en,
		'subsubcategory_name_ro' => $request->subsubcategory_name_ro,
		'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
		'subsubcategory_slug_ro' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_ro)),
		'subsubcategory_status'=>1,
		'subsubcategory_discount'=>$request->subsubcategory_discount,

    	]);

	    $notification = array(
			'message' => 'Sub-subcategory updated successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.subsubcategories')->with($notification);

    } // end method 


    public function SubsubcategoryDelete($id){

    	Subsubcategory::findOrFail($id)->delete();
    	 $notification = array(
			'message' => 'Sub-subcategory deleted successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    }

	public function SubsubcategoryInactive($id)
    {
        Subsubcategory::findOrFail($id)->update(['subsubcategory_status' => 0]);
        $notification = array(
            'message' => 'Sub-subcategory inactivated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function SubsubcategoryActive($id)
    {
        Subsubcategory::findOrFail($id)->update(['subsubcategory_status' => 1]);
        $notification = array(
            'message' => 'Sub-subcategory activated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


}