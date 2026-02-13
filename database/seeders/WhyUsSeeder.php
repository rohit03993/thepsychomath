<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhyUs;

class WhyUsSeeder extends Seeder
{
    public function run(): void
    {
        WhyUs::updateOrCreate(
            ['id' => 1],
            [
            'title' => 'Shaping the Career Guidance Landscape',
            'intro_text' => 'Comprehensive career guidance solutions for students, parents, educators and schools',
            'items' => [
                [
                    'number' => '01',
                    'text' => 'Enable students to identify their best-fit career with our world-class career assessment and personalised guidance.'
                ],
                [
                    'number' => '02',
                    'text' => 'Empower students to learn all about the professional world with virtual career simulations, exhaustive career library, career blogs and vlogs.'
                ],
                [
                    'number' => '03',
                    'text' => 'Pave student\'s way to their dream college with our end-to-end college application guidance, scholarship drive and corporate internship program.'
                ],
                [
                    'number' => '04',
                    'text' => 'Enable schools in creating a career guidance ecosystem in sync with the vision of New Education Policy.'
                ],
                [
                    'number' => '05',
                    'text' => 'Empower educators to become International Certified Career Coaches and build a career in career guidance & counselling.'
                ],
                [
                    'number' => '06',
                    'text' => 'Revolutionary assessment platform and technology driven career guidance solutions for educators to boost their career guidance & counselling practice.'
                ],
            ],
            'conclusion_text' => 'Personalized, expert services & support for all stakeholders in the career guidance process.',
            'is_active' => true,
            ]
        );
    }
}