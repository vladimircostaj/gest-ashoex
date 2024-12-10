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
        Schema::create('aula', function (Blueprint $table) {
            $table->id('id_aula');
            $table->string('numero_aula', 30);
            $table->integer('capacidad')->nullable();
            $table->boolean('habilitada')->default(true);            
            $table->foreignId('id_edificio')->constrained('edificio', 'id_edificio')->onDelete('cascade');
            $table->integer('ubicacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aula');
    }
};
