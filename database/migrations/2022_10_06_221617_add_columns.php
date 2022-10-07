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
        Schema::table('understage_deleted_records', function (Blueprint $table) {
            $table->integer('understageqty')->nullable();
            $table->integer('localityid')->nullable();
            $table->integer('neighborhoodid')->nullable();
            $table->string('understagecode')->nullable();
            $table->string('understagescale')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('understage_deleted_records', function (Blueprint $table) {
            $table->dropColumn(['understageqty', 'localityid', 'neighborhoodid','understagecode','understagescale']);
        });
    }
};
