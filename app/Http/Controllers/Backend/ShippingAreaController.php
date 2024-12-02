<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingDivision;
use Carbon\Carbon;
use App\Models\ShippingDistrict;
use App\Models\ShippingState;

class ShippingAreaController extends Controller
{
    
	public function DivisionView(){
		$divisions = ShippingDivision::orderBy('id','DESC')->get();
		return view('backend.shipping.division.division_view',compact('divisions'));

	}


public function DivisionStore(Request $request){

    	$request->validate([
    		'division_name' => 'required',   	 
    	 
    	]);
    	 

	ShippingDivision::insert([
	 
		'division_name' => $request->division_name,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Country inserted successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 



    public function DivisionEdit($id){

  $divisions = ShippingDivision::findOrFail($id);
	 return view('backend.shipping.division.division_edit',compact('divisions'));
    }



    public function DivisionUpdate(Request $request,$id){

    	ShippingDivision::findOrFail($id)->update([
	 
		'division_name' => $request->division_name,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Country updated successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('division.manage')->with($notification);


    } // end mehtod 


    public function DivisionDelete($id){

    	ShippingDivision::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'Country deleted successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 



    //// Start Ship District 

    public function DistrictView(){
    $division = ShippingDivision::orderBy('division_name','ASC')->get();
    $district = ShippingDistrict::with('division')->orderBy('id','DESC')->get();
		return view('backend.shipping.district.district_view',compact('division','district'));
    }


public function DistrictStore(Request $request){

    	$request->validate([
    		'division_id' => 'required',  
    		'district_name' => 'required',  	 
    	 
    	]);
    	 

	ShippingDistrict::insert([
	 
		'division_id' => $request->division_id,
		'district_name' => $request->district_name,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'County inserted successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 



public function DistrictEdit($id){

  $division = ShippingDivision::orderBy('division_name','ASC')->get();
  $district = ShippingDistrict::findOrFail($id);
	 return view('backend.shipping.district.district_edit',compact('district','division'));
    }




 public function DistrictUpdate(Request $request,$id){

    	ShippingDistrict::findOrFail($id)->update([
	 
		'division_id' => $request->division_id,
		'district_name' => $request->district_name,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'County updated successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('district.manage')->with($notification);


    } // end mehtod 





      public function DistrictDelete($id){

    	ShippingDistrict::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'County deleted successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 
 

   //// End Ship District


 ////////////////// Ship State //////////

 

    public function StateView(){
    $division = ShippingDivision::orderBy('division_name','ASC')->get();
    $district = ShippingDistrict::orderBy('district_name','ASC')->get();
    $state = ShippingState::with('division','district')->orderBy('id','DESC')->get();
		return view('backend.shipping.state.state_view',compact('division','district','state'));
    }




    public function StateStore(Request $request){

    	$request->validate([
    		'division_id' => 'required',  
    		'district_id' => 'required', 
    		'state_name' => 'required', 	 
    	 
    	]);
    	 

	ShippingState::insert([
	 
		'division_id' => $request->division_id,
		'district_id' => $request->district_id,
		'state_name' => $request->state_name,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'City inserted successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 


public function StateEdit($id){
    $division = ShippingDivision::orderBy('division_name','ASC')->get();
    $district = ShippingDistrict::orderBy('district_name','ASC')->get();
    $state = ShippingState::findOrFail($id);
		return view('backend.shipping.state.state_edit',compact('division','district','state'));
    }




 public function StateUpdate(Request $request,$id){

    	ShippingState::findOrFail($id)->update([
	 
		'division_id' => $request->division_id,
		'district_id' => $request->district_id,
		'state_name' => $request->state_name,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'City updated successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('state.manage')->with($notification);


    } // end mehtod 


public function StateDelete($id){

    	ShippingState::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'City deleted successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 

	public function GetDistrict($division_id){

		$district = ShippingDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
		return json_encode($district);
	}
    //////////////// End Ship State ////////////

	public function GetState($district_id){

    	$ship = ShippingState::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
    	return json_encode($ship);

    } // end method 

}
