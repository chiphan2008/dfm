<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('rfid',50);
            $table->float('lat',10,6);
            $table->float('lng',10,6);
            $table->float('battery',8,2);
            $table->string('autowakeup',50);
            $table->string('sensity_of_autowakeup',50);
            $table->text('description');
            $table->string('mac_address',50);
            $table->string('dev_eui',50);
            $table->string('app_eui',50);
            $table->string('dev_address',50);
            $table->string('app_skey',50);
            $table->string('nwk_skey',50);
            $table->text('data_send');
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
        Schema::dropIfExists('devices');
    }
}
