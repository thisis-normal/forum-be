<?php

namespace Database\Seeders;

use App\Models\Prefix;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //make 6 prefixes
        Prefix::factory()->create(['name' => 'Question', 'description' => 'Question', 'color' => '#000000']);
        Prefix::factory()->create(['name' => 'Discussion', 'description' => 'Discussion', 'color' => '#000000']);
        Prefix::factory()->create(['name' => 'Announcement', 'description' => 'Announcement', 'color' => '#000000']);
        Prefix::factory()->create(['name' => 'Showoff', 'description' => 'Showoff', 'color' => '#000000']);
        Prefix::factory()->create(['name' => 'Knowledge', 'description' => 'Knowledge', 'color' => '#000000']);
        Prefix::factory()->create(['name' => 'Sharing', 'description' => 'Sharing', 'color' => '#000000']);
    }
}
