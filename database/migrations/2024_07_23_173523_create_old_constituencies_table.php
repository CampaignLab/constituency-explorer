<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('old_constituencies', function (Blueprint $table) {
            $table->id();
            $table->string('gss_code');
            $table->string('name');
            $table->timestamps();
        });
    }
};
