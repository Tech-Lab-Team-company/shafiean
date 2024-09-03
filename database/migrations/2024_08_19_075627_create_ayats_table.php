<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyatsTable extends Migration
{
    public function up()
    {
        Schema::create('ayat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quraan_id')->nullable();
            $table->unsignedInteger('number')->nullable();
            $table->timestamps();

            $table->foreign('quraan_id')->references('id')->on('quraan')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ayat');
    }
}

