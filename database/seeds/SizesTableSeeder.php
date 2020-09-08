<?php

use Illuminate\Database\Seeder;
use App\Models\Size;
use App\Models\Company;

class SizesTableSeeder extends Seeder {

   
    public function run() {
        
        $companies = Company::get();
        $sizes = $this->getData();

        foreach ($companies as $company):

            foreach ($sizes as $size):
                $company->sizes()->create($size);
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
