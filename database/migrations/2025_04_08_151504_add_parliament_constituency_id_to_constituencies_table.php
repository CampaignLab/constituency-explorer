<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('constituencies', function (Blueprint $table) {
            $table->integer('parliament_constituency_id')->after('gss_code')->nullable();
        });
    }
};
