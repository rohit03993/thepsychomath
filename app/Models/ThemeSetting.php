<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'preset_name',
        // Logo
        'logo_path',
        'logo_alt_text',
        'show_portfolio',
        // Core colors
        'primary_color',
        'secondary_color',
        'background_color',
        'text_color',
        // Advanced colors
        'header_bg',
        'header_text',
        'footer_bg',
        'footer_text',
        'button_text',
        'card_bg',
        'border_color',
        'icon_color',
        'link_color',
        'link_hover_color',
        'section_bg_alt',
        // Hero section
        'hero_bg',
        'hero_text',
        'hero_gradient_start',
        'hero_gradient_end',
    ];

    /**
     * Get the logo URL or null if not set
     */
    public function getLogoUrl(): ?string
    {
        if ($this->logo_path) {
            return asset('storage/' . $this->logo_path);
        }
        return null;
    }

    protected $casts = [
        'is_active' => 'boolean',
        'show_portfolio' => 'boolean',
    ];

    /**
     * Get the active theme settings
     */
    public static function getActive(): ?self
    {
        return self::where('is_active', true)->first();
    }

    /**
     * Calculate contrasting text color based on background luminance
     * Returns black for light backgrounds, white for dark backgrounds
     */
    public static function getContrastColor(string $hexColor): string
    {
        // Remove # if present
        $hex = ltrim($hexColor, '#');
        
        // Convert to RGB
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        // Calculate luminance using the formula for relative luminance
        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
        
        // Return black for light backgrounds, white for dark
        return $luminance > 0.5 ? '#000000' : '#FFFFFF';
    }

    /**
     * Darken a hex color by a percentage
     */
    public static function darkenColor(string $hexColor, float $percent = 0.15): string
    {
        $hex = ltrim($hexColor, '#');
        
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        $r = max(0, (int)($r * (1 - $percent)));
        $g = max(0, (int)($g * (1 - $percent)));
        $b = max(0, (int)($b * (1 - $percent)));
        
        return sprintf('#%02X%02X%02X', $r, $g, $b);
    }

    /**
     * Lighten a hex color by a percentage
     */
    public static function lightenColor(string $hexColor, float $percent = 0.15): string
    {
        $hex = ltrim($hexColor, '#');
        
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        $r = min(255, (int)($r + (255 - $r) * $percent));
        $g = min(255, (int)($g + (255 - $g) * $percent));
        $b = min(255, (int)($b + (255 - $b) * $percent));
        
        return sprintf('#%02X%02X%02X', $r, $g, $b);
    }

    /**
     * Convert hex to RGBA for use in CSS
     */
    public static function hexToRgba(string $hexColor, float $alpha = 1): string
    {
        $hex = ltrim($hexColor, '#');
        
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        return "rgba($r, $g, $b, $alpha)";
    }

    /**
     * Get computed CSS variables including auto-calculated values
     * Uses SMART CONTRAST: automatically calculates text colors based on background brightness
     */
    public function getCssVariables(): array
    {
        $primary = $this->primary_color ?? '#14b8a6';
        $secondary = $this->secondary_color ?? '#000000';
        $background = $this->background_color ?? '#FFFFFF';
        $text = $this->text_color ?? '#333333';
        
        // Get component backgrounds
        $headerBg = $this->header_bg ?? $secondary;
        $footerBg = $this->footer_bg ?? $secondary;
        $heroBg = $this->hero_bg ?? $secondary;
        $cardBg = $this->card_bg ?? '#FFFFFF';
        $sectionAltBg = $this->section_bg_alt ?? '#F8F9FA';
        
        // SMART CONTRAST: Auto-calculate ALL text colors based on their backgrounds
        $textOnPrimary = self::getContrastColor($primary);
        $textOnSecondary = self::getContrastColor($secondary);
        $textOnBackground = self::getContrastColor($background);
        $textOnHeader = self::getContrastColor($headerBg);
        $textOnFooter = self::getContrastColor($footerBg);
        $textOnHero = self::getContrastColor($heroBg);
        $textOnCard = self::getContrastColor($cardBg);
        $textOnSectionAlt = self::getContrastColor($sectionAltBg);
        
        // Icon and link colors - use primary
        $iconColor = $primary;
        $linkColor = $primary;
        $linkHover = self::darkenColor($primary, 0.2);
        
        return [
            // Core colors
            '--primary-color' => $primary,
            '--secondary-color' => $secondary,
            '--bg-color' => $background,
            '--text-color' => $textOnBackground,
            
            // SMART CONTRAST text colors
            '--text-on-primary' => $textOnPrimary,
            '--text-on-secondary' => $textOnSecondary,
            '--text-on-light' => '#333333',
            '--text-on-dark' => '#ffffff',
            
            // Legacy mappings
            '--accent-yellow' => $primary,
            '--yellow-accent' => $primary,
            '--yellow-button' => self::darkenColor($primary, 0.05),
            '--dark-bg' => $secondary,
            '--dark-grey' => self::lightenColor($secondary, 0.1),
            '--text-light' => '#ffffff',
            '--text-dark' => '#333333',
            
            // Header - with auto-contrast text
            '--header-bg' => $headerBg,
            '--header-text' => $textOnHeader,
            
            // Footer - with auto-contrast text
            '--footer-bg' => $footerBg,
            '--footer-text' => $textOnFooter,
            
            // Buttons - with auto-contrast text
            '--button-bg' => $primary,
            '--button-text' => $textOnPrimary,
            '--button-hover-bg' => self::darkenColor($primary, 0.1),
            
            // Cards - with auto-contrast text
            '--card-bg' => $cardBg,
            '--card-text' => $textOnCard,
            
            // Alternate sections - with auto-contrast text
            '--section-bg-alt' => $sectionAltBg,
            '--section-alt-text' => $textOnSectionAlt,
            
            // Borders
            '--border-color' => $this->border_color ?? '#E0E0E0',
            
            // Icons and links
            '--icon-color' => $iconColor,
            '--link-color' => $linkColor,
            '--link-hover-color' => $linkHover,
            
            // Hero section - with auto-contrast text
            '--hero-bg' => $heroBg,
            '--hero-text' => $textOnHero,
            '--hero-gradient-start' => $this->hero_gradient_start ?? $primary,
            '--hero-gradient-end' => $this->hero_gradient_end ?? $secondary,
            
            // RGBA variants for transparency effects
            '--primary-rgb' => self::hexToRgba($primary, 1),
            '--primary-alpha-10' => self::hexToRgba($primary, 0.1),
            '--primary-alpha-15' => self::hexToRgba($primary, 0.15),
            '--primary-alpha-20' => self::hexToRgba($primary, 0.2),
            '--primary-alpha-30' => self::hexToRgba($primary, 0.3),
            '--primary-alpha-40' => self::hexToRgba($primary, 0.4),
            '--primary-alpha-50' => self::hexToRgba($primary, 0.5),
            '--secondary-alpha-10' => self::hexToRgba($secondary, 0.1),
            '--secondary-alpha-30' => self::hexToRgba($secondary, 0.3),
        ];
    }

    /**
     * Generate CSS string from variables
     */
    public function generateCss(): string
    {
        $vars = $this->getCssVariables();
        $css = ":root {\n";
        
        foreach ($vars as $name => $value) {
            $css .= "  {$name}: {$value};\n";
        }
        
        $css .= "}\n";
        
        return $css;
    }

    /**
     * Preset theme configurations
     */
    public static function getPresets(): array
    {
        return [
            'default' => [
                'name' => 'Default (Yellow & Black)',
                'primary_color' => '#FFC107',
                'secondary_color' => '#000000',
                'background_color' => '#FFFFFF',
                'text_color' => '#333333',
                'header_bg' => '#000000',
                'footer_bg' => '#000000',
                'hero_bg' => '#000000',
                'hero_gradient_start' => '#FFD700',
                'hero_gradient_end' => '#000000',
            ],
            'professional_blue' => [
                'name' => 'Professional Blue',
                'primary_color' => '#2563EB',
                'secondary_color' => '#1E40AF',
                'background_color' => '#FFFFFF',
                'text_color' => '#1F2937',
                'header_bg' => '#1E40AF',
                'footer_bg' => '#1E3A5F',
                'hero_bg' => '#1E40AF',
                'hero_gradient_start' => '#3B82F6',
                'hero_gradient_end' => '#1E40AF',
            ],
            'modern_teal' => [
                'name' => 'Modern Teal',
                'primary_color' => '#14B8A6',
                'secondary_color' => '#0F766E',
                'background_color' => '#FFFFFF',
                'text_color' => '#1F2937',
                'header_bg' => '#0F766E',
                'footer_bg' => '#115E59',
                'hero_bg' => '#0F766E',
                'hero_gradient_start' => '#2DD4BF',
                'hero_gradient_end' => '#0F766E',
            ],
            'warm_orange' => [
                'name' => 'Warm Orange',
                'primary_color' => '#F97316',
                'secondary_color' => '#EA580C',
                'background_color' => '#FFFFFF',
                'text_color' => '#1F2937',
                'header_bg' => '#9A3412',
                'footer_bg' => '#7C2D12',
                'hero_bg' => '#9A3412',
                'hero_gradient_start' => '#FB923C',
                'hero_gradient_end' => '#9A3412',
            ],
            'purple_elegance' => [
                'name' => 'Purple Elegance',
                'primary_color' => '#8B5CF6',
                'secondary_color' => '#6D28D9',
                'background_color' => '#FFFFFF',
                'text_color' => '#1F2937',
                'header_bg' => '#5B21B6',
                'footer_bg' => '#4C1D95',
                'hero_bg' => '#5B21B6',
                'hero_gradient_start' => '#A78BFA',
                'hero_gradient_end' => '#5B21B6',
            ],
            'dark_mode' => [
                'name' => 'Dark Mode',
                'primary_color' => '#60A5FA',
                'secondary_color' => '#3B82F6',
                'background_color' => '#1F2937',
                'text_color' => '#F9FAFB',
                'header_bg' => '#111827',
                'footer_bg' => '#111827',
                'card_bg' => '#374151',
                'section_bg_alt' => '#111827',
                'border_color' => '#4B5563',
                'hero_bg' => '#111827',
                'hero_text' => '#F9FAFB',
                'hero_gradient_start' => '#3B82F6',
                'hero_gradient_end' => '#111827',
            ],
            'forest_green' => [
                'name' => 'Forest Green',
                'primary_color' => '#22C55E',
                'secondary_color' => '#16A34A',
                'background_color' => '#FFFFFF',
                'text_color' => '#1F2937',
                'header_bg' => '#166534',
                'footer_bg' => '#14532D',
                'hero_bg' => '#166534',
                'hero_gradient_start' => '#4ADE80',
                'hero_gradient_end' => '#166534',
            ],
        ];
    }
}
