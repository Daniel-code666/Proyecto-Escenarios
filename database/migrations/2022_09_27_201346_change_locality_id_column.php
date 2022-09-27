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
        Schema::table('stage_updated_records', function (Blueprint $table) {
            $table->renameColumn('localityid', 'locality_updt');
            $table->renameColumn('neighborhood', 'neighborhood_updt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stage_updated_records', function (Blueprint $table) {
            $table->renameColumn('locality_updt', 'localityid');
            $table->renameColumn('neighborhood_updt', 'neighborhood');
        });
    }
};
