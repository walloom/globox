<?php

use Illuminate\Database\Seeder;
use App\Models\Catalog;
use App\Models\Customer;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Size;

class CatalogsTableSeeder extends Seeder {

    public function run() {

        $customers = Customer::get();
        $faker = Faker::create('es_ES');
        $data = [];
        $cont = 0;
        $now = Carbon::now();
        
        foreach ($customers as $customer):
            
            $sizes = Size::where('company_id', $customer->company_id)->get();

            foreach (range(1, 15) as $index):
                $data[] = [
                    'company_id' => $customer->company_id,
                    'customer_id' => $customer->id,
                    'name' => $faker->name,
                    'ean' => $faker->ean8,
                    'plu' => $faker->numberBetween(0, 10),
                    'size_id' => $sizes[random_int(0, $sizes->count() - 1)]->id,
                    'dimension'=> 'Dimensión',
                    
                    
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                $cont++;

                if ($cont === 500):
                    Catalog::insert($data);
                    $data = [];
                    $cont=0;
                endif;

            endforeach;

        endforeach;
    }

}
