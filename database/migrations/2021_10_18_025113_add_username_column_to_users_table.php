<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('email');
            $table->string('photo')->nullable()->after('username');
            $table->string('ttd_img')->nullable()->after('photo');
            $table->integer('type_id')->nullable()->after('ttd_img');
            $table->integer('perusahaan_id')->nullable()->unsigned()->after('type_id');
            $table->timestamp('deleted_at')->nullable()->after('perusahaan_id');
            $table->integer('created_by')->nullable()->after('deleted_at');
            $table->integer('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
