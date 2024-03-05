<?php

namespace Database\Seeders;

use App\Models\ForumGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create 3 forum groups: general, news, and announcements
        ForumGroup::factory()->create(['name' => 'general', 'description' => 'General discussion']);
        ForumGroup::factory()->create(['name' => 'news', 'description' => 'News']);
        ForumGroup::factory()->create(['name' => 'announcements', 'description' => 'Announcements']);
    }
}
