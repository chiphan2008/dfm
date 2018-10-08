<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->string('phone_number',50);
            $table->string('username',50);
            $table->string('password',255);
            $table->string('email',100);
            $table->text('token');
            $table->timestamp('login_date');
            $table->timestamp('logout_date');
            $table->timestamp('deleted_at');
            $table->string('full_name',191);
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
        Schema::dropIfExists('users');
    }
}
