<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('place_of_worships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('constituency_id')->constrained();
            $table->string('name');
            $table->string('religion');
            $table->string('denomination');
            $table->string('postcode');
            $table->float('latitude');
            $table->float('longitude');
            $table->timestamps();
        });
    }
};
