<?php

namespace Database\Seeders;

use App\Models\Role;
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
        // User::factory(10)->create();


         User::create([
            'nom' => 'oumar',
            'prenom' => 'Djibrilla',
            'ville' => 'sale',
            'adresse' => '123 Test Street',
            'telephone' => '0774454921',
            'email' => 'oumardjibrilla19@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 3,
            'photo' => '',
            'cv' => '',
            'nom-entreprise' => 'Test Company',
            'taille-entreprise' => 'Small',
            'fonction-entreprise' => 'Developer',
        ]);
    }
}
