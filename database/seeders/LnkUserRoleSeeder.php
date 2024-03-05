<?php

namespace Database\Seeders;

use App\Models\LnkUserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LnkUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LnkUserRole::factory()->create(['user_id' => 1, 'role_id' => 1]);
        LnkUserRole::factory()->count(10)
            ->create();
    }
}
