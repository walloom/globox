<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker::create('es_ES');
        $companies = Company::get();

        User::create([
            'name' => 'WM Duberney',
            'last_name' => 'Yepes',
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'email' => 'duberney112@gmail.com',
            'password' => Hash::make('7CDy4U0mNblAhse'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Administrator',
            'last_name' => '',
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'email' => 'admin@globox.com',
            'password' => Hash::make('7CDy4U0mNblAhse'),
            'role_id' => 1
        ]);


        foreach ($companies as $company):

            $domain = Str::lower(Str::camel($company->name)) . '.com';
            $roles = Role::where('company_id', $company->id)->get();

            User::create([
                'name' => 'Admin ' . $company->name,
                'last_name' => '',
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => 'admin@' . $domain,
                'password' => Hash::make('123456'),
                'role_id' => 3,
                'company_id' => 1
            ]);

            foreach (range(1, 20) as $item):

                User::create([
                    'name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'address' => $faker->address,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->userName . '@' . $domain,
                    'password' => Hash::make('123456'),
                    'role_id' => $roles[random_int(0, random_int(0, $roles->count() - 1))]->id,
                    'company_id' => $company->id
                ]);

            endforeach;

        endforeach;
    }

}

