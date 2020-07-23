<?php

use Illuminate\Database\Seeder;

class TallerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taller')->insert([
            'nombre' => 'Donde Tony Padilla',
            'direccion' => 'ovalle S/n',
            'color' => 'red',
            'estado'=> '0'
        ]);

        DB::table('taller')->insert([
            'nombre' => 'Cosmo & Wanda',
            'direccion' => 'Balmaceda #69',
            'color' => 'pink',
            'estado'=> '0'
        ]);
    }
}
