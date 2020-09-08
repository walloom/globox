<?php

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Company;

class UnitsTableSeeder extends Seeder {

    public function run() {

        $companies = Company::get();
        $units = $this->getData();

        foreach ($companies as $company):

            foreach ($units as $unit):
                $company->units()->create($unit);
            endforeach;

        endforeach;
    }

    private function getData() {

        return [
            [
                'code' => 'CJ',
                'description' => 'Cajas'
            ],
            [
                'code' => 'cm',
                'description' => 'Centímetors'
            ],
            [
                'code' => 'cm2',
                'description' => 'Centímetors cuadrados'
            ],
            [
                'code' => 'd',
                'description' => 'Día'
            ],
            [
                'code' => 'dp',
                'description' => 'Display'
            ],
            [
                'code' => 'g',
                'description' => 'Gramo'
            ],
            [
                'code' => 'gal',
                'description' => 'Galón'
            ],
            [
                'code' => 'h',
                'description' => 'Hora'
            ],
            [
                'code' => 'Kg',
                'description' => 'Kilogramo'
            ],
            [
                'code' => 'L',
                'description' => 'Litro'
            ],
            [
                'code' => 'm',
                'description' => 'Metro'
            ],
            [
                'code' => 'm2',
                'description' => 'Metro cuadrado'
            ],
            [
                'code' => 'm3',
                'description' => 'Metro cubico'
            ]
        ];
    }

}
