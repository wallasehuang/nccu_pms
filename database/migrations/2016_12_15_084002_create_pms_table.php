<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('password');
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->integer('supplier_id');
            $table->string('color');
            $table->integer('quantity');
            $table->integer('period');
            $table->string('img_url');
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('c_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('s_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('state');
            $table->timestamps();
        });

        Schema::create('c_markets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('red');
            $table->integer('green');
            $table->integer('blue');
            $table->integer('white');
            $table->integer('black');
            $table->integer('gray');
            $table->timestamps();
        });

        Schema::drop('orderDetails');
        Schema::drop('orders');
        Schema::drop('purchases');
        Schema::drop('students');

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
