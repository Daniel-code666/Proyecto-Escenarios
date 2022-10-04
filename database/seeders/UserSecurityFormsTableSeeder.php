<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSecurityFormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '1', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '1', '1', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '2', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '2', '2', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '2', '3', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '3', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '3', '4', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '3', '5', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '4', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '4', '6', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '4', '7', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '4', '8', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '5', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '5', '9', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '6', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '6', '10', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '6', '11', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '6', '12', '1', '1');
            INSERT INTO `idrdsystem`.`user_securiry_forms` (`userid`, `menuid`, `submenuid`, `show`, `can`) VALUES ('1', '6', '13', '1', '1');
        ");
    }
}
