<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        MenuItem::truncate();

        $items = [
            ['title' => 'Home', 'link' => '#hero', 'type' => 'scroll', 'order' => 1],
            ['title' => 'About us', 'link' => '#about', 'type' => 'scroll', 'order' => 2],
            ['title' => 'Why Choose Us', 'link' => '#why-choose-us', 'type' => 'scroll', 'order' => 3],
            ['title' => 'All Test', 'link' => null, 'type' => 'dropdown', 'order' => 4],
            ['title' => 'Careers', 'link' => null, 'type' => 'dropdown', 'order' => 5],
            ['title' => 'Team', 'link' => '#team', 'type' => 'scroll', 'order' => 6],
            ['title' => 'Contact', 'link' => '#contact', 'type' => 'scroll', 'order' => 7],
        ];

        foreach ($items as $item) {
            MenuItem::create([
                'title' => $item['title'],
                'link' => $item['link'],
                'type' => $item['type'],
                'order' => $item['order'],
                'parent_id' => null,
                'icon' => null,
                'is_active' => true,
            ]);
        }
    }
}
