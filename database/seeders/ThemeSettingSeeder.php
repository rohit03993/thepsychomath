<?php

namespace Database\Seeders;

use App\Models\ThemeSetting;
use Illuminate\Database\Seeder;

class ThemeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update or create default theme - use explicit values for all required fields
        ThemeSetting::updateOrCreate(
            ['is_active' => true],
            [
            'is_active' => true,
            'preset_name' => 'default',
            // Core colors - Teal theme (#14b8a6)
            'primary_color' => '#14b8a6',
            'secondary_color' => '#000000',
            'background_color' => '#FFFFFF',
            'text_color' => '#333333',
            // Advanced colors - provide explicit defaults (auto-contrast will still work in CSS generation)
            'header_bg' => '#000000',
            'header_text' => '#FFFFFF', // Auto-calculated: white on black
            'footer_bg' => '#000000',
            'footer_text' => '#FFFFFF', // Auto-calculated: white on black
            'button_text' => '#FFFFFF', // Auto-calculated: white on teal (#14b8a6)
            'card_bg' => '#FFFFFF',
            'border_color' => '#E0E0E0',
            'icon_color' => '#14b8a6',
            'link_color' => '#14b8a6',
            'link_hover_color' => '#0d9488', // Darker teal for hover
            'section_bg_alt' => '#F8F9FA',
            // Hero section
            'hero_bg' => '#000000',
            'hero_text' => '#FFFFFF', // Auto-calculated: white on black
            'hero_gradient_start' => '#14b8a6', // Teal gradient start
            'hero_gradient_end' => '#000000',
            ]
        );

        $this->command->info('Default theme settings updated successfully.');
    }
}
