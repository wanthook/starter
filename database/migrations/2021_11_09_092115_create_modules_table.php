<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->string('nama', 50);
            $table->string('deskripsi', 255)->nullable();
            $table->string('route', 255);
            $table->string('param', 255)->nullable();
            $table->string('icon', 255)->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('_lft')->default(0);
            $table->integer('_rgt')->default(0);
            $table->id();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama');
            $table->index('parent_id');
            $table->index('_lft');
            $table->index('_rgt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
