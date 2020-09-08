<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionRoleTableSeeder extends Seeder {

    public function run() {
        
        $roles = Role::where('is_owner', false)->get();
        $permissions = Permission::get();

        foreach ($roles as $role):
            $role->permissions()->attach($permissions);
        endforeach;
    }

}
