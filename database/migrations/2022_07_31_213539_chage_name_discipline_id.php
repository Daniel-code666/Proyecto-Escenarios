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
        Schema::table('cmd_disciplines', function (Blueprint $table) {
            //
            $table->renameColumn('discipline_id', 'disciplineId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cmd_disciplines', function (Blueprint $table) {
            //
            $table->renameColumn('discipline_id', 'disciplineId');
        });
    }
};
