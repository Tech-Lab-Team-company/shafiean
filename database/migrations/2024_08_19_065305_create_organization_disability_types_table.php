<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationDisabilityTypesTable extends Migration {

    public function up()
    {
        Schema::create('organization_disability_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('disability_type_id')->nullable();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');
            $table->foreign('disability_type_id')->references('id')->on('disability_types')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization_disability_types');
    }
}
