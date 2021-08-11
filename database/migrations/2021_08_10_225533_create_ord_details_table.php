<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ord_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order')->constrained('orders');
            $table->foreignId('product_code')->constrained('products');
            $table->integer('units');
            $table->integer('unit_price');
            $table->integer('total');
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
        Schema::dropIfExists('ord_details');
    }
}
