<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        Feature::updateOrCreate(
            ['id' => 1],
            [
            'title' => 'Features',
            'subtitle' => null,
            'items' => [
                [
                    'icon' => 'bx bx-receipt',
                    'title' => 'Advanced Assessment',
                    'description' => 'Learn about your strengths and interests with our assessment and stream report.'
                ],
                [
                    'icon' => 'bx bx-cube-alt',
                    'title' => 'Interactive Career & Stream Activities',
                    'description' => 'Evaluate your academics, work style, aptitude and subject compatibility to identify your perfect stream.'
                ],
                [
                    'icon' => 'bx bx-images',
                    'title' => 'Simulated Virtual Career Internships',
                    'description' => 'Explore multiple career options through role play, simulations and experiential videos with our Virtual Internship Program'
                ],
                [
                    'icon' => 'bx bx-shield',
                    'title' => 'Personalised Guidance from Experts',
                    'description' => 'Finalise your stream and subjects and build a customised career plan with help from our career experts.'
                ],
            ],
            'is_active' => true,
            ]
        );
    }
}