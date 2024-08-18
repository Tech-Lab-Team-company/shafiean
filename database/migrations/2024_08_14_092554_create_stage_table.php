<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->integer('order')->nullable();
            $table->unsignedBigInteger('disability_type_id')->nullable();
            $table->foreign('disability_type_id')
                ->references('id')
                ->on('disability_types')
                ->onDelete('set null');
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
        Schema::dropIfExists('stage');
    }
}

