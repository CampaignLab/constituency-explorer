<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('community_centres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('constituency_id');
            $table->string('name');
            $table->string('religion')->nullable();
            $table->string('denomination')->nullable();
            $table->string('postcode')->nullable();
            $table->timestamps();
        });
    }
};
