<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\City;

class CitiesTableSeeder extends Seeder {

    public function run() {


        $sql = base_path('database/queries/cities-0.sql');
        DB::unprepared(file_get_contents($sql));

        $sql = base_path('database/queries/cities-1.sql');
        DB::unprepared(file_get_contents($sql));

        $sql = base_path('database/queries/cities-2.sql');
        DB::unprepared(file_get_contents($sql));

        $sql = base_path('database/queries/cities-3.sql');
        DB::unprepared(file_get_contents($sql));

        $sql = base_path('database/queries/cities-4.sql');
        DB::unprepared(file_get_contents($sql));
    }

}
