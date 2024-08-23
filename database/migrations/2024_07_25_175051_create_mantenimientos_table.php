<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientosTable extends Migration
{
    public function up(): void
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->string('camion_id');
            $table->foreign('camion_id')->references('numero_placa')->on('camiones')->onDelete('cascade');
            $table->foreignId('tipo_mantenimiento_id')->constrained('tipo_mantenimiento')->onDelete('cascade');
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->dropForeign(['camion_id']);
            $table->dropForeign(['tipo_mantenimiento_id']);
        });

        Schema::dropIfExists('mantenimientos');
    }
}
