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
        Schema::create('personal_academico_logs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique(); // include a regex. 
            $table->string('telefono'); // include a simple domain. 
            $table->string('estado'); // include a simple domain.
            $table->string('tipo_personal');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_academico_logs');
    }
};
