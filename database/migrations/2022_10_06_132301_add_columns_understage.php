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
        Schema::table('understages', function (Blueprint $table) {
            Schema::table('understages', function (Blueprint $table) {
                $table->string('understagecode')->nullable();
                $table->string('understagescale')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('understages', function (Blueprint $table) {
            $table->dropColumn(['understagecode','understagescale']);
        });
    }
};
