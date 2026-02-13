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
            ['title' => 'Test', 'link' => null, 'type' => 'dropdown', 'order' => 4],
            ['title' => 'Careers', 'link' => null, 'type' => 'dropdown', 'order' => 5],
            ['title' => 'Team', 'link' => '#team', 'type' => 'scroll', 'order' => 6],
            ['title' => 'Contact', 'link' => '#contact', 'type' => 'scroll', 'order' => 7],
        ];

        $parentIds = [];
        foreach ($items as $item) {
            $menuItem = MenuItem::create([
                'title' => $item['title'],
                'link' => $item['link'],
                'type' => $item['type'],
                'order' => $item['order'],
                'parent_id' => null,
                'icon' => null,
                'is_active' => true,
            ]);
            $parentIds[$item['title']] = $menuItem->id;
        }

        // Add submenu items for "Test"
        $testSubItems = [
            ['title' => 'Psychological Test', 'link' => '/tests', 'type' => 'link', 'order' => 1, 'parent_title' => 'Test'],
            ['title' => 'Aptitude Test', 'link' => 'https://careermapper.in/tests', 'type' => 'link', 'order' => 2, 'parent_title' => 'Test'],
        ];

        foreach ($testSubItems as $subItem) {
            MenuItem::create([
                'title' => $subItem['title'],
                'link' => $subItem['link'],
                'type' => $subItem['type'],
                'order' => $subItem['order'],
                'parent_id' => $parentIds[$subItem['parent_title']],
                'icon' => null,
                'is_active' => true,
            ]);
        }
    }
}
