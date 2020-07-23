<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => '1',
            'nombre' => 'Administrador',
            'descripcion' => 'Administrador'
        ]);
        DB::table('roles')->insert([
            'id' => '2',
            'nombre' => 'Mecanico',
            'descripcion' => 'Mecanico'
        ]);
        DB::table('roles')->insert([
            'id' => '3',
            'nombre' => 'Cliente',
            'descripcion' => 'Cliente'
        ]);
    }
}
