<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisabilityTypesTable extends Migration
{
    public function up()
    {
        Schema::create('disability_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('disability_types');
    }
}

