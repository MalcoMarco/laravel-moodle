<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class SilabusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=SilabusSeeder
     * 
     */
    public function run(): void
    {
        $faker = Faker::create();
        $data = [];

        for ($i=0; $i < 120; $i++) { 
            array_push($data,[
                'mdl_user_id' => 3,
                'state_type_id' => 3,
                'curso_name' => $faker->name,
                'escuela' => $faker->company,
                'ciclo' => $faker->randomElement(['I', 'II','III','IV','V','VI','VII']),
                'creditos' => 5,
                'pdf_path' => '#',
                'pdf_url' => '#',
            ]);
        }

        DB::table('silabus')->insert($data);
    }
}
