<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('green_spaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('constituency_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('postcode')->nullable();
            $table->float('latitude');
            $table->float('longitude');
            $table->string('opening_hours')->nullable();
            $table->timestamps();
        });
    }
};
