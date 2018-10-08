<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_status_id')->unsigned();
            $table->integer('product_type_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->string('name',191);
            $table->text('description');
            $table->decimal('rent_price',8,2);
            $table->timestamp('manufacture_date');
            $table->string('city_code',191);
            $table->string('city_name',191);
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
        Schema::dropIfExists('products');
    }
}
