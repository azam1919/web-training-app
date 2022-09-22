<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebTrainingsAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_trainings_assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->unsignedBigInteger('web_tr_id')->index('web_tr_id');
            $table->foreign('web_tr_id')->references('id')->on('web_trainings')->onDelete('cascade');
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
        Schema::dropIfExists('web_trainings_assets');
    }
}
