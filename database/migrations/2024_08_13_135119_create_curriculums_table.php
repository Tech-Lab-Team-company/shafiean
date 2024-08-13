<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumsTable extends Migration
{
    public function up()
    {
        Schema::create('curriculums', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title', 191);
            $table->integer('type');
            $table->string('time', 191);
            $table->date('from');
            $table->date('to');
            $table->string('order');
            $table->unsignedInteger('curriculum_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculums');
    }
}

