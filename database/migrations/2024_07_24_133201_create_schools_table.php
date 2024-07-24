<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('constituency_id')->constrained();
            $table->string('name');
            $table->string('phase_of_education')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();
        });
    }
};
