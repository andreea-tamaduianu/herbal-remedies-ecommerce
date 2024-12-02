<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }


    public function brand(){
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function subcategory(){
    	return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }

    public function subsubcategory(){
    	return $this->belongsTo(Subsubcategory::class,'subsubcategory_id','id');
    }

    public function attributes(){
    	return $this->hasMany(ProductAttributes::class);
    }
}
