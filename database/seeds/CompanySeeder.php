<?php

use Illuminate\Database\Seeder;
use App\Models\Company;


class CompanySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Company::create([
      'logo' => 'logo-corporate-55.png',
      'primary' => '#ee2c3b',
      'secondary' => '#000000',
      'settings' => '{colors: {"primary": "#ee2c3b","secondary": "#000000"}}',            
      'name' => 'Storage Solutions',
      'sector' => 'Bodegas',
      'state' => 'ANTIOQUIA',
      'city' => 'MEDELLÍN',
      'telephone' => '+57 (4) 596 66 71',
      'responsibility' => '',
      'notes' => ''
    ]);

    Company::create([
      'logo' => 'logo-exito.png',
      'primary' => '#ffe700',
      'secondary' => '#000000',
      'primary_text' => '#000000',
      'secondary_text' => '#ffffff',
      'settings' => '',
      'name' => 'Grupo Exito',
      'sector' => 'Grandes Superficies',
      'state' => 'ANTIOQUIA',
      'city' => 'MEDELLÍN',
      'telephone' => '(+574) 604 9696',
      'responsibility' => '',
      'notes' => ''
    ]);

    Company::create([
      'logo' => 'logo-corona.jpg',
      'primary' => '#0069b4',
      'secondary' => '#ffffff',
      'settings' => '{colors: {"primary": "#0069b4","secondary": "#ffffff"}}',
      'name' => 'Corona',
      'sector' => 'Grandes Superficies',
      'state' => 'ANTIOQUIA',
      'city' => 'MEDELLÍN',
      'telephone' => '(+571) 404 88 84',
      'responsibility' => '',
      'notes' => ''
    ]);
  }
}
