<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'postnom' => $faker->firstName,
                'prenom' => $faker->lastName,
                'sexe' => $faker->randomElement(array('M', 'F')),
                'adresse' => $faker->address,
                'spécialité' => $faker->randomElement(array('Chirurgien', 'Ophtamologue', 'Pédiatre', 'Dentiste', 'Radiologue', 'Génecologue')),
                'email' => "John$i@doe.com",
                'password' => bcrypt('password'),
                // 'permissions' => ["platform.index" => "1", "platform.systems.roles" => "0", "platform.systems.users" => "0", "platform.systems.attachment" => "0"],
            ]);
        }
    }
}
