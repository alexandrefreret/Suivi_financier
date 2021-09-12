<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PaiementsMethodeSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paiements_methode')->insert([
            'paiementsmethode_label' => 'Chèque',
            'paiementsmethode_code' => 'CH',
        ]);
		
        DB::table('paiements_methode')->insert([
            'paiementsmethode_label' => 'Espèces',
            'paiementsmethode_code' => 'ES',
		]);

        DB::table('paiements_methode')->insert([
            'paiementsmethode_label' => 'Carte bleue',
            'paiementsmethode_code' => 'CB',
        ]);
    }
}