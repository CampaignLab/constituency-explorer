<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('community_centres', function (Blueprint $table) {
            $table->after('postcode', function (Blueprint $table) {
                $table->float('longitude')->nullable();
                $table->float('latitude')->nullable();
            });
        });
    }
};
