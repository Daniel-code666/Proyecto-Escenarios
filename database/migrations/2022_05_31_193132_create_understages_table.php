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
        Schema::create('understages', function (Blueprint $table) {
            $table->id('idUnderstage');
            $table->integer('idStage');
            $table->integer('id_category');
            $table->string('message_state',500);
            $table->string('discipline',55);
            $table->string('name',100);
            $table->decimal('area',9,2);
            $table->string('address',100);
            $table->string('latitude',45);
            $table->string('longitude',45);
            $table->Integer('capacity');
            $table->string('descripcion',500);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('understages');
    }
};
