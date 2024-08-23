<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamionesTable extends Migration
{
    public function up(): void
    {
        Schema::create('camiones', function (Blueprint $table) {
            $table->string('numero_placa')->primary(); // Clave primaria
            $table->string('modelo');
            $table->year('año');
            $table->text('descripcion')->nullable();
            $table->integer('proximo_cambio_aceite')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('camiones');
    }
}
