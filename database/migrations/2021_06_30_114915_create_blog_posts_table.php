<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('post_title_en');
            $table->string('post_title_ro');
            $table->string('post_slug_en');
            $table->string('post_slug_ro');
            $table->string('post_image');
            $table->text('post_details_en');
            $table->text('post_details_ro'); 
            $table->unSignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')->on('admins')
                    ->onDelete('cascade'); 
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
        Schema::dropIfExists('blog_posts');
    }
}
