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
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Crea una columna 'id' con clave primaria auto-incremental
            $table->string('name');  // Crea una columna 'name' de tipo string para almacenar el nombre del usuario
            $table->string('email')->unique();  // Crea una columna 'email' de tipo string y la hace única, para evitar duplicados
            $table->timestamp('email_verified_at')->nullable();  // Crea una columna 'email_verified_at' de tipo timestamp, que puede ser nula
            $table->string('password');  // Crea una columna 'password' de tipo string para almacenar la contraseña del usuario 
            $table->rememberToken();  // Crea una columna para almacenar el token de "recordarme" de Laravel
            $table->timestamps();  
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Crea una columna 'email' de tipo string como clave primaria para almacenar los correos de los usuarios que solicitan restablecer su contraseña
            $table->string('token');  // Crea una columna 'token' de tipo string para almacenar el token de restablecimiento de contraseña
            $table->timestamp('created_at')->nullable();  // Crea una columna 'created_at' para almacenar la fecha y hora de creación del token
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Crea una columna 'id' de tipo string como clave primaria para la sesión
            $table->foreignId('user_id')->nullable()->index();  // Crea una columna 'user_id' como clave externa para vincular la sesión a un usuario
            $table->string('ip_address', 45)->nullable();  // Crea una columna 'ip_address' de tipo string con un máximo de 45 caracteres, para almacenar la IP del usuario
            $table->text('user_agent')->nullable();  // Crea una columna 'user_agent' de tipo texto para almacenar el agente de usuario
            $table->longText('payload');  // Crea una columna 'payload' de tipo longText para almacenar los datos de la sesión
            $table->integer('last_activity')->index(); // Crea una columna 'last_activity' de tipo integer e indexada, para almacenar el tiempo de la última actividad
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');  // Elimina la tabla 'users' si existe
        Schema::dropIfExists('password_reset_tokens');   // Elimina la tabla 'password_reset_tokens' si existe
        Schema::dropIfExists('sessions');   // Elimina la tabla 'sessions' si existe
    }
};
