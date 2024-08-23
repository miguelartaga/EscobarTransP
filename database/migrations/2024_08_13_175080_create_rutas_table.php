<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutasTable extends Migration
{
    public function up(): void
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();

            // Campo para el número de placa del camión
            $table->string('camion_numero_placa'); // Asegúrate de que este tipo coincida con el tipo en `camiones`
            $table->foreign('camion_numero_placa')->references('numero_placa')->on('camiones')->onDelete('cascade');

            // Campo para el identificador del chofer
            $table->unsignedBigInteger('chofer_id'); // Si `id` en `choferes` es unsignedBigInteger
            $table->foreign('chofer_id')->references('id')->on('choferes')->onDelete('cascade');

            $table->foreignId('destino_id')->constrained('destinos')->onDelete('cascade');
            $table->date('fecha_fin');
            $table->string('codigo_de_pago');
            $table->string('carga');
            $table->string('peso');
            $table->string('precio');
            $table->string('precio_total');

            // Nueva columna para indicar si la ruta ha sido realizada
            $table->boolean('is_realizada')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
}
