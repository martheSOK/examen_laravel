<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         //Produit::factory()->count(20)->create();
         $this->call(UserSeeder::class);
         $this->call(CommandeSeeder::class);
        // $this->call(LigneCommandeSeeder::class);
    }
}
