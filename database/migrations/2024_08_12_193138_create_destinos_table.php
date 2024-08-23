<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lugar_inicio_id')->constrained('lugares')->onDelete('cascade');
            $table->foreignId('lugar_final_id')->constrained('lugares')->onDelete('cascade');
            $table->integer('kilometros');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinos');
    }
};
