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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materia_id');
            $table->Integer('nro_grupo');
            $table->timestamps();

            $table->unique(['materia_id', 'nro_grupo']);

            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
           
        });
        DB::statement('ALTER TABLE grupos ADD CONSTRAINT grupoMayorCero CHECK (nro_grupo >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
