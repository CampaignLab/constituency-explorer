<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('local_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('constituency_id')->constrained();
            $table->foreignId('local_authority_id')->constrained();
            $table->string('name');
            $table->longText('address')->nullable();
            $table->string('twitter')->nullable();
            $table->string('type_of_owner')->nullable();
            $table->string('frequency')->nullable();
            $table->string('cost')->nullable();
            $table->string('media_type')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }
};
