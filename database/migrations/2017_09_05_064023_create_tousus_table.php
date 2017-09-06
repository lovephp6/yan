<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToususTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tousus', function( Blueprint $table ){
            $table->increments('id');
            $table->tinyInteger('tid');
            $table->tinyInteger('sid');
            $table->string('name');
            $table->string('tel');
            $table->string('desc');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('tousus');
    }
}
