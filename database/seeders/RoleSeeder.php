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
        //create 3 roles: admin, user, and seller
        Role::factory()->create(['name' => 'admin', 'description' => 'Administrator']);
        Role::factory()->create(['name' => 'user', 'description' => 'Regular user']);
        Role::factory()->create(['name' => 'seller', 'description' => 'Seller']);
    }
}
