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
            $table->unsignedBigInteger('surah_id')->nullable();
            $table->text('text')->nullable();
            $table->integer('number')->nullable();
            $table->integer('juz')->nullable();
            $table->integer('page')->nullable();
            $table->integer('number_in_surah')->nullable();
            $table->string('audio')->nullable();
            $table->foreign('surah_id')->references('id')->on('surahs')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ayat');
    }
}
