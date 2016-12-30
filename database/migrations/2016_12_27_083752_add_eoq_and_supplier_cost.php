<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEoqAndSupplierCost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->integer('cost');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->integer('safty_stock');
            $table->integer('demand_quantity');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('cost');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('safty_stock');
            $table->dropColumn('demand_quantity');
        });
    }
}
