<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Storage Solutions
    Setting::create([
      'logo' => 'logo.png',
      'primary' => '#ee2c3b',
      'secondary' => '#000000',
      'settings' => '{colors: {"primary": "#ee2c3b","secondary": "#000000"}}',
      'notes' => ''
    ]);

    // Exito
    Setting::create([
      'logo' => 'logo.png',
      'primary' => '#ffe700',
      'secondary' => '#333E47',
      'settings' => '{colors: {"primary": "#ffe700","secondary": "#333E47"}}',
      'notes' => ''
    ]);

    // Corona
    Setting::create([
      'logo' => 'logo.png',
      'primary' => '#0069b4',
      'secondary' => '#0069b4',
      'settings' => '{colors: {"primary": "#0069b4","secondary": "#0069b4"}}',
      'notes' => ''
    ]);

  }
}
