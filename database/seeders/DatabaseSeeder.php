<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar el UserSeeder para crear un usuario
        $this->call(UserSeeder::class);

        // Ejecutar el TipoMantenimientoSeeder para crear un tipo de mantenimiento
        $this->call(TipoMantenimientoSeeder::class);
    }
}
