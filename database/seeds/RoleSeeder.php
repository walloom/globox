<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Company;

class RoleSeeder extends Seeder {

    public function run() {

        Role::create([
            'key' => 'admin',
            'name' => 'Administrador',
            'description' => 'Administrador',
            'is_owner' => true,
        ]);

        Role::create([
            'key' => 'moderator',
            'name' => 'Director',
            'description' => 'Director',
            'is_owner' => true,
        ]);

        $companies = Company::get();

        foreach ($companies as $company):


            Role::create([
                'key' => 'company',
                'name' => 'Empresa',
                'description' => 'Empresa',
                'is_owner' => false,
                'company_id' => $company->id
            ]);

            Role::create([
                'key' => 'third',
                'name' => 'Tercero',
                'description' => 'Tercero',
                'is_owner' => false,
                'company_id' => $company->id
            ]);

            Role::create([
                'key' => 'provider',
                'name' => 'Proveedor',
                'description' => 'Proveedor',
                'is_owner' => false,
                'company_id' => $company->id
            ]);

            Role::create([
                'key' => 'operator',
                'name' => 'Operador',
                'description' => 'Operador',
                'is_owner' => false,
                'company_id' => $company->id
            ]);

            Role::create([
                'key' => 'reception',
                'name' => 'Recepción',
                'description' => 'Recepción',
                'is_owner' => false,
                'company_id' => $company->id
            ]);


        endforeach;
    }

}
