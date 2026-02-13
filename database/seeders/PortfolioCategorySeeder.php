<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioCategory;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'App', 'slug' => 'filter-app', 'order' => 1],
            ['name' => 'Card', 'slug' => 'filter-card', 'order' => 2],
            ['name' => 'Web', 'slug' => 'filter-web', 'order' => 3],
        ];

        foreach ($categories as $category) {
            PortfolioCategory::firstOrCreate(
                ['slug' => $category['slug']],
                array_merge($category, ['is_active' => true])
            );
        }
    }
}