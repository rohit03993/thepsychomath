<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestPage;
use Illuminate\Support\Str;

class TestPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testPages = [
            [
                'title' => 'Aptitude Mappers',
                'slug' => 'aptitude-mappers',
                'category' => 'aptitude',
                'short_description' => 'Discover your natural abilities and potential through comprehensive aptitude assessment',
                'content' => 'Aptitude Mappers is a comprehensive psychometric assessment designed to identify your natural abilities, strengths, and potential career paths. This scientifically validated test evaluates multiple dimensions of your cognitive abilities, helping you understand where your talents lie and which career fields align best with your innate capabilities.

Our Aptitude Mappers test assesses various cognitive domains including logical reasoning, numerical ability, verbal comprehension, spatial awareness, and abstract thinking. The results provide detailed insights into your intellectual strengths, helping you make informed decisions about your educational and career choices.

Whether you\'re a student exploring career options, a professional considering a career change, or an educator guiding students, Aptitude Mappers offers valuable insights that can shape your future path.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Comprehensive assessment of multiple cognitive abilities',
                    'Scientifically validated and reliable results',
                    'Detailed personalized report with career recommendations',
                    'Expert interpretation and guidance',
                    'Compatible with NEP 2020 guidelines',
                    'Available in multiple languages'
                ],
                'test_details' => [
                    'Duration' => '90-120 minutes',
                    'Questions' => '150 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi, Regional languages'
                ],
                'who_can_take' => 'This test is ideal for students in Class 8-12, college students exploring career options, professionals considering career transitions, and anyone seeking to understand their natural abilities and potential career paths.',
                'what_you_get' => 'Upon completion, you will receive a comprehensive aptitude report including:
• Detailed analysis of your cognitive strengths
• Career recommendations based on your aptitude profile
• Educational pathway suggestions
• Personalized guidance from certified career counselors
• Follow-up consultation sessions
• Access to career resources and materials',
                'order' => 1,
                'is_active' => true,
                'meta_title' => 'Aptitude Mappers - Career Assessment Test | The Psycho Math',
                'meta_description' => 'Discover your natural abilities with Aptitude Mappers. Comprehensive psychometric assessment for career guidance. Get personalized career recommendations based on your aptitude.',
            ],
            [
                'title' => 'Achievement Mappers',
                'slug' => 'achievement-mappers',
                'category' => 'achievement',
                'short_description' => 'Evaluate your academic achievements and learning outcomes',
                'content' => 'Achievement Mappers helps assess your academic performance and learning outcomes across various subjects and domains. This assessment provides insights into your knowledge base and academic strengths, helping you understand where you excel and areas that need improvement.

The test evaluates your understanding and mastery of different subjects, providing a comprehensive view of your academic capabilities. This information is crucial for making informed decisions about subject selection, stream choices, and future educational pathways.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Subject-wise performance analysis',
                    'Learning outcome assessment',
                    'Academic strength identification',
                    'Improvement recommendations',
                    'Stream selection guidance',
                    'Educational pathway suggestions'
                ],
                'test_details' => [
                    'Duration' => '60-90 minutes',
                    'Questions' => '100 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => 'Class 8+',
                    'Language' => 'English, Hindi'
                ],
                'who_can_take' => 'Students from Class 8 onwards who want to assess their academic achievements and get guidance on subject and stream selection.',
                'what_you_get' => 'Detailed achievement report with subject-wise analysis, improvement suggestions, and personalized recommendations for academic growth.',
                'order' => 2,
                'is_active' => true,
                'meta_title' => 'Achievement Mappers - Academic Assessment | The Psycho Math',
                'meta_description' => 'Assess your academic achievements with Achievement Mappers. Get detailed performance analysis and improvement recommendations.',
            ],
            [
                'title' => 'Attitude Mappers',
                'slug' => 'attitude-mappers',
                'category' => 'psychological',
                'short_description' => 'Understand your attitude patterns and behavioral tendencies',
                'content' => 'Attitude Mappers is a comprehensive assessment designed to evaluate your attitudes, beliefs, and behavioral patterns. This psychometric test helps you understand how you perceive situations, respond to challenges, and interact with others.

Your attitude significantly influences your career choices, work performance, and overall success. This assessment provides valuable insights into your attitude patterns, helping you identify areas for personal development and growth.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Comprehensive attitude assessment',
                    'Behavioral pattern analysis',
                    'Personal development insights',
                    'Career compatibility evaluation',
                    'Professional growth recommendations'
                ],
                'test_details' => [
                    'Duration' => '45-60 minutes',
                    'Questions' => '80 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi'
                ],
                'who_can_take' => 'Students, professionals, and individuals seeking to understand their attitude patterns and improve their personal and professional development.',
                'what_you_get' => 'Detailed attitude profile report with behavioral insights, personal development recommendations, and career compatibility analysis.',
                'order' => 3,
                'is_active' => true,
                'meta_title' => 'Attitude Mappers - Attitude Assessment | The Psycho Math',
                'meta_description' => 'Understand your attitude patterns with Attitude Mappers. Get insights into your behavioral tendencies and personal development areas.',
            ],
            [
                'title' => 'Aspiration Mappers',
                'slug' => 'aspiration-mappers',
                'category' => 'career',
                'short_description' => 'Discover your career aspirations and future goals',
                'content' => 'Aspiration Mappers helps you identify and understand your career aspirations, goals, and future ambitions. This assessment evaluates what you want to achieve in your career, your motivation levels, and your vision for the future.

Understanding your aspirations is crucial for making informed career decisions. This test provides insights into your career goals, helping you align your educational choices and career path with your aspirations.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Career aspiration identification',
                    'Goal setting and planning',
                    'Motivation level assessment',
                    'Future vision mapping',
                    'Career alignment recommendations'
                ],
                'test_details' => [
                    'Duration' => '40-50 minutes',
                    'Questions' => '60 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi'
                ],
                'who_can_take' => 'Students and individuals who want to identify their career aspirations and align their goals with their career choices.',
                'what_you_get' => 'Comprehensive aspiration report with career goal mapping, motivation analysis, and personalized recommendations for achieving your aspirations.',
                'order' => 4,
                'is_active' => true,
                'meta_title' => 'Aspiration Mappers - Career Aspiration Assessment | The Psycho Math',
                'meta_description' => 'Discover your career aspirations with Aspiration Mappers. Get insights into your goals and future vision for career planning.',
            ],
            [
                'title' => 'Aggression Mappers',
                'slug' => 'aggression-mappers',
                'category' => 'psychological',
                'short_description' => 'Assess and understand aggression patterns and emotional responses',
                'content' => 'Aggression Mappers is a specialized assessment designed to evaluate aggression patterns, emotional responses, and behavioral tendencies. This test helps identify different types of aggression and provides insights into how you handle stress, conflict, and challenging situations.

Understanding your aggression patterns is important for personal development, relationship management, and career success. This assessment provides valuable insights to help you manage emotions effectively.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Aggression pattern identification',
                    'Emotional response analysis',
                    'Stress management assessment',
                    'Conflict resolution insights',
                    'Behavioral modification recommendations'
                ],
                'test_details' => [
                    'Duration' => '50-60 minutes',
                    'Questions' => '75 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi'
                ],
                'who_can_take' => 'Students and individuals who want to understand their aggression patterns and learn effective emotional management strategies.',
                'what_you_get' => 'Detailed aggression profile report with emotional analysis, stress management strategies, and behavioral modification recommendations.',
                'order' => 5,
                'is_active' => true,
                'meta_title' => 'Aggression Mappers - Aggression Assessment | The Psycho Math',
                'meta_description' => 'Assess your aggression patterns with Aggression Mappers. Get insights into emotional responses and behavioral management strategies.',
            ],
            [
                'title' => 'Career Related Mappers',
                'slug' => 'career-related-mappers',
                'category' => 'career',
                'short_description' => 'Comprehensive career assessment covering all career-related dimensions',
                'content' => 'Career Related Mappers is a comprehensive assessment that evaluates multiple dimensions related to career choice and success. This integrated test combines aptitude, interest, personality, and values assessment to provide a holistic view of your career potential.

This assessment helps you understand how different factors influence your career choices and provides comprehensive guidance for making informed career decisions aligned with your strengths, interests, and values.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Multi-dimensional career assessment',
                    'Aptitude, interest, and personality evaluation',
                    'Career compatibility analysis',
                    'Comprehensive career recommendations',
                    'Personalized career roadmap',
                    'Industry and role matching'
                ],
                'test_details' => [
                    'Duration' => '120-150 minutes',
                    'Questions' => '200+ questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi, Regional languages'
                ],
                'who_can_take' => 'Students, professionals, and career changers seeking comprehensive career guidance and assessment.',
                'what_you_get' => 'Comprehensive career assessment report with multi-dimensional analysis, career recommendations, industry matching, and personalized career roadmap.',
                'order' => 6,
                'is_active' => true,
                'meta_title' => 'Career Related Mappers - Comprehensive Career Assessment | The Psycho Math',
                'meta_description' => 'Get comprehensive career assessment with Career Related Mappers. Multi-dimensional evaluation for informed career decisions.',
            ],
            [
                'title' => 'Educational Mappers',
                'slug' => 'educational-mappers',
                'category' => 'educational',
                'short_description' => 'Assess educational preferences and learning styles',
                'content' => 'Educational Mappers evaluates your educational preferences, learning styles, and academic inclinations. This assessment helps identify the best educational pathways, subjects, and learning methods that suit your individual style and preferences.

Understanding your educational preferences is crucial for making informed decisions about subject selection, stream choices, and educational institutions. This test provides valuable insights to guide your educational journey.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Learning style identification',
                    'Educational preference assessment',
                    'Subject compatibility analysis',
                    'Stream selection guidance',
                    'Institution type recommendations',
                    'Study method suggestions'
                ],
                'test_details' => [
                    'Duration' => '60-75 minutes',
                    'Questions' => '90 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => 'Class 8-12',
                    'Language' => 'English, Hindi'
                ],
                'who_can_take' => 'Students in Class 8-12 who need guidance on subject selection, stream choices, and educational pathways.',
                'what_you_get' => 'Educational preference report with learning style analysis, subject recommendations, stream guidance, and personalized educational pathway suggestions.',
                'order' => 7,
                'is_active' => true,
                'meta_title' => 'Educational Mappers - Educational Assessment | The Psycho Math',
                'meta_description' => 'Assess your educational preferences with Educational Mappers. Get guidance on subject selection and educational pathways.',
            ],
            [
                'title' => 'Frustration and Aggression Mappers',
                'slug' => 'frustration-aggression-mappers',
                'category' => 'psychological',
                'short_description' => 'Understand frustration levels and aggression responses',
                'content' => 'Frustration and Aggression Mappers is a specialized assessment that evaluates how you handle frustration and respond to challenging situations. This test identifies your frustration tolerance levels and aggression patterns, providing insights into emotional management and stress coping mechanisms.

Understanding your frustration and aggression patterns is essential for personal development, relationship management, and professional success. This assessment helps you develop better coping strategies and emotional regulation skills.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Frustration tolerance assessment',
                    'Aggression pattern identification',
                    'Emotional regulation evaluation',
                    'Stress coping mechanism analysis',
                    'Behavioral modification strategies',
                    'Conflict resolution insights'
                ],
                'test_details' => [
                    'Duration' => '55-65 minutes',
                    'Questions' => '85 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi'
                ],
                'who_can_take' => 'Students and individuals who want to understand their frustration and aggression patterns and develop better emotional management skills.',
                'what_you_get' => 'Comprehensive frustration and aggression profile with emotional analysis, coping strategies, and behavioral modification recommendations.',
                'order' => 8,
                'is_active' => true,
                'meta_title' => 'Frustration and Aggression Mappers - Emotional Assessment | The Psycho Math',
                'meta_description' => 'Assess frustration and aggression patterns with our specialized mapper. Get insights into emotional management and coping strategies.',
            ],
            [
                'title' => 'Human Rights Related Mappers',
                'slug' => 'human-rights-related-mappers',
                'category' => 'social',
                'short_description' => 'Assess awareness and attitudes towards human rights and social justice',
                'content' => 'Human Rights Related Mappers evaluates your awareness, understanding, and attitudes towards human rights, social justice, and equality. This assessment helps identify your level of consciousness about fundamental human rights and your commitment to social justice principles.

Understanding your perspective on human rights is important for personal development, social responsibility, and career choices in fields related to law, social work, education, and advocacy.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Human rights awareness assessment',
                    'Social justice attitude evaluation',
                    'Equality and fairness perspective analysis',
                    'Advocacy interest identification',
                    'Social responsibility assessment'
                ],
                'test_details' => [
                    'Duration' => '45-55 minutes',
                    'Questions' => '70 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi'
                ],
                'who_can_take' => 'Students, professionals, and individuals interested in understanding their awareness and attitudes towards human rights and social justice.',
                'what_you_get' => 'Comprehensive human rights awareness report with attitude analysis, social justice perspective evaluation, and recommendations for advocacy and social responsibility.',
                'order' => 9,
                'is_active' => true,
                'meta_title' => 'Human Rights Related Mappers - Human Rights Assessment | The Psycho Math',
                'meta_description' => 'Assess your awareness and attitudes towards human rights with Human Rights Related Mappers. Get insights into social justice perspectives.',
            ],
            [
                'title' => 'Interest Mappers',
                'slug' => 'interest-mappers',
                'category' => 'career',
                'short_description' => 'Discover your interests and passions for career alignment',
                'content' => 'Interest Mappers is a comprehensive assessment designed to identify your interests, hobbies, and passions across various domains. This test helps you understand what activities, subjects, and fields genuinely interest you, which is crucial for making informed career choices.

Your interests play a vital role in career satisfaction and success. This assessment evaluates your interests across multiple areas including arts, sciences, technology, business, social work, and more, providing valuable insights for career alignment.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Multi-domain interest assessment',
                    'Interest pattern identification',
                    'Career-interest alignment analysis',
                    'Hobby and passion evaluation',
                    'Personalized interest profile',
                    'Career field recommendations based on interests'
                ],
                'test_details' => [
                    'Duration' => '50-60 minutes',
                    'Questions' => '90 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi, Regional languages'
                ],
                'who_can_take' => 'Students, professionals, and individuals seeking to identify their interests and align them with suitable career paths.',
                'what_you_get' => 'Detailed interest profile report with multi-domain analysis, interest patterns, career-interest alignment recommendations, and personalized career field suggestions.',
                'order' => 10,
                'is_active' => true,
                'meta_title' => 'Interest Mappers - Interest Assessment | The Psycho Math',
                'meta_description' => 'Discover your interests and passions with Interest Mappers. Get career recommendations aligned with your interests.',
            ],
            [
                'title' => 'Interpersonal Relations Mappers',
                'slug' => 'interpersonal-relations-mappers',
                'category' => 'psychological',
                'short_description' => 'Evaluate your interpersonal skills and relationship patterns',
                'content' => 'Interpersonal Relations Mappers assesses your ability to build and maintain relationships, communicate effectively, and interact with others. This comprehensive evaluation helps you understand your interpersonal skills, social behavior patterns, and relationship management capabilities.

Strong interpersonal skills are essential for personal and professional success. This assessment provides insights into your communication style, conflict resolution abilities, empathy levels, and social interaction patterns.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Interpersonal skills assessment',
                    'Communication style evaluation',
                    'Relationship pattern analysis',
                    'Conflict resolution ability assessment',
                    'Empathy and social awareness evaluation',
                    'Team collaboration skills analysis'
                ],
                'test_details' => [
                    'Duration' => '55-65 minutes',
                    'Questions' => '85 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi'
                ],
                'who_can_take' => 'Students, professionals, and individuals who want to understand and improve their interpersonal skills and relationship management abilities.',
                'what_you_get' => 'Comprehensive interpersonal relations profile with skills analysis, communication style evaluation, relationship pattern insights, and recommendations for improving social interactions.',
                'order' => 11,
                'is_active' => true,
                'meta_title' => 'Interpersonal Relations Mappers - Interpersonal Skills Assessment | The Psycho Math',
                'meta_description' => 'Assess your interpersonal skills with Interpersonal Relations Mappers. Get insights into relationship patterns and communication styles.',
            ],
            [
                'title' => 'Motivational Mappers',
                'slug' => 'motivational-mappers',
                'category' => 'psychological',
                'short_description' => 'Understand your motivation levels and drive factors',
                'content' => 'Motivational Mappers evaluates your motivation levels, drive factors, and what inspires you to achieve your goals. This assessment helps identify your intrinsic and extrinsic motivation sources, goal-setting patterns, and achievement orientation.

Understanding your motivation is crucial for personal development, academic success, and career growth. This test provides insights into what drives you, how you set and pursue goals, and your overall achievement motivation.',
                'hero_image' => null,
                'featured_image' => null,
                'features' => [
                    'Motivation level assessment',
                    'Intrinsic and extrinsic motivation evaluation',
                    'Goal-setting pattern analysis',
                    'Achievement orientation evaluation',
                    'Drive factor identification',
                    'Performance motivation analysis'
                ],
                'test_details' => [
                    'Duration' => '45-55 minutes',
                    'Questions' => '75 questions',
                    'Format' => 'Online/Offline',
                    'Age Group' => '14+ years',
                    'Language' => 'English, Hindi'
                ],
                'who_can_take' => 'Students, professionals, and individuals seeking to understand their motivation levels and identify factors that drive their success and achievement.',
                'what_you_get' => 'Detailed motivational profile with drive factor analysis, goal-setting pattern evaluation, achievement orientation insights, and recommendations for enhancing motivation.',
                'order' => 12,
                'is_active' => true,
                'meta_title' => 'Motivational Mappers - Motivation Assessment | The Psycho Math',
                'meta_description' => 'Understand your motivation levels with Motivational Mappers. Get insights into drive factors and achievement orientation.',
            ],
        ];

        foreach ($testPages as $testPage) {
            TestPage::updateOrCreate(
                ['slug' => $testPage['slug']],
                $testPage
            );
        }
    }
}
