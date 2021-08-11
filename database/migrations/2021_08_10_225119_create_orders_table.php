<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->foreignId('id_client')->constrained('app_users');
            $table->string('deliv_adrress',100);
            $table->date('delivery_date');
            $table->foreignId('id_calendar')->constrained('calendars');
            $table->string('receive_name',200);
            $table->integer('total');
            $table->char('paid',2);
            $table->integer('state');
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
        Schema::dropIfExists('orders');
    }
}
