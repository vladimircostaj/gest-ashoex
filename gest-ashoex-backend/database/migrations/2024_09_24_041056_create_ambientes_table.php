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
        Schema::create('ambiente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_ambiente')->unique();
            $table->integer('capacidad');
            $table->boolean('habilitada');
            
            $table->unsignedBigInteger('ubicacion_id'); 
            $table->foreign('ubicacion_id')
                ->references('id')->on('ubicacion') 
          ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambiente');
    }
};
