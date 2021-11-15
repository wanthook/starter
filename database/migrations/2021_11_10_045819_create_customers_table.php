<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('kode', 255);
            $table->string('nama1', 255);
            $table->string('nama2', 255)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('jalan1', 255)->nullable();
            $table->string('jalan2', 255)->nullable();

            $table->integer('country_id')->unsigned();
            $table->integer('group_id')->unsigned();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->index('kode');
            $table->index('nama1');
            $table->index('kota');
            $table->index('country_id');
            $table->index('group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
