<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doc_type')->constrained('doc_types');
            $table->string('doc_num',15);
            $table->string('names',100);
            $table->string('surnames',100);
            $table->string('phone',30);
            $table->string('address',200);
            $table->string('email',80);
            $table->foreignId('id_type_user')->constrained('type_users');            
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
        Schema::dropIfExists('app_users');
    }
}
