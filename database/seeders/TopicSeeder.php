<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = ['Back end', 'Front end', 'Mobile Application'];
        foreach ($topics as $topic) {
            Topic::create([
                'name' => $topic
            ]);
        }
    }
}