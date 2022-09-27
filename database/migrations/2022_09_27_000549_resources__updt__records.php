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
        Schema::create('resource_updt_records', function (Blueprint $table){
            $table->id('id_updt_resource_rec');
            $table->string('resourceName', 500);
            $table->string('resourceCode', 50);
            $table->integer('amount');
            $table->integer('amountInUse');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_updt_records');
    }
};
