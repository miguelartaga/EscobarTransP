<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoferesTable extends Migration
{
    public function up(): void
    {
        Schema::create('choferes', function (Blueprint $table) {
            $table->id(); // Clave primaria para la tabla choferes
            $table->string('ci')->unique(); // Carnet de Identidad, debe ser único
            $table->string('nombre');
            $table->string('licencia'); // Puedes ajustar este campo si es necesario para almacenar la foto
            $table->string('direccion'); // Nueva columna para dirección
            $table->string('numero_referencia'); // Nueva columna para número de referencia
            $table->string('numero_referencia_segundo'); // Nueva columna para número de referencia
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('choferes');
    }
}
