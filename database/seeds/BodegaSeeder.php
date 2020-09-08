<?php

use Illuminate\Database\Seeder;
use App\Models\Bodega;

class BodegaSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Storage solutions
        Bodega::create([
            'company_id' => 1,
            'photo' => 'photo_1.jpg',
            'name' => 'Bodega 1 Itagui',
            'occupation' => '50.5',
            'address' => '',
            'state_id' => 776,
            'city_id' => 12601,
            'telephone' => '',
            'responsable' => '',
            'notes' => 'Disponible para la recepción de mercancia'
        ]);

        Bodega::create([
            'company_id' => 1,
            'photo' => 'photo_2.jpg',
            'name' => 'Bodega 2 Itagui',
            'occupation' => '85.5',
            'address' => '',
            'state_id' => 776,
            'city_id' => 12601,
            'telephone' => '',
            'responsable' => '',
            'notes' => 'Disponible para la recepción de mercancia'
        ]);

        Bodega::create([
            'company_id' => 1,
            'photo' => 'photo_3.jpg',
            'name' => 'Bodega Bello',
            'occupation' => '15.5',
            'address' => '',
            'state_id' => 776,
            'city_id' => 12601,
            'telephone' => '',
            'responsable' => '',
            'notes' => 'Disponible para la recepción de mercancia'
        ]);

        // Grupo Exito
        Bodega::create([
            'company_id' => 2,
            'photo' => 'photo_4.jpg',
            'name' => 'Bodega la 33',
            'occupation' => '25.5',
            'address' => '',
            'state_id' => 776,
            'city_id' => 12601,
            'telephone' => '',
            'responsable' => '',
            'notes' => 'Disponible para la recepción de mercancia'
        ]);

        Bodega::create([
            'company_id' => 2,
            'photo' => 'photo_5.jpg',
            'name' => 'Bodega Sabaneta',
            'occupation' => '95.2',
            'address' => '',
            'state_id' => 776,
            'city_id' => 12601,
            'telephone' => '',
            'responsable' => '',
            'notes' => 'Disponible para la recepción de mercancia, horario limitado'
        ]);

        Bodega::create([
            'company_id' => 2,
            'photo' => 'photo_6.jpg',
            'name' => 'Zona franca',
            'occupation' => '50.2',
            'address' => '',
            'state_id' => 776,
            'city_id' => 12601,
            'telephone' => '',
            'responsable' => '',
            'notes' => 'Disponible para la recepción de mercancia, 24 Horas'
        ]);
    }

}
