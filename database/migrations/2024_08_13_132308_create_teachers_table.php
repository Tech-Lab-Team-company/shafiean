<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration {

    public function up()
    {
        Schema::create('teachers', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('gender')->nullable();
            $table->string('api_key')->nullable();
            $table->string('age')->nullable();
            $table->string('image')->nullable();
            $table->integer('organazation_id')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}

