<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materias = [
            // Ingeniería en Sistemas
            ['nombre' => 'Ingles I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Fisica General', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Algebra I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Introduccion a la Programacion', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Elem. de Programacion y Estr. de Datos', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Taller de Ingenieria de Software', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Gestion de Calidad de Software', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Proyecto Final', 'tipo' => 'taller de titulacion', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Generacion de Software', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Ingenieria Economica', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 3],
            //Ingenieria Industrial
            ['nombre' => 'Quimica General', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Fisica Basica I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Algebra I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Calculo I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Computacion I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Industria Lacteas', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Gestion y Calidad Ambiental', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Mantenimiento Industrial', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Practica Empresarial', 'tipo' => 'taller de titulacion', 'nro_PeriodoAcademico' => 1],
            ['nombre' => 'Taller Tesis II', 'tipo' => 'taller de titulacion', 'nro_PeriodoAcademico' => 3],
            //Biologia
            ['nombre' => 'Ingles', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Quimica General', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Biologia General', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 4],
            ['nombre' => 'Biologia Celular y Molecular', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Biofisica', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Tesis', 'tipo' => 'taller de titulacion', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Taxonomia Vegetal', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Sistematica de Mamiferos', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Bioestadistica II', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Inmunoparasitologia', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 2],
            //Informatica
            ['nombre' => 'Ingles I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Fisica General', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Algebra I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Logica', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Introduccion a la Programacion', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Elem. de Programacion y Estr. de Datos', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],            
            ['nombre' => 'Taller de Progamacion de Bajo Nivel', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Taller de Grado II', 'tipo' => 'taller de titulacion', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Generacion de Software', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Web Semanticas', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 2],
            //Lic en Matematicas
            ['nombre' => 'Ingles I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Geometria', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Algebra I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Calculo I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Teoria Axiomatica de Conjuntos', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Analisis Funcional', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Algebra Lineal Avanzada', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
            ['nombre' => 'Modelaje y Simulacion', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Optimizacion', 'tipo' => 'electiva', 'nro_PeriodoAcademico' => 3],
            ['nombre' => 'Trabajo de Grado', 'tipo' => 'taller de titulacion', 'nro_PeriodoAcademico' => 2],    
        ];

        
        DB::table('materias')->insert($materias);
    }
}
