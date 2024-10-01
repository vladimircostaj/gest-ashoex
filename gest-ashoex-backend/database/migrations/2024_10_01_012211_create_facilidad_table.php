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
        Schema::create('facilidad', function (Blueprint $table) {
            $table->id('id_facilidad');
            $table->string('nombre_facilidad', 100);
            $table->foreignId('id_aula')->constrained('aula', 'id_aula')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilidad');
    }
};
