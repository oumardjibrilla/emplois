<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'nom_role' => 'candidat'
        ]);
        Role::create([
            'nom_role' => 'recruteur'
        ]);
        Role::create([
            'nom_role' => 'admin'
        ]);
        Role::create([
            'nom_role' => 'charger_client'
        ]);
        Role::create([
            'nom_role' => 'charger_marketing'
        ]);
    }
}
