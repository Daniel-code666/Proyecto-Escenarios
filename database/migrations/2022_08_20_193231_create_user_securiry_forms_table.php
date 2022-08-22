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
        Schema::create('user_securiry_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->integer('menuid');
            $table->integer('submenuid');
            $table->boolean('show');
            $table->boolean('can');
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
        Schema::dropIfExists('user_securiry_forms');
    }
};
