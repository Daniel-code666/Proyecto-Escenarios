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
        Schema::table('warehouses', function (Blueprint $table) {
            //
            $table->renameColumn('id', 'warehouseId');
            $table->renameColumn('name', 'warehouseName');
            $table->renameColumn('description', 'warehouseDescription');
            $table->renameColumn('address', 'warehouseLocation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouses', function (Blueprint $table) {
            //
            $table->renameColumn('warehouseId', 'id');
            $table->renameColumn('warehouseName', 'name');
            $table->renameColumn('warehouseDescription', 'description');
            $table->renameColumn('warehouseLocation', 'address');
        });
    }
};
