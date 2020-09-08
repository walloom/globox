<?php

use Illuminate\Database\Seeder;
use App\Models\Company;

class PresentationsTableSeeder extends Seeder {

    public function run() {

        $companies = Company::get();
        $presentations = $this->getData();

        foreach ($companies as $company):

            foreach ($presentations as $presentation):
                $company->presentations()->create($presentation);
            endforeach;

        endforeach;
    }

    private function getData() {

        return [
            [
                'name' => 'Pallets',
                'description' => 'Pallets'
            ],
            [
                'name' => 'Cajas',
                'description' => 'Cajas'
            ],
            [
                'name' => 'Unidades',
                'description' => 'Unidades'
            ],
        ];
    }

}
