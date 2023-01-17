<?php

namespace Database\Seeders;

use App\Models\TypeExamen;
use Illuminate\Database\Seeder;

class Type_examensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeExamen::create([
            'nom' => 'SANG',
            'detail' => 'Infections detecter dans le sang'
        ]);
        TypeExamen::create([
            'nom' => 'URINES',
            'detail' => 'Infections detecter dans les urines'
        ]);TypeExamen::create([
            'nom' => 'SELLES',
            'detail' => 'Infections detecter dans le selles'
        ]);TypeExamen::create([
            'nom' => 'CRACHAT',
            'detail' => 'Infections detecter dans le crachat'
        ]);TypeExamen::create([
            'nom' => 'BACTERIOLOGIE',
            'detail' => 'Detection des bacteries'
        ]);TypeExamen::create([
            'nom' => 'SEROLIGIE',
            'detail' => 'Examen du sérum sanguin'
        ]);TypeExamen::create([
            'nom' => 'BIOCHIMIE',
            'detail' => 'Etude de la structure et de la conformation des molécules du vivant...'
        ]);TypeExamen::create([
            'nom' => 'AUTRES',
            'detail' => 'Les autres types non cités'
        ]);
    }
}
