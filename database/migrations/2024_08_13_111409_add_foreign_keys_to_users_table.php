<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('disability_type_id')->constrained('disability_types');
            $table->foreignId('country_id')->constrained('countries');
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

