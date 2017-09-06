<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYuyuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yuyues', function( Blueprint $table){
           $table->increments('id');
           $table->tinyInteger('tid');
           $table->tinyInteger('sid');
           $table->string('city');
           $table->string('date');
           $table->string('time');
           $table->string('name');
           $table->string('address');
           $table->string('other');
           $table->integer('money');
           $table->tinyInteger('status');
           $table->string('tel')->unique();
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
        Schema::dropIfExists('yuyues');
    }
}
