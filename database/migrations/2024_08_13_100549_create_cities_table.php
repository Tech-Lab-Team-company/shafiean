<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
}

