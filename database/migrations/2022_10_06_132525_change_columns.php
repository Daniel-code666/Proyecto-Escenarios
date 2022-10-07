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
        Schema::table('cmd_mislist_states', function (Blueprint $table) {
            $table->renameColumn('id', 'statesId');
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
        Schema::table('cmd_mislist_states', function (Blueprint $table) {
            $table->renameColumn('statesId', 'id');
            $table->renameColumn('statesName', 'name');
            $table->renameColumn('statesDescription', 'description');
        });
    }
};
