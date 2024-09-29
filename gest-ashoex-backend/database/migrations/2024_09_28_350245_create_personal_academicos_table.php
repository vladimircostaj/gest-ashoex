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
            $table->string('name');
            $table->string('email')->unique()->domain('/^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/');
            $table->string('telefono'); // include a simple domain. 
            $table->string('estado'); // include a simple domain.

            $table->unsignedInteger('tipo_personal_id'); 

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('tipo_personal_id')
                ->references('id')
                ->on('tipo_personals')
                ->cascadeOnDelete();
        }); 

        // add a trigger. 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_academicos');
    }
};
