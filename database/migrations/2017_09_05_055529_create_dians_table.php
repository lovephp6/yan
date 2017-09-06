<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dians', function(Blueprint $table){
            $table->increments('id');
            $table->string('dian_title');
            $table->string('dian_address');
            $table->string('dian_code');
            $table->string('dian_tel');
            $table->string('dian_pic');
            $table->integer('sort');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dians');
    }
}
