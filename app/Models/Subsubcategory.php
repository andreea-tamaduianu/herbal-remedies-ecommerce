<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsubcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'subsubcategory_name_en',
        'subsubcategory_name_ro',
        'subsubcategory_slug_en',
        'subsubcategory_slug_ro',
        'subsubcategory_status',
        'subsubcategory_discount'
       
    ];

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subcategory(){
    	return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }
}
