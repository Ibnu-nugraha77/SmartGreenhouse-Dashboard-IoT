<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantDataTable extends Migration
{
    public function up()
    {
        Schema::create('plant_data', function (Blueprint $table) {
            $table->id();
            $table->integer('soil_moisture');
            $table->boolean('pump_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plant_data');
    }
};

