<?php

namespace Database\Seeders;

use App\Models\Patient;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 110; $i++) {
           Patient::create([
            'id_agent' => rand(1,14),
            'id_entreprise' => $faker->randomElement(array(null, rand(1,10))),
            'id_agent' => rand(1,3),
            'nomComplet' => $faker->name,
            'sexe' => $faker->randomElement(array('M', 'F')),
            'dateNaissance' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-1 years', $timezone = null),
            'adresse' => $faker->address,
            'telephone' => $faker->e164PhoneNumber,
            'matriculeAgent' => $faker->bankAccountNumber,
            'groupeSanguin' => $faker->randomElement(array('A+','A-','B+','B-','AB+', 'AB-','O+','O-')),
           ]);
        }
    }
}
