<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            NeighborhoodTableSeeder::class, LocalitiesTableSeeder::class, UsersTableSeeder::class, 
            MenuTableSeeder::class, SubmenuTableSeeder::class, UserSecurityCmdsTableSeeder::class,
            UserSecurityFormsTableSeeder::class, Cmd_Mislist_StatesTableSeeder::class, Cmd_DisciplinesTableSeeder::class
        ]);
    }
}
