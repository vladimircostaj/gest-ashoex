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
        Schema::create('tipo_personals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');  // Crea una columna 'nombre' de tipo string para almacenar el nombre del tipo de personal
            $table->string('carga_horaria');  // Crea una columna 'carga_horaria' de tipo string para almacenar la carga horaria del tipo de personal
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));  // Crea la columna 'created_at' con valor predeterminado de la marca de tiempo actual
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));  // Crea la columna 'updated_at' con valor predeterminado de la marca de tiempo actual
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_personals');  // Elimina la tabla 'tipo_personals' si existe
    }
};
