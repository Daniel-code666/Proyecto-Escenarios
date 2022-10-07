<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Cmd_Mislist_StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            insert into cmd_mislist_states (`statesName`, `statesDescription`, `tableParent`) values ('Bueno', 'Indica que el espacio está en perfectas condiciones estructurales', 'stages');
            insert into cmd_mislist_states (`statesName`, `statesDescription`, `tableParent`) values ('Regular', 'Indica que el espacio tiene daños pocos significativos para su estructura', 'stages');
            insert into cmd_mislist_states (`statesName`, `statesDescription`, `tableParent`) values ('Malo', 'Indica que el espacio está en pésimas condiciones estructurales', 'stages');
            insert into cmd_mislist_states (`statesName`, `statesDescription`, `tableParent`) values ('Bueno', 'Indica que el objeto está perfectas condiciones', 'inventary');
            insert into cmd_mislist_states (`statesName`, `statesDescription`, `tableParent`) values ('Regular', 'Indica que el objeto tiene daños pocos significativos', 'inventary');
            insert into cmd_mislist_states (`statesName`, `statesDescription`, `tableParent`) values ('Malo', 'Indica que el objeto está en pésimas condiciones', 'inventary');
        ");
    }
}
