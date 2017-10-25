<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrangs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->default('0');
            $table->integer('likes')->default('0');
            $table->integer('dislikes')->default('0');
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
        //
    }
}
