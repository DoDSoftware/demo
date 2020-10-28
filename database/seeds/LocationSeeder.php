<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $basePath = base_path();
        $files = ['countries', 'states', 'cities'];
        foreach ($files as $file) {
            $path = "$basePath/database/sql/$file.sql";
            $sql = file_get_contents($path);
            DB::unprepared($sql);
        }
    }
}
