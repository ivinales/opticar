<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'nombre' => 'Ian Viñales',
            'tipo_documento' => '1',
            'num_documento' => '19144640-2',
            'direccion' => 'Genova 396',
            'telefono' => '941623823',
            'email' => 'ian@gmail.com',
            'usuario' => 'ivinales',
            'password' => bcrypt('admin123'),
            'condicion' => '1',
            'idrol' => '1',
            'imagen' => 'asd',
            
        ]);
        DB::table('users')->insert([
            'id' => '2',
            'nombre' => 'Luis Rojas',
            'tipo_documento' => '1',
            'num_documento' => '19180644-1',
            'direccion' => 'Lejos',
            'telefono' => '9999999',
            'email' => 'luis@gmail.com',
            'usuario' => 'lrojas',
            'password' => bcrypt('admin123'),
            'condicion' => '1',
            'idrol' => '2',
            'imagen' => 'asd',
            
        ]);
        DB::table('users')->insert([
            'id' => '3',
            'nombre' => 'Daniel Muñoz',
            'tipo_documento' => '1',
            'num_documento' => '12349263-3',
            'direccion' => '69',
            'telefono' => '9999999',
            'email' => 'daniel@gmail.com',
            'usuario' => 'DMuñoz',
            'password' => bcrypt('admin123'),
            'condicion' => '1',
            'idrol' => '3',
            'imagen' => 'asd',
            
        ]);
    }
}
