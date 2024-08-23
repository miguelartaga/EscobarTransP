<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMantenimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_mantenimiento')->insert([
            'nombre' => 'cambio de aceite',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
