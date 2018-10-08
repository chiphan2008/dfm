<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('name',50);
            $table->string('address',255);
            $table->integer('area')->unsigned();
            $table->integer('area_ml')->unsigned();
            $table->float('lat',10,6);
            $table->float('lng',10,6);
            $table->integer('max_radius')->unsigned();
            $table->string('src',50)->nullable();
            $table->string('city_code',50)->nullable();
            $table->string('city_name',191)->nullable();
            $table->timestamp('deleted_at');
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
        Schema::dropIfExists('sites');
    }
}
