<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_equipos', function (Blueprint $table) {
        $table->id();
        $table->string('tipo_equipo');
        $table->string('marca')->nullable();
        $table->string('modelo')->nullable();
        $table->string('color')->nullable();
        $table->string('accesorios')->nullable();
        $table->decimal('valor', 10, 2)->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_equipos');
    }
};
