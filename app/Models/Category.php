<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name_en',
        'category_name_ro',
        'category_slug_en',
        'category_slug_ro',
        'category_icon',
        'category_image',
        'category_status',
        'category_discount'

    ];

    public function orderItems(){
        return $this->hasManyThrough(OrderItem::class, Product::class);
    }
}
