<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('disability_type_id');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('country_id');
            $table->foreign('city_id')->references('id')->on('cities');
           // $table->foreignId('city_id')->constrained('cities');
            $table->foreign('disability_type_id')->references('id')->on('disability_types');
           // $table->foreignId('disability_type_id')->constrained('disability_types');
            $table->foreign('country_id')->references('id')->on('countries');
            //$table->foreignId('country_id')->constrained('countries');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['disability_type_id']);
            $table->dropForeign(['country_id']);
        });
    }
}

