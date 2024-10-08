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
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono'); 
            $table->enum('estado', config('constants.PERSONAL_ACADEMICO_ESTADOS'))->default(config('constants.PERSONAL_ACADEMICO_ESTADOS')[0]);

            $table->unsignedInteger('tipo_personal_id'); 

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('tipo_personal_id')
                ->references('id')
                ->on('tipo_personals')
                ->cascadeOnDelete();

        }); 
        DB::statement("ALTER TABLE personal_academicos ADD CONSTRAINT email_format CHECK (email ~* '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$')");        
        DB::statement("ALTER TABLE personal_academicos ADD CONSTRAINT phone_format CHECK ( telefono ~* '^\+591\d{8}$')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_academicos');
    }
};
