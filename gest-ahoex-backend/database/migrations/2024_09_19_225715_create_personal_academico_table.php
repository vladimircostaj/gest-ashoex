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
        Schema::create('personal_academicos', function (Blueprint $table) {
            $table->id();  // Crea una columna 'id' con clave primaria auto-incremental
            $table->string('nombre');    // Crea una columna 'nombre' de tipo string para almacenar el nombre del personal académico
            $table->string('email')->unique();  // Crea una columna 'email' de tipo string y la hace única para evitar duplicados
            $table->integer('telefono')->unique(); // Crea una columna 'telefono' de tipo entero y la hace única para almacenar

            $table->unsignedInteger('tipo_personal_id');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        
            $table->foreign('tipo_personal_id')  // Define la clave foránea 'tipo_personal_id'
                ->references('id')  // Relaciona 'tipo_personal_id' con la columna 'id' de la tabla 'tipo_personals'
                ->on('tipo_personals')  // Especifica la tabla 'tipo_personals' para la clave foránea
                ->cascadeOnDelete();  // Habilita la eliminación en cascada cuando un registro de 'tipo_personals' es eliminado
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_academicos');
    }
};
