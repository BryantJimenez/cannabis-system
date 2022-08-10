<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [1, 2])->default(1);
            $table->integer('plants_count')->default(1);
            $table->float('flower', 10, 2)->default(0.00)->unsigned();
            $table->float('larf', 10, 2)->default(0.00)->unsigned()->nullable();
            $table->float('trim', 10, 2)->default(0.00)->unsigned()->nullable();
            $table->float('waste', 10, 2)->default(0.00)->unsigned();
            $table->text('note')->nullable();
            $table->enum('state', [0, 1])->default(0);
            $table->bigInteger('strain_id')->unsigned()->nullable();
            $table->bigInteger('room_id')->unsigned()->nullable();
            $table->bigInteger('harvest_id')->unsigned()->nullable();
            $table->bigInteger('container_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            #Relations
            $table->foreign('strain_id')->references('id')->on('strains')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('harvest_id')->references('id')->on('harvests')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('container_id')->references('id')->on('containers')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stages');
    }
}
