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
        Schema::create('aula_facilidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_aula')->constrained('aula', 'id_aula')->onDelete('cascade');
            $table->foreignId('id_facilidad')->constrained('facilidad', 'id_facilidad')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aula_facilidad');
    }
};
