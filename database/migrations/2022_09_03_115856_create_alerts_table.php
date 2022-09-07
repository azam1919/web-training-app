<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('a_id')->index('a_id')->nullable();
            $table->unsignedBigInteger('u_id')->index('u_id')->nullable();
            $table->unsignedBigInteger('r_id')->index('r_id');
            $table->string('status');
            $table->timestamps();
            $table->foreign('r_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('u_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('a_id')->references('id')->on('alerts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerts');
    }
}
