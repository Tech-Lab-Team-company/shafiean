<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 191)->nullable();
            $table->string('licence_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('email', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_phone')->nullable();
            $table->string('manager_email', 191)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}

