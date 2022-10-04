<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LocalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('ANTONIO NARIÑO');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('BARRIOS UNIDOS');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('BOSA');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('CHAPINERO');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('CIUDAD BOLÍVAR ');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('ENGATIVÁ');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('FONTIBÓN');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('KENNEDY');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('LA CANDELARIA');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('LOS MÁRTIRES');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('PUENTE ARANDA');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('RAFAEL URIBE URIBE');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('SAN CRISTÓBAL');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('SANTA FE');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('SUBA');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('SUMAPAZ');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('TEUSAQUILLO');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('TUNJUELITO');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('USAQUÉN ');
            INSERT INTO `idrdsystem`.`localities` (`localityName`) VALUES ('USME');
        ");
    }
}
