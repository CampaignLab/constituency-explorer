<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('towns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('county');
            $table->string('country');
            $table->string('grid_reference');
            $table->integer('easting');
            $table->integer('northing');
            $table->float('latitude');
            $table->float('longitude');
            $table->integer('elevation');
            $table->string('postcode_sector');
            $table->string('local_government_area');
            $table->string('region');
            $table->string('type');
            $table->timestamps();
        });
    }
};
