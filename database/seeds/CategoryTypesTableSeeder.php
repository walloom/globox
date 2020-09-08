<?php

use Illuminate\Database\Seeder;
use App\Models\CategoryType;

class CategoryTypesTableSeeder extends Seeder {

    public function run() {

        $data = $this->getData();

        foreach ($data as $item):
            CategoryType::create($item);
        endforeach;
    }

    private function getData() {
        return [
            [
                'name' => 'Inventariable',
            ],
            [
                'name' => 'Pedido Automatico',
            ],
            [
                'name' => 'Disponible en la Web',
            ],
            [
                'name' => 'Fraccionable',
            ],
            [
                'name' => 'Compuesto',
            ],
            [
                'name' => 'Facturable',
            ],
        ];
    }

}
