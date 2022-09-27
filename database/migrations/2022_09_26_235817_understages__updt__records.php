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
        Schema::create('understage_updt_records', function (Blueprint $table){
            $table->id('id_del_understg_rec');
            $table->string('name_understg', 500);
            $table->decimal('area_understg', 9, 2);
            $table->integer('capacity_understg');
            $table->string('address_understg', 100);
            $table->date('updt_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('understage_updt_records');
    }
};
