<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    public function run(): void
    {
        AboutUs::updateOrCreate(
            ['id' => 1],
            [
            'title' => 'About Us',
            'left_column_text' => 'At THE PSYCHO MATH, we are dedicated to providing structured career counseling services tailored specifically for underprivileged students and those in government schools across the state—ensuring they receive the same opportunities as their peers in private institutions.',
            'right_column_text_1' => 'Our scientifically designed psychometric tests assess students\' aptitudes, interests, and skills, delivering personalized career guidance aligned with the National Education Policy (NEP) 2020. By integrating psychometric analysis with skill development, we bridge the gap between education and career readiness, empowering students to make informed decisions about their future.',
            'right_column_text_2' => 'Our mission is to ensure that every student, regardless of their background, has access to the right guidance and opportunities to build a successful and fulfilling career.',
            'features' => [
                'Scientifically designed psychometric tests',
                'Personalized career guidance aligned with NEP 2020',
                'Integration of psychometric analysis with skill development'
            ],
            'is_active' => true,
            ]
        );
    }
}