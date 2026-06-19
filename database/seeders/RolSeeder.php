<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //se crea aqui los 3 roles que se ocuparan encapsulandolos en $role para que asi pueda se utilice spatie
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'operator']);
        $role3 = Role::create(['name' => 'client']);
    }
}
