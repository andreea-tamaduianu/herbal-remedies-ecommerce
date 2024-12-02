<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPostCategory;
use App\Models\BlogPost;
use App\Models\Admin;
use App\Models\BlogPostComment;
use Illuminate\Support\Carbon;

class HomeBlogController extends Controller
{
    public function AddBlogPost(){

    	$blogcategory = BlogPostCategory::latest()->get();
    	$blogpost = BlogPost::paginate(3);
    	return view('frontend.blog.blog_list',compact('blogpost','blogcategory'));

    } // end method 


    public function DetailsBlogPost($id){
		
        $blogcategory = BlogPostCategory::latest()->get();
    	$blogpost = BlogPost::findOrFail($id);
		$adminData = Admin::find($blogpost->user_id);
		$comments = BlogPostComment::where('blog_post_id',$blogpost->id)->latest()->get();

    	return view('frontend.blog.blog_details',compact('blogpost','blogcategory', 'adminData', 'comments'));
    }



    public function HomeBlogCatPost($category_id){

    	$blogcategory = BlogPostCategory::latest()->get();
    	$blogpost = BlogPost::where('category_id',$category_id)->orderBy('id','DESC')->paginate(3);
    	return view('frontend.blog.blog_category_list',compact('blogpost','blogcategory'));

    } // end mehtod 

	public function BlogSearch(Request $request){
		$request->validate(["searched" => "required"]);
		$data = $request->all();
		$item = $request->searched;
		
		$blogcategory = BlogPostCategory::latest()->get();
    
		$blogpost = BlogPost::where('post_title_en','LIKE',"%$item%")->get();

		
	
	
		return view('frontend.blog.blog_search',compact('blogpost','blogcategory'));
	}

	public function CreateCommentForBlogPost(Request $request){
		//echo "<pre>"; print_r($request->name); die;
		$request->validate([
            'name' => 'required',
            'email' => 'required',
           
			'comment' => 'required',
        ]);

		

        BlogPostComment::insert([
            'name' => $request->name,
            'email' => $request->email,
           
            'comment' => $request->comment,
			'blog_post_id'=>$request->blog_post_id,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Comment added successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
	}


}