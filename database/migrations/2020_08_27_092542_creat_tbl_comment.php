<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatTblComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_comment', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->integer('product_id');
            $table->integer('customer_id');
            $table->integer('commnent_rate');
            $table->integer('comment_content')->nullable();
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
        Schema::dropIfExists('tbl_comment');
    }
}
