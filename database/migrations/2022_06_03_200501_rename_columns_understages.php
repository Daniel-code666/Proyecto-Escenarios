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
        Schema::table('understages', function (Blueprint $table) {
            $table->renameColumn('id_category', 'id_category_understg');
            $table->renameColumn('message_state', 'message_state_understg');
            $table->renameColumn('discipline', 'discipline_understg');
            $table->renameColumn('name', 'name_understg');
            $table->renameColumn('area', 'area_understg');
            $table->renameColumn('address', 'address_understg');
            $table->renameColumn('latitude', 'latitude_understg');
            $table->renameColumn('longitude', 'longitude_understg');
            $table->renameColumn('capacity', 'capacity_understg');
            $table->renameColumn('descripcion', 'description_understg');
            $table->renameColumn('photo', 'photo_understg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('understages', function (Blueprint $table) {
            $table->renameColumn('id_category_understg', 'id_category');
            $table->renameColumn('message_state_understg', 'message_state');
            $table->renameColumn('discipline_understg', 'discipline');
            $table->renameColumn('name_understg', 'name');
            $table->renameColumn('area_understg', 'area');
            $table->renameColumn('address_understg', 'address');
            $table->renameColumn('latitude_understg', 'latitude');
            $table->renameColumn('longitude_understg', 'longitude');
            $table->renameColumn('capacity_understg', 'capacity');
            $table->renameColumn('description_understg', 'descripcion');
            $table->renameColumn('photo_understg', 'photo');
        });
    }
};
