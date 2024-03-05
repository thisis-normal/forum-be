<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            LnkUserRoleSeeder::class,
            ForumGroupSeeder::class,
            ForumSeeder::class,
            PrefixSeeder::class,
            ThreadSeeder::class,
            PostSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
