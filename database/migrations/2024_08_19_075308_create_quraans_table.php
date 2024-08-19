<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuraansTable extends Migration
{
    public function up()
    {
        Schema::create('quraan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->string('order')->nullable();
            $table->string('type')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quraan');
    }
}

