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
        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->renameColumn('id', 'hoodId');
            $table->renameColumn('name', 'hoodName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->renameColumn('hoodId', 'id');
            $table->renameColumn('hoodName', 'name');
        });
    }
};
