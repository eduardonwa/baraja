<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            ['name' => 'Instagram', 'slug' => 'instagram'],
            ['name' => 'Facebook', 'slug' => 'facebook'],
            ['name' => 'TikTok', 'slug' => 'tiktok'],
            ['name' => 'YouTube', 'slug' => 'youtube'],
            ['name' => 'X', 'slug' => 'x'],
            ['name' => 'Threads', 'slug' => 'threads'],
            ['name' => 'LinkedIn', 'slug' => 'linkedin'],
            ['name' => 'Other', 'slug' => 'other'],
        ];

        foreach ($platforms as $platform) {
            Platform::firstOrCreate(
                ['slug' => $platform['slug']],
                ['name' => $platform['name']]
            );
        }
    }
}
