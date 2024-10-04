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
            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');
            $table->enum('estado', config('constants.PERSONAL_ACADEMICO_ESTADOS'));
            $table->string('tipo_personal');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        }); 
        DB::statement("ALTER TABLE personal_academico_logs ADD CONSTRAINT email_format CHECK (email ~* '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$')");       
        DB::statement("ALTER TABLE personal_academico_logs ADD CONSTRAINT phone_format CHECK ( telefono ~* '^\+591\d{8}$')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_academico_logs');
    }
};
