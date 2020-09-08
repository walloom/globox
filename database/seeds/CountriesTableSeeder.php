<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder {

    public function run() {
        
        $sql = base_path('database/queries/countries.sql');
        DB::unprepared(file_get_contents($sql));
        
    }

}
