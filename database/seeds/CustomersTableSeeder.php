<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Company;
use App\Models\Customer;
use Carbon\Carbon;

class CustomersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create('es_ES');
        $companies = Company::get();
        $now = Carbon::now();

        foreach ($companies as $company):

            $data = [];
            foreach (range(1, 100) as $index):

                $data[] = [
                    'company_id' => $company->id,
                    'name' => $faker->company,
                    'document_type_id' => 1,
                    'identification' => $faker->ean8,
                    'country_id' => 47,
                    'state_id' => 776,
                    'city_id' => 12601,
                    'zone' => $faker->city,
                    'cell_number' => $faker->phoneNumber,
                    'phone_number' => $faker->phoneNumber,
                    'address' => $faker->address,
                    'economic_activity_id' => 1,
                    'currency_id' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            endforeach;
            
            Customer::insert($data);


        endforeach;
    }

}
