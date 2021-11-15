<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesins', function (Blueprint $table) {
            $table->string('nama', 255);
            $table->string('merek', 255)->nullable();
            $table->string('proses', 255);
            $table->string('spesifikasi', 255)->nullable();
            $table->string('deskripsi', 255)->nullable();
            $table->decimal('k_min',18,2)->nullable();
            $table->decimal('k_max',18,2)->nullable();
            $table->enum('tipe', ['rajut', 'dyeing', 'finishing']);
            $table->integer('wc_id')->unsigned()->comment('Work Center');
            $table->id();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama');
            $table->index('wc_id');
            $table->index('proses');
            $table->index('tipe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesins');
    }
}
