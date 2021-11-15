<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_options', function (Blueprint $table) {
            $table->string('kode',100);
            $table->string('deskripsi', 255)->nullable();
            $table->string('tipe',50);
            $table->string('warna', 50)->nullable();
            $table->string('nilai',255)->nullable();
            $table->id();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('kode');
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
        Schema::dropIfExists('master_options');
    }
}
