<?php

use Illuminate\Database\Seeder;
use App\Models\ReferenceType;
use App\Models\Company;

class ReferenceTypesTableSeeder extends Seeder {

    public function run() {

        $companies = Company::get();
        $sizes = $this->getData();

        foreach ($companies as $company):

            foreach ($sizes as $size):
                $company->referenceTypes()->create($size);
            endforeach;

        endforeach;
    }

    private function getData() {

        return [
            [
                'code' => '01',
                'description' => 'Materias primas'
            ],
            [
                'code' => '02',
                'description' => 'Material de embalaje'
            ],
            [
                'code' => '03',
                'description' => 'Transacción de proceso'
            ],
            [
                'code' => '04',
                'description' => 'CIF'
            ],
            [
                'code' => '05',
                'description' => 'Producto terminado'
            ],
            [
                'code' => '06',
                'description' => 'Producto intermedio'
            ],
            [
                'code' => '06',
                'description' => 'Material de empaque'
            ],
        ];
    }

}
