<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role= Role::create([
         'company_id'=>null,
         'name'=>'admin'
        ]);
        $permissions =Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);


    }
}
