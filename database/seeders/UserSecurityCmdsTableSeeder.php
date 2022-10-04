<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSecurityCmdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('1', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('1', '1', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('2', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('2', '2', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('2', '3', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('3', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('3', '4', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('3', '5', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('4', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('4', '6', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('4', '7', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('4', '8', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('5', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('5', '9', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('6', '0', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('6', '10', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('6', '11', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('6', '12', '1', '1');
            INSERT INTO `idrdsystem`.`user_security_cmds` (`menuid`, `submenuid`, `show`, `can`) VALUES ('6', '13', '1', '1');
        ");
    }
}