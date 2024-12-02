<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Auth;
use Image;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function AdminProfile(){

		$id = Auth::user()->id;
		$adminData = Admin::find($id);
		return view('admin.admin_profile_view',compact('adminData'));
	}


    public function AdminProfileEdit(){

		$id = Auth::user()->id;
		$editData = Admin::find($id);
		return view('admin.admin_profile_edit',compact('editData'));

	}

    public function AdminProfileUpdate(Request $request){

		$id = Auth::user()->id;
		$data = Admin::find($id);
		$data->name = $request->name;
		$data->email = $request->email;
		$old_img = $request->old_image;

		if ($request->file('profile_photo_path')) {
			unlink($old_img);
			$image = $request->file('profile_photo_path');
			$name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
			Image::make($image)->resize(225, 225)->save('upload/admin_images/' . $name_gen);
			$save_url = 'upload/admin_images/' . $name_gen;
			$data['profile_photo_path'] = $save_url;
		}
		$data->save();

		$notification = array(
			'message' => 'Admin profile updated successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('admin.profile')->with($notification);

	}

    public function AdminEditPassword(){

		return view('admin.admin_change_password');

	}


	public function AdminChangePassword(Request $request){

		$request->validate([
			'oldpassword' => 'required',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required|same:password',     
		],[
    		'password_confirmation.same' => 'The new password must be the same as the confirmation password!',
    		
    	]);

		$hashedPassword = Admin::user()->password;
		

		if (Hash::check($request->oldpassword , $hashedPassword )) {
 
			if (!Hash::check($request->password , $hashedPassword)) {
	
				$admin = Admin::find(Auth::id());
				$admin->password = Hash::make($request->password);
				$admin->save();
				
	
				$notification = array(
					'message' => 'Password was changed successfully',
					'alert-type' => 'success'
				);
				return redirect()->back()->with($notification);
			   }
	
			   else{
				$notification = array(
					'message' => 'Your new password cannot be the old password!',
					'alert-type' => 'error'
				);
				return redirect()->back()->with($notification);
					 
				}
	
			  }
	
			 else{
				$notification = array(
					'message' => 'Your old password does not match!',
					'alert-type' => 'error'
				);
				return redirect()->back()->with($notification);
				 
				}
	
		  }

		  public function AllUsers(){
			$users = User::latest()->get();
			return view('backend.user.all_users',compact('users'));
		}
	


}


