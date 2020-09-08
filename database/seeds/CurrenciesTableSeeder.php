<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    
    public function run()
    {
        $sql = base_path('database/queries/currencies.sql');
        DB::unprepared(file_get_contents($sql));
    }
}
