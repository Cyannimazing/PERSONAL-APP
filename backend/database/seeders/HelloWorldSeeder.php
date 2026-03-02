<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        Application::updateOrCreate([
            'slug' => 'hello-world'
        ], [
            'name' => 'Hello World',
            'description' => 'Sample Hello World app for rental demo.',
            'icon' => 'sparkles',
            'price' => 0.00,
        ]);
    }
}
