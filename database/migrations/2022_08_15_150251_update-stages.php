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
        Schema::table('stages', function (Blueprint $table) {
            //
            $table->integer('underStagesQty')->nullable();
            $table->integer('stegeCode')->nullable();
            $table->integer('localityid')->nullable();
            $table->integer('neighborhoodid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stages', function (Blueprint $table) {
            //
            $table->integer('underStagesQty')->nullable();
            $table->integer('stegeCode')->nullable();
            $table->integer('localityid')->nullable();
            $table->integer('neighborhoodid')->nullable();
        });
    }
};
