<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_name_en',
        'subcategory_name_ro',
        'subcategory_slug_en',
        'subcategory_slug_ro',
        'subcategory_status',
        'subcategory_discount'
       
    ];

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }
}
