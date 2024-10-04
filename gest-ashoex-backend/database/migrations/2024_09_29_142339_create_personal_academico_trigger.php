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
        // trigger para creacion
        DB::unprepared('
            CREATE OR REPLACE FUNCTION log_personal_academico_create() 
            RETURNS TRIGGER AS $$ 
            DECLARE 
                v_tipo_personal varchar(255); 
            BEGIN

                SELECT 
                    nombre
                INTO 
                    v_tipo_personal
                FROM 
                    tipo_personals
                WHERE 
                    id = NEW.tipo_personal_id;

                INSERT INTO personal_academico_logs (
                        nombre,
                        email,
                        telefono, 
                        estado, 
                        tipo_personal
                    )
                VALUES (
                        NEW.nombre, 
                        NEW.email, 
                        NEW.telefono, 
                        NEW.estado,
                        v_tipo_personal
                    );
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER log_personal_academico_create
            AFTER INSERT ON personal_academicos
            FOR EACH ROW 
            EXECUTE FUNCTION log_personal_academico_create();
        ');

        // trigger para modificacion
        DB::unprepared('
            CREATE OR REPLACE FUNCTION log_personal_academico_update() 
            RETURNS TRIGGER AS $$ 
            DECLARE 
                v_tipo_personal varchar(255); 
            BEGIN

                SELECT 
                    nombre
                INTO 
                    v_tipo_personal
                FROM 
                    tipo_personals
                WHERE 
                    id = NEW.tipo_personal_id;

                INSERT INTO personal_academico_logs (
                        nombre,
                        email,
                        telefono, 
                        estado, 
                        tipo_personal
                    )
                VALUES (
                        NEW.nombre, 
                        NEW.email, 
                        NEW.telefono, 
                        NEW.estado,
                        v_tipo_personal
                    );
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER log_personal_academico_update
            AFTER UPDATE ON personal_academicos
            FOR EACH ROW 
            EXECUTE FUNCTION log_personal_academico_update();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::unprepared('
                drop trigger if exists log_personal_academico_create
            ');
        Schema::unprepared('
                drop trigger if exists log_personal_academico_update
            ');
    }
};
