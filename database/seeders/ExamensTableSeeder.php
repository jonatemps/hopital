<?php

namespace Database\Seeders;

use App\Models\Examen;
use Illuminate\Database\Seeder;

class ExamensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TYPE SANG

        Examen::create([
            'id_type' => 1,
            'nom' => 'HB',
            'unite' => '......G/dl......11-16',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'Hcl',
            'unite' => '%      5-50',
            'tarif' => rand(4,8),
        ]);
        Examen::create([
            'id_type' => 1,
            'nom' => 'GR',
            'unite' => '......nm3     4-6.OOO-000',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'GE',
            'unite' => '...........',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'GB',
            'unite' => '......nm3     4-10.OOO',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'FL',
            'unite' => '.....N.....F.....M.....E.....B',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'VS',
            'unite' => 'mm H-20/40',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'GF',
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'TS',
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'TC',
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'GS',
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => "Test d'EMMEL",
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'Electrophorese',
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 1,
            'nom' => 'Autre',
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        // TYPE URINES


        Examen::create([
            'id_type' => 2,
            'nom' => 'Autre',
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 2,
            'nom' => 'Autre',
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 2,
            'nom' => 'CE',
            'unite' => '.....Présents',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 2,
            'nom' => 'GR',
            'unite' => 'O/CH',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 2,
            'nom' => 'Autres',
            'unite' => '............',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 2,
            'nom' => 'Albimine',
            'unite' => '..........0',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 2,
            'nom' => 'Sucre',
            'unite' => '.........0',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 2,
            'nom' => 'Test de grossesse',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 2,
            'nom' => 'Gram',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        // TYPE SELLES

        Examen::create([
            'id_type' => 3,
            'nom' => 'Direct',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 3,
            'nom' => 'Aspect',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 3,
            'nom' => 'Selle Enrichissement',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        // TYPE CRACHAT

        Examen::create([
            'id_type' => 4,
            'nom' => 'Gram',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 4,
            'nom' => 'Ziehl',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        // TYPE BACTERIOLOGIE

        Examen::create([
            'id_type' => 5,
            'nom' => 'Gram',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 5,
            'nom' => 'Culture',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 5,
            'nom' => 'Autres',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);


        // TYPE SEROLOGIE

        Examen::create([
            'id_type' => 5,
            'nom' => 'Widal TO',
            'unite' => '.........TH.........',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 5,
            'nom' => 'Wedal II',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 5,
            'nom' => 'Autres',
            'unite' => '.........',
            'tarif' => rand(4,8),
        ]);


        // TYPE BIOCHIMIE

        Examen::create([
            'id_type' => 6,
            'nom' => 'Glycémie',
            'unite' => '.........7O-11O mg %',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 6,
            'nom' => 'Urée',
            'unite' => '.....2,5-7,5 mmol/l',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 6,
            'nom' => 'Créatinine',
            'unite' => '.....62-120 Umol/l',
            'tarif' => rand(4,8),
        ]);

        Examen::create([
            'id_type' => 6,
            'nom' => 'Créatinine',
            'unite' => '.....62-100 Umol/l',
            'tarif' => rand(4,8),
        ]);
        Examen::create([
            'id_type' => 6,
            'nom' => 'Protéine totale',
            'unite' => '.....62 8 0 g/l',
            'tarif' => rand(4,8),
        ]);
        Examen::create([
            'id_type' => 6,
            'nom' => 'Alumine',
            'unite' => '.....55 0-78 0 Umol/l',
            'tarif' => rand(4,8),
        ]);
        Examen::create([
            'id_type' => 6,
            'nom' => 'Bilirubine BT',
            'unite' => '......BD......BI.....',
            'tarif' => rand(4,8),
        ]);
        Examen::create([
            'id_type' => 6,
            'nom' => 'Créatinine',
            'unite' => '.....62-100 Umol/l',
            'tarif' => rand(4,8),
        ]);

    }
}
