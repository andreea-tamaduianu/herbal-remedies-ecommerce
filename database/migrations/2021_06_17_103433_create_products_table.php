<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id');
            $table->string('product_name_en');
            $table->string('product_name_ro');
            $table->string('product_slug_en');
            $table->string('product_slug_ro');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_weight');
            $table->string('product_tags_en');
            $table->string('product_tags_ro');
            $table->string('product_size_en')->nullable();
            $table->string('product_size_ro')->nullable();
            $table->string('product_color_en');
            $table->string('product_color_ro');
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('short_description_en');
            $table->string('short_description_ro');
            $table->string('long_description_en');
            $table->string('long_description_ro');
            $table->string('product_thumbnail');
            $table->string('product_video');
            $table->string('product_meta_title');
            $table->string('product_meta_description');
            $table->string('product_meta_keywords');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('new_arrival')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
