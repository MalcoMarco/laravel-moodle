<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name'=>'Inactivo',    'guard_name' => 'I',    'order' => 10, 'id' => 1],
            ['name'=>'En espera',   'guard_name' => 'EE',   'order' => 20, 'id' => 2],
            ['name'=>'En revision', 'guard_name' => 'ER',   'order' => 30, 'id' => 3],
            ['name'=>'Devuelto',    'guard_name' => 'D',    'order' => 40, 'id' => 4],
            ['name'=>'Aprobado',    'guard_name' => 'A',    'order' => 50, 'id' => 5],
            ['name'=>'Rechazado',   'guard_name' => 'R',    'order' => 60, 'id' => 6],
            ['name'=>'Observado',   'guard_name' => 'OB',   'order' => 70, 'id' => 7],
        ];

        DB::table('state_types')->insert($data);
    }
}
