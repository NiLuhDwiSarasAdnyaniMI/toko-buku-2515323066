<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = [
            ['name' => 'Erlangga', 'city' => 'Jakarta'],
            ['name' => 'Gramedia Pustaka Utama', 'city' => 'Jakarta'],
            ['name' => 'Mizan', 'city' => 'Bandung'],
        ];

        foreach ($publishers as $publisher) {
            Publisher::firstOrCreate(
                ['name' => $publisher['name']],
                ['city' => $publisher['city']]
            );
        }
    }
}