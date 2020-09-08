<?php

use Illuminate\Database\Seeder;
use App\Models\EconomicActivity;

class EconomicActivitiesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $data = $this->getData();

        foreach ($data as $item):
            EconomicActivity::create([
                'name' => $item['name']
            ]);
        endforeach;
    }

    private function getData() {
        return [
            [
                'name' => 'Transporte Y Comunicaciones'
            ],
            [
                'name' => 'Comercio, Restaurantes Y Hospedaje, Reparaciones'
            ],
            [
                'name' => 'Construcción'
            ],
            [
                'name' => 'Otros'
            ]
        ];
    }

}
