<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('constituency_town', function (Blueprint $table) {
            $table->id();
            $table->foreignId('constituency_id')->constrained();
            $table->foreignId('town_id')->constrained();
        });
    }
};
