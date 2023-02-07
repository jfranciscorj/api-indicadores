<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        $administrador = Role::create(['name' => 'Administrador', 'active' => '1']);
        $ejecutivo = Role::create(['name' => 'Ejecutivo', 'active' => '1' ]);

        Permission::create(['name' => 'admin.home', 'description' => 'Ver inicio'])->assignRole($administrador, $ejecutivo);

        Permission::create(['name' => 'admin.index', 'description' => 'Ver'])->assignRole($administrador);
        Permission::create(['name' => 'admin.create', 'description' => 'crear'])->assignRole($administrador);
        Permission::create(['name' => 'admin.edit', 'description' => 'Actualizar'])->assignRole($administrador);
        Permission::create(['name' => 'admin.destroy', 'description' => 'Eliminar'])->assignRole($administrador);

        Permission::create(['name' => 'indicadores.index', 'description' => 'Ver'])->assignRole($administrador, $ejecutivo);
        Permission::create(['name' => 'indicadores.create', 'description' => 'crear'])->assignRole($administrador, $ejecutivo);
        Permission::create(['name' => 'indicadores.edit', 'description' => 'Actualizar'])->assignRole($administrador, $ejecutivo);
        Permission::create(['name' => 'indicadores.destroy', 'description' => 'Eliminar'])->assignRole($administrador, $ejecutivo);

    }
}
