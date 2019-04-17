<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'SuperAdmin',
            'Developer',
            'Admin',
            'User'
        ];

        foreach ($roles as $role) {
            $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => $role]);
            $role->givePermissionTo(\Spatie\Permission\Models\Permission::all());
        }
    }
}
