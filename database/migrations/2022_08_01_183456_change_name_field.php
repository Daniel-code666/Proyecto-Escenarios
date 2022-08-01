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
        Schema::table('misc_list_states', function (Blueprint $table) {
            $table->renameColumn('name', 'statesName');
            $table->renameColumn('description', 'statesDescription');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('misc_list_states', function (Blueprint $table) {
            $table->renameColumn('statesName', 'name');
            $table->renameColumn('statesDescription', 'description');
        });
    }
};
