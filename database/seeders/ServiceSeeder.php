<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::updateOrCreate(
            ['id' => 1],
            [
            'title' => 'Services',
            'subtitle' => 'Our Services / Assessment',
            'items' => [
                [
                    'icon' => 'bx bxl-dribbble',
                    'title' => 'Aptitude Mappers',
                    'link' => ''
                ],
                [
                    'icon' => 'bx bx-file',
                    'title' => 'Achievement Mappers',
                    'link' => ''
                ],
                [
                    'icon' => 'bx bx-tachometer',
                    'title' => 'Attitude Mappers',
                    'link' => ''
                ],
                [
                    'icon' => 'bx bx-layer',
                    'title' => 'Aspiration Mappers',
                    'link' => ''
                ],
                [
                    'icon' => 'bx bx-layer',
                    'title' => 'Aggression Mappers',
                    'link' => ''
                ],
                [
                    'icon' => 'bx bx-layer',
                    'title' => 'Career Related Mappers',
                    'link' => ''
                ],
                [
                    'icon' => 'bx bx-layer',
                    'title' => 'Educational Mappers',
                    'link' => ''
                ],
                [
                    'icon' => 'bx bx-layer',
                    'title' => 'All Test Here',
                    'link' => '#'
                ],
            ],
            'is_active' => true,
            ]
        );
    }
}