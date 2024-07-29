<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dentists', function (Blueprint $table) {
            $table->after('address', function (Blueprint $table) {
                $table->float('latitude')->nullable();
                $table->float('longitude')->nullable();
            });
        });
    }
};
