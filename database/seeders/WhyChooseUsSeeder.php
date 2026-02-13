<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhyChooseUs;

class WhyChooseUsSeeder extends Seeder
{
    public function run(): void
    {
        WhyChooseUs::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Why Choose Us',
                'paragraph_1' => "At THE PSYCHO MATH, we are dedicated to providing structured career counseling services tailored specifically for underprivileged students and those in government schools across the state—ensuring they receive the same opportunities as their peers in private institutions. Our scientifically designed psychometric tests assess students' aptitudes, interests, and skills, delivering personalized career guidance aligned with the National Education Policy (NEP) 2020. By integrating psychometric analysis with skill development, we bridge the gap between education and career readiness, empowering students to make informed decisions about their future. Our mission is to ensure that every student, regardless of their background, has access to the right guidance and opportunities to build a successful and fulfilling career.",
                'paragraph_2' => "At The Psycho Math, we are honored to support the children of martyrs from all three Indian Armed Forces by providing free* career counseling services. Our approach is rooted in scientifically designed psychometric tests that assess students' aptitudes, interests, and skills, ensuring personalized career guidance aligned with the *National Education Policy (NEP) 2020. By integrating psychometric analysis with *skill development, we empower these students to make well-informed career choices that align with their strengths and aspirations. Additionally, we prioritize *mental health care*, offering emotional support to help them navigate their future with confidence and resilience. Our mission is to honor the sacrifices of our brave soldiers by equipping their children with the right guidance, opportunities, and well-being to build a successful and fulfilling future.",
                'is_active' => true,
            ]
        );
    }
}