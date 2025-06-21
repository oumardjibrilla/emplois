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

        Role::factory()->create([
            'nom_role' => 'Admin',
           ]);


        /* User::factory()->create([
            'nom' => 'Test User',
            'prenom' => 'Test',
            'ville' => 'Test City',
            'adresse' => '123 Test Street',
            'telephone' => '1234567890',
            'email' => 'test@example.com',
            'role_id' => 1,
            'photo' => 'default.jpg',
            'cv' => 'default-cv.pdf',
            'nom-entreprise' => 'Test Company',
            'taille-entreprise' => 'Small',
            'fonction-entreprise' => 'Developer',
        ]); */
    }
}
