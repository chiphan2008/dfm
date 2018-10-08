<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->string('name',50);
            $table->float('area',8,2);
            $table->float('ent_area',8,2);
            $table->float('area_ml',8,2);
            $table->float('rent_area_ml',8,2);
            $table->float('lat',8,6);
            $table->float('lng',8,6);
            $table->integer('max_radius')->unsigned();
            $table->string('city_code',50)->nullable();
            $table->string('city_name',50)->nullable();
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
        Schema::dropIfExists('storages');
    }
}
