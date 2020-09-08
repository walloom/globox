<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(EconomicActivitiesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(CategoryTypesTableSeeder::class);

        $this->call(CompanySeeder::class);
        $this->call(RoleSeeder::class);
        
        $this->call(SettingSeeder::class);
        $this->call(BodegaSeeder::class);
        $this->call(UsersTableSeeder::class);

        //Para compañias
        $this->call(UnitsTableSeeder::class);
        $this->call(PresentationsTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(ReferenceTypesTableSeeder::class);

        $this->call(CustomersTableSeeder::class);
        $this->call(CatalogsTableSeeder::class);

        //Roles
        $this->call(GroupPermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
       
    }

}
