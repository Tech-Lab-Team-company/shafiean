<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToTeachersTable extends Migration {

    public function up()
    {
        Schema::table('teachers', function(Blueprint $table) {
            $table->foreign('organazation_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('teachers', function(Blueprint $table) {
            $table->dropForeign(['organazation_id']);
        });
    }
}

