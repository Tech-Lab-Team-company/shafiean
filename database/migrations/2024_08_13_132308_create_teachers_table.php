<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration {

    public function up()
    {
        Schema::create('teachers', function(Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('gender')->nullable();
            $table->string('api_key')->nullable();
            $table->string('age')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}

