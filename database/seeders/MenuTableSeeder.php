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
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Escenarios','fa fa-building-user');
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Inventarios','ni ni-app');
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Reportes','fa fa-chart-pie');
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Mapas','ni ni-map-big');
            INSERT INTO `idrdsystem`.`menus` (`name`,`logo`) VALUES ('Configuraciones','ni ni-settings-gear-65');
        ");
    }
}
