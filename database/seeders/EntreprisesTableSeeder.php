<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EntreprisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Factory::create('fr_FR');

        for ($i=1; $i <= 10; $i++) {
           Entreprise::create([
               'nomComplet'=> $faker->company,
               'sigle'=> $faker->companySuffix
           ]);
        }
    }
}
