<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SilabusReqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name'=>'Información general (de identificación del curso y el/los docente/s)',     'orden' => 10],
            ['name'=>'Introducción (sumilla que describe el curso y su lugar en el plan de estudios)',    'orden' => 20],
            ['name'=>'Logro aprendizaje final de la asignatura',  'orden' => 30],
            ['name'=>'Unidades de aprendizaje',     'orden' => 40],
            ['name'=>'Estrategias didácticas',     'orden' => 50],
            ['name'=>'Sistema de evaluación',    'orden' => 60],
            ['name'=>'Cronograma referencial de actividades',    'orden' => 70],
            ['name'=>'Bibliografía y otras fuentes a usar en el desarrollo del curso',    'orden' => 80],
        ];

        DB::table('silabu_reqs')->insert($data);
    }
}
