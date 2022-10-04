<?php

namespace Database\Seeders;

use App\Models\neighborhood;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class NeighborhoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        neighborhood::truncate();

        $json = Storage::disk('local')->get('/json/neighborhoods.json');
        $neighborhoods = json_decode($json, true);
        
        foreach ($neighborhoods as $hood){
            neighborhood::query()->updateOrCreate([
                'hoodName' => $hood['hoodName'],
                'LocalityId' => $hood['LocalityId']
            ]);
        }
    }
}
