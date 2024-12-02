<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Auth;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Mail;
use App\Mail\ReviewMail;


class ReviewController extends Controller
{
    public function ReviewStore(Request $request){

    	$product = $request->product_id;

    	$request->validate([

    		'summary' => 'required',
    		'comment' => 'required',
    	]);

    	Review::insert([
    		'product_id' => $product,
    		'user_id' => Auth::id(),
    		'comment' => $request->comment,
    		'summary' => $request->summary,
           'rating' => $request->quality,
    		'created_at' => Carbon::now(),

    	]);

    	$notification = array(
			'message' => 'Thank your for your review. It will be verified by the admin.',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);


    } // end mehtod 



 public function PendingReview(){

    	$review = Review::where('status',0)->orderBy('id','DESC')->get();
    	return view('backend.review.pending_review',compact('review'));

    } // end method 



    public function ReviewApprove($id){

    	Review::where('id',$id)->update(['status' => 1]);

    	$notification = array(
            'message' => 'Review approved successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end mehtod 


    public function PublishReview(){
    $review = Review::where('status',1)->orderBy('id','DESC')->get();
    	return view('backend.review.published_review',compact('review'));
    }



    public function DeleteReview($id){

        $review = Review::findOrFail($id);
        $reviewEmail = Review::with('user','product')->where('user_id',$review->user_id)->where('product_id',$review->product_id)->first();
    	Review::findOrFail($id)->delete();

    	

		$data = [
			'product_name' => $reviewEmail->product->product_name_en,
			'review_summary' => $reviewEmail->summary,
			'review_comment' => $reviewEmail->comment,
			'review_rating'=>$reviewEmail->rating,
			
		];
		$notification = array(
            'message' => 'Review deleted successfully',
            'alert-type' => 'success'
        );

        Mail::to($reviewEmail->user->email)->send(new ReviewMail($data));
        return redirect()->back()->with($notification);

    } // end method 



}
 