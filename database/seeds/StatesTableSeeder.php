<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
   
    public function run()
    {
        $sql = base_path('database/queries/states.sql');
        DB::unprepared(file_get_contents($sql));
    }
}
