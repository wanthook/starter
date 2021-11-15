<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->string('kode',100);
            $table->string('deskripsi', 255)->nullable();
            $table->integer('mrp_id')->unsigned()->comment('Material Requirement Planning');
            $table->integer('mtype_id')->unsigned()->comment('Material Type');
            $table->integer('mgroup_id')->unsigned()->comment('Material Group');
            $table->integer('bunit_id')->unsigned()->comment('Base Unit');
            $table->integer('valcl_id')->unsigned()->comment('Valuation Class');
            $table->id();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('kode');
            $table->index('mrp_id');
            $table->index('mtype_id');
            $table->index('mgroup_id');
            $table->index('bunit_id');
            $table->index('valcl_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
