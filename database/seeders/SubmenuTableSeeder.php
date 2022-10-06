<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SubmenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('1', 'Administrar Usuarios','ni ni-badge','/users');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('2', 'Principales','fa fa-building','/escenario');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('2', 'Sub Escenarios','ni ni-building','/understage');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('3', 'Items','fa fa-boxes-stacked','/item');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('3', 'Almacenes','fa fa-warehouse','/almacen');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('4', 'Escenarios','ni ni-building','/stagereport');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('4', 'Inventarios','ni ni-app','/resourcereport');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('4', 'Otros','ni ni-single-copy-04','/historicreport');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('5', 'Escenarios','fa fa-map-location','map');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('6', 'Disciplinas','ni ni-user-run','/discipline');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('6', 'Estado Escenarios','fa fa-building-circle-check','/states');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('6', 'Estado Inventarios','fa fa-clipboard-check','/inventarystates');
            INSERT INTO `idrdsystem`.`submenus` (`menuid`, `name`,`logo`,`route`) VALUES ('6', 'Graderías','fa fa-stairs','/grandstand');
        ");
    }
}
