<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPostCategory;
use Carbon\Carbon;
use App\Models\BlogPost;
use Image;
use Auth;
use App\Models\Admin;

class BlogController extends Controller
{
    public function BlogCategory()
    {

        $blogcategory = BlogPostCategory::latest()->get();
        return view('backend.blog.category.blog_category_view', compact('blogcategory'));
    }


    public function BlogCategoryStore(Request $request)
    {

        $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_ro' => 'required',

        ], [
            'blog_category_name_en.required' => 'Input blog category English name',
            'blog_category_name_ro.required' => 'Input blog category Romanian name',
        ]);

       


        BlogPostCategory::insert([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_ro' => $request->blog_category_name_ro,
            'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
            'blog_category_slug_ro' => strtolower(str_replace(' ', '-', $request->blog_category_name_ro)),
            'created_at' => Carbon::now(),


        ]);

        $notification = array(
            'message' => 'Blog category inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 



    public function BlogCategoryEdit($id)
    {

        $blogcategory = BlogPostCategory::findOrFail($id);
        return view('backend.blog.category.blog_category_edit', compact('blogcategory'));
    }




    public function BlogCategoryUpdate(Request $request)
    {

        $blogcar_id = $request->id;


        BlogPostCategory::findOrFail($blogcar_id)->update([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_ro' => $request->blog_category_name_ro,
            'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
            'blog_category_slug_ro' => strtolower(str_replace(' ', '-', $request->blog_category_name_ro)),
            'created_at' => Carbon::now(),


        ]);

        $notification = array(
            'message' => 'Blog category updated successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('blogcategory.all')->with($notification);
    } // end method 

    public function BlogCategoryDelete($id)
    {

        BlogPostCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog category deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    ///////////////////////////// Blog Post ALL Methods //////////////////

    public function ListBlogPost()
    {
        $blogpost = BlogPost::with('category')->latest()->get();
        return view('backend.blog.post.blog_post_list', compact('blogpost'));
    }


    public function AddBlogPost()
    {

        $blogcategory = BlogPostCategory::latest()->get();
        $blogpost = BlogPost::latest()->get();
        return view('backend.blog.post.blog_post_view', compact('blogpost', 'blogcategory'));
    }


    public function BlogPostStore(Request $request)
    {

        $request->validate([
            'post_title_en' => 'required',
            'post_title_ro' => 'required',
            'post_image' => 'required',
        ], [
            'post_title_en.required' => 'Input post title English name',
            'post_title_ro.required' => 'Input post title Romanian name',
        ]);

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(780, 433)->save('upload/post/' . $name_gen);
        $save_url = 'upload/post/' . $name_gen;

       


        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title_en' => $request->post_title_en,
            'post_title_ro' => $request->post_title_ro,
            'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_title_en)),
            'post_slug_ro' => strtolower(str_replace(' ', '-', $request->post_title_ro)),
            'post_image' => $save_url,
            'post_details_en' => $request->post_details_en,
            'post_details_ro' => $request->post_details_ro,
            'user_id'=>$request->user_id,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Blog post inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('post.list')->with($notification);
    } // end mehtod 


    public function BlogPostEdit($id)
    {
        $blogcategory = BlogPostCategory::orderBy('blog_category_name_en', 'ASC')->get();
        $blogpost = BlogPost::findOrFail($id);
        return view('backend.blog.post.blog_post_edit', compact('blogpost', 'blogcategory'));
    }


    public function BlogPostUpdate(Request $request)
    {

        $blogpost_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('post_image')) {

            unlink($old_img);
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/post/' . $name_gen);
            $save_url = 'upload/post/' . $name_gen;

            BlogPost::findOrFail($blogpost_id)->update([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_title_ro' => $request->post_title_ro,
                'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_name_en)),
                'post_slug_ro' => strtolower(str_replace(' ', '-', $request->post_name_ro)),
                'post_image' => $save_url,
                'post_details_en' => $request->post_details_en,
                'post_details_ro' => $request->post_details_ro,

            ]);

            $notification = array(
                'message' => 'Blog post updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('post.list')->with($notification);
        } else {

            BlogPost::findOrFail($blogpost_id)->update([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_title_ro' => $request->post_title_ro,
                'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_name_en)),
                'post_slug_ro' => strtolower(str_replace(' ', '-', $request->post_name_ro)),
                'post_details_en' => $request->post_details_en,
                'post_details_ro' => $request->post_details_ro,

            ]);

            $notification = array(
                'message' => 'Blog post updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('post.list')->with($notification);
        } // end else 
    } // end method 



    public function BlogPostDelete($id)
    {

        $blogpost = BlogPost::findOrFail($id);
        $img = $blogpost->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog post deleted successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method 



}
