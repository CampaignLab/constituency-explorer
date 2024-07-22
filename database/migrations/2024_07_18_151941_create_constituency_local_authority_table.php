<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('constituency_local_authority', function (Blueprint $table) {
            $table->id();
            $table->foreignId('constituency_id')->constrained()->onDelete('cascade');
            $table->foreignId('local_authority_id')->constrained()->onDelete('cascade');
            $table->float('overlap_area');
            $table->float('original_area');
            $table->float('percentage_overlap_area');
            $table->float('percentage_overlap_pop');
            $table->float('overlap_pop');
            $table->float('original_pop');
            $table->float('__index_level_0__')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constituency_local_authority');
    }
};
