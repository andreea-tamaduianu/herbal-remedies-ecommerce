<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{

    public function SliderView()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));
    }


    public function SliderStore(Request $request)
    {

        $request->validate([

            'slider_image' => 'required',
        ], [
            'slider_image.required' => 'Please select an image',

        ]);

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(600,400)->save('upload/slider/' . $name_gen);
        $save_url = 'upload/slider/' . $name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_image' => $save_url,
            'link'=>$request->link,
        ]);

        $notification = array(
            'message' => 'Slider inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 




    public function SliderEdit($id)
    {
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('sliders'));
    }


    public function SliderUpdate(Request $request)
    {

        $slider_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('slider_image')) {

            unlink($old_img);
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600,400)->save('upload/slider/' . $name_gen);
            $save_url = 'upload/slider/' . $name_gen;

            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_image' => $save_url,
                'link'=>$request->link,

            ]);

            $notification = array(
                'message' => 'Slider updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('slider.manage')->with($notification);
        } else {

            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'link'=>$request->link,

            ]);

            $notification = array(
                'message' => 'Slider updated without image successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('slider.manage')->with($notification);
        } // end else 
    } // end method 


    public function SliderDelete($id)
    {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img);
        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider deleted successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method


    public function SliderInactive($id)
    {
        Slider::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Slider inactivated successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method 


    public function SliderActive($id)
    {
        Slider::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Slider activated successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method 






}
