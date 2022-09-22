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
        Schema::table('resources', function (Blueprint $table) {
            $table->renameColumn('updated_at', 'updated_at_resources');
            $table->renameColumn('created_at', 'created_at_resources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->renameColumn('updated_at_resources', 'updated_at');
            $table->renameColumn('created_at_resources', 'created_at');
        });
    }
};
