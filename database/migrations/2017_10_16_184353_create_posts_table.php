<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        Schema::create('posts', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('post_title');
            $table->text('post_body');
            $table->integer('category_id');
            $table->string('post_image');
            $table->integer('recommend')->default('0');
            $table->integer('likes')->default('0');
            $table->integer('dislikes')->default('0');
            $table->integer('like_dislike')->default('0');

            $table->integer('views')->default('0');
             
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
        Schema::dropIfExists('posts');
    }
}
