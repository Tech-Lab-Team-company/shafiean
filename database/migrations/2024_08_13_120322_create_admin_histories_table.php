<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('admin_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id')->nullable();
            $table->text('creatable_type')->nullable();
            $table->string('editable_type')->nullable();
            $table->unsignedInteger('model_id')->nullable();
            $table->string('type')->nullable();
            $table->string('order')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_histories');
    }
}

