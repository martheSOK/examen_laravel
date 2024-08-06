<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $vendeur1=User::create([
        'name' =>"vendeur 1",
        'email' =>"vendeur1@gmail.com",
        'password'=>Hash::make("12345678"),
        ]);

        $vendeur2=User::create([
            'name' =>"vendeur 1",
            'email' =>"vendeur2@gmail.com",
            'password'=>Hash::make("12345678"),
            ]);

        $cm1=Commande::create([
        'client' =>"tamba",
        'vendeur_id' =>$vendeur1->id,
        ]);

        LigneCommande::create([
        'quantite' => 2,
        'produit_id' => 1,
        'commande_id' => $cm1->id,
        ]);

        LigneCommande::create([
            'quantite' => 1,
            'produit_id' => 3,
            'commande_id' => $cm1->id,
        ]);

        LigneCommande::create([
            'quantite' => 4,
            'produit_id' => 2,
            'commande_id' => $cm1->id,
        ]);



        $cm2=Commande::create([
            'client' => "john",
            'vendeur_id' => $vendeur2->id,
            ]);
    }
}
