<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstituenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constituencies', function (Blueprint $table) {
            $table->id();
            $table->string('full_code');
            $table->string('short_code');
            $table->string('name');
            $table->string('name_cy')->nullable();
            $table->string('gss_code')->nullable();
            $table->string('three_code')->nullable();
            $table->string('nation');
            $table->string('region');
            $table->string('con_type');
            $table->integer('electorate')->nullable();
            $table->decimal('area', 10, 8)->nullable();
            $table->decimal('density', 10, 8)->nullable();
            $table->decimal('center_lat', 10, 8)->nullable();
            $table->decimal('center_lon', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constituencies');
    }
}
