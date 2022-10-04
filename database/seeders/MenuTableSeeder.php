<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Administrador','ni ni-settings');
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Escenarios','ni ni-building');
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Inventarios','ni ni-app');
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Reportes','ni ni-chart-bar-32');
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Mapas','ni ni-map-big');
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Configuraciones','ni ni-settings-gear-65');
        ");
    }
}
