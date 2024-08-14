<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedBigInteger('disability_type_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('disability_type_id')->references('id')->on('disability_types')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Dropping foreign key constraints
            $table->dropForeign(['city_id']);
            $table->dropForeign(['disability_type_id']);
            $table->dropForeign(['country_id']);

            // Dropping the columns
            $table->dropColumn(['disability_type_id', 'city_id', 'country_id']);
        });
    }
}


