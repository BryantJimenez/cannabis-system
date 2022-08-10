<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantStageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_stage', function (Blueprint $table) {
            $table->bigInteger('plant_id')->unsigned()->nullable();
            $table->bigInteger('stage_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_stage');
    }
}
