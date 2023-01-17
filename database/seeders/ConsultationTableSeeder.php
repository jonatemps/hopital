<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ConsultationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i <170 ; $i++) {
            Consultation::create([
                'id_patient' => rand(2,121),
                'id_medecin' => rand(1,11),
                'observation' => $faker->paragraph,
                'poids' => rand(40,140),
            ]);
        }
    }
}
