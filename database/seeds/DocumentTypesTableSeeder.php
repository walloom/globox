<?php

use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypesTableSeeder extends Seeder {

    public function run() {

        $data = $this->getData();

        foreach ($data as $item):
            DocumentType::create($item);
        endforeach;
    }

    private function getData() {
        return [
            [
                'code' => 'CC',
                'description' => 'Cédula de Ciudadanía'
            ],
            [
                'code' => 'CE',
                'description' => 'Cédula de Extranjería'
            ],
            [
                'code' => 'PA',
                'description' => 'Pasaporte'
            ],
            [
                'code' => 'RC',
                'description' => 'Registro Civil'
            ],
            [
                'code' => 'TI',
                'description' => 'Tarjeta de Identidad'
            ]
        ];
    }

}
