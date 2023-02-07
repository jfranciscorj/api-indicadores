<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Administrador',
            'email' => 'ju.ramirezj@gmail.com',
            'password' => bcrypt('12345678'),
            'active' => '1'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Ejecutivo',
            'email' => 'j.ramirezj@gmail.com',
            'password' => bcrypt('12345678'),
            'active' => '1'
        ])->assignRole('Ejecutivo');
    }
}
