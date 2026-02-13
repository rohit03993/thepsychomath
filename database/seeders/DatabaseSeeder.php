<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * 
     * This seeder runs all seeders in the correct order to populate the database
     * with initial data. All seeders use firstOrCreate/updateOrCreate to prevent
     * duplicates when running multiple times.
     * 
     * Run with: php artisan db:seed
     */
    public function run(): void
    {
        $this->call([
            // 1. Core System Data (must be first)
            AdminUserSeeder::class,              // Admin user for login
            ThemeSettingSeeder::class,           // Theme/color settings
            
            // 2. Homepage Content Sections
            AboutUsSeeder::class,                // About Us section
            WhyUsSeeder::class,                  // Why Us section
            FeatureSeeder::class,                 // Features section
            ServiceSeeder::class,                 // Services section
            WhyChooseUsSeeder::class,             // Why Choose Us section
            
            // 3. Portfolio (categories before items)
            PortfolioCategorySeeder::class,       // Portfolio categories
            PortfolioItemSeeder::class,           // Portfolio items (depends on categories)
            
            // 4. Dynamic Content
            ClientSeeder::class,                  // Client logos/partners
            TeamMemberSeeder::class,              // Team members
            TestimonialSeeder::class,             // Testimonials
            
            // 5. Test & Career Content
            TestPageSeeder::class,                // Test pages (psychometric tests)
            CareerSeeder::class,                  // Career library
            GradePageSeeder::class,               // Grade-specific pages (Class 8-9, 10-12, etc.)
            
            // 6. Contact & Configuration
            ContactInfoSeeder::class,             // Contact information
            
            // 7. Navigation (must be last - may reference other content)
            MenuItemSeeder::class,                // Menu items (uses truncate, then creates)
        ]);
    }
}
