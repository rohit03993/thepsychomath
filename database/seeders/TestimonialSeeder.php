<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Harshit Gupta',
                'designation' => 'Student',
                'testimonial' => "I got a chance to recieve career counselling from Shruti Ma'am. She created a comfortable environment where I could openly discuss my goals and concerns. Her attentive listening and tailored guidance helped me gain clarity. The personality tests she used were accurate and provided valuable insights. With her expertise, she explored various career paths and provided relevant information. Shruti Ma'am's dedication, ongoing support, and valuable resources have been invaluable. I highly recommend her services for anyone seeking professional guidance.",
                'image' => 'https://i.pravatar.cc/150?img=1',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Swati Rai',
                'designation' => 'Student',
                'testimonial' => "I am a humanities student and always used to listen from my family and relatives that I have made big mistake and would do nothing after opting Humanities but after meeting Shruti Ma'am who is the best career counselor in our city Agra, my perception and confidence level changed. I am not praising her as I am doing her advertising, rather I am writing all this because I don't want people like me should be fooled by paying a huge amount and getting nothing to the people around who calls them counselors and practically they are only scorching money from people like us, So I want maximum people to know about 'The Psycho Math' so that people should get the right guidance and it will be helpful for the crucial decisions in their life.",
                'image' => 'https://i.pravatar.cc/150?img=5',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Atharv Shah',
                'designation' => 'Student',
                'testimonial' => "Choosing career is one of the most important phase of life because it shapes the further life accordingly. When I was facing this same dilemma of what to choose next, there comes Shruti ma'am as the saviour. She possesses all the qualities that a good counselor should have. She first understood everything about my academic and personal background and listened to my career ambitions and goals very attentively and thereafter provided me a holistic overview of what can be the logical steps that can be taken further. Her broad knowledge about different career paths and logical connectivity of career option as per the profile is marvelous which I felt during my counseling sessions.The tests conducted were very interesting and gave almost accurate conclusions regarding my aptitude, interest attitude and personality. I must say that after giving the test and getting the detailed analytical reports, I came to know my true potential.I highly appreciate and recommend Shruti ma'am for anyone who is looking for holistic career guidance.",
                'image' => 'https://i.pravatar.cc/150?img=12',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Ankit Singh',
                'designation' => 'Student',
                'testimonial' => "The Psycho Math is a great platform for students like me who are unsure of their career prospects in life.Shruti ma'am helped me in deciding the future path by providing me the steps required for my growth.She guided me through all the choices giving me help wherever needed . She provided instant on-demand counselling which helped in better understanding . The Psycho Math provides the best career options to choose from according to the elegibility , capability and potential of the unique individual with the help of counselors across the country. 'The Psycho Math' helps in connecting with the best college by giving all details that matched my interests and needs of the future. I found the Psychometric tests conducted by them have been scientifically designed and formulated by utilizing reliable and valid measures for accurate test results customized in a unique manner for each one of the talents.Thus, they have proved very helpful to me. I'll always be thankful to The Psycho Math",
                'image' => 'https://i.pravatar.cc/150?img=20',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::firstOrCreate(
                ['name' => $testimonialData['name']],
                $testimonialData
            );
        }
    }
}