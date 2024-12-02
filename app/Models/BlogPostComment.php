<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blogpost(){
    	return $this->belongsTo(BlogPost::class,'blog_post_id','id');
    }

 
   
}
