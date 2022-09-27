<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stage_deleted_records', function (Blueprint $table) {
            $table->renameColumn('localityid', 'locality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stage_deleted_records', function (Blueprint $table) {
            $table->renameColumn('locality', 'localityid');
        });
    }
};
