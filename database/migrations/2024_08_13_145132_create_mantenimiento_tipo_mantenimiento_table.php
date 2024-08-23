<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientoTipoMantenimientoTable extends Migration
{
    public function up()
    {
        Schema::create('mantenimiento_tipo_mantenimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mantenimiento_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_mantenimiento_id')->constrained('tipo_mantenimiento')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mantenimiento_tipo_mantenimiento');
    }
}
