<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharitiesTable extends Migration
{
    public function up()
    {
        Schema::create('charities', function (Blueprint $table) {
            $table->id();
            $table->string('charity_id');
            $table->string('company_id')->nullable();
            $table->string('name');
            $table->string('website')->nullable();
            $table->integer('trustees')->nullable();
            $table->integer('employees')->nullable();
            $table->integer('volunteers')->nullable();
            $table->date('registered')->nullable();
            $table->date('financial_year')->nullable();
            $table->decimal('income', 15, 2)->nullable();
            $table->decimal('spending', 15, 2)->nullable();
            $table->text('funders')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->json('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('ccg')->nullable();
            $table->string('eer')->nullable();
            $table->string('laua')->nullable();
            $table->string('lsoa')->nullable();
            $table->string('msoa')->nullable();
            $table->string('pcon')->nullable();
            $table->string('ru')->nullable();
            $table->string('ttwa')->nullable();
            $table->string('ward')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->unsignedBigInteger('constituency_id')->nullable();
            $table->timestamps();

            $table->foreign('constituency_id')->references('id')->on('constituencies')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('charities');
    }
}
