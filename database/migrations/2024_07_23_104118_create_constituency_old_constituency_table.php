<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('constituency_old_constituency', function (Blueprint $table) {
            $table->id();
            $table->foreignId('constituency_id')->constrained();
            $table->foreignId('old_constituency_id')->constrained();
            $table->float('overlap_area');
            $table->float('original_area');
            $table->float('percentage_overlap_area');
            $table->float('percentage_overlap_pop');
            $table->float('overlap_pop');
            $table->float('original_pop');
            $table->float('__index_level_0__')->nullable();
        });
    }
};
