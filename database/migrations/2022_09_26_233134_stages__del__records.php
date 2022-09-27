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
        Schema::create('stage_deleted_records', function (Blueprint $table){
            $table->id('id_del_stg_rec');
            $table->string('name', 500);
            $table->decimal('area', 9, 2);
            $table->integer('capacity');
            $table->string('address', 100);
            $table->integer('underStageQty');
            $table->string('stegeCode', 50);
            $table->integer('localityid');
            $table->integer('neighborhood');
            $table->date('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stage_deleted_records');
    }
};
