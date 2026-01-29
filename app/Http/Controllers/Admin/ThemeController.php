<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    /**
     * Show the theme settings page
     */
    public function index()
    {
        $theme = ThemeSetting::getActive();
        $presets = ThemeSetting::getPresets();
        
        return view('admin.theme.index', compact('theme', 'presets'));
    }

    /**
     * Update the theme settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'preset_name' => 'nullable|string|max:50',
            'logo_alt_text' => 'nullable|string|max:100',
            // Core colors
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'background_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            // Advanced colors
            'header_bg' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'header_text' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'footer_bg' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'footer_text' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'button_text' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'card_bg' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'border_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'icon_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'link_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'link_hover_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'section_bg_alt' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            // Hero section
            'hero_bg' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'hero_text' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'hero_gradient_start' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'hero_gradient_end' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'show_portfolio' => 'boolean',
        ]);

        // Get or create the active theme
        $theme = ThemeSetting::getActive();
        
        if (!$theme) {
            $theme = new ThemeSetting();
            $theme->is_active = true;
        }

        unset($validated['show_portfolio']);
        $theme->fill($validated);
        $theme->show_portfolio = $request->boolean('show_portfolio');
        $theme->save();

        return redirect()->route('admin.theme.index')
            ->with('success', 'Theme settings updated successfully!');
    }

    /**
     * Upload logo
     */
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,gif,svg,webp|max:2048',
        ]);

        $theme = ThemeSetting::getActive();
        
        if (!$theme) {
            $theme = new ThemeSetting();
            $theme->is_active = true;
        }

        // Delete old logo if exists
        if ($theme->logo_path && Storage::disk('public')->exists($theme->logo_path)) {
            Storage::disk('public')->delete($theme->logo_path);
        }

        // Store new logo
        $path = $request->file('logo')->store('logos', 'public');
        $theme->logo_path = $path;
        $theme->save();

        return redirect()->route('admin.theme.index')
            ->with('success', 'Logo uploaded successfully!');
    }

    /**
     * Remove logo
     */
    public function removeLogo()
    {
        $theme = ThemeSetting::getActive();
        
        if ($theme && $theme->logo_path) {
            // Delete the file
            if (Storage::disk('public')->exists($theme->logo_path)) {
                Storage::disk('public')->delete($theme->logo_path);
            }
            
            $theme->logo_path = null;
            $theme->save();
            
            return redirect()->route('admin.theme.index')
                ->with('success', 'Logo removed successfully!');
        }

        return redirect()->route('admin.theme.index')
            ->with('error', 'No logo to remove.');
    }

    /**
     * Apply a preset theme
     */
    public function applyPreset(Request $request)
    {
        $request->validate([
            'preset' => 'required|string'
        ]);

        $presetKey = $request->preset;
        $presets = ThemeSetting::getPresets();

        if (!isset($presets[$presetKey])) {
            return redirect()->route('admin.theme.index')
                ->with('error', 'Invalid preset selected.');
        }

        $presetData = $presets[$presetKey];
        $presetName = $presetData['name'];
        unset($presetData['name']);

        // Get or create the active theme
        $theme = ThemeSetting::getActive();
        
        if (!$theme) {
            $theme = new ThemeSetting();
            $theme->is_active = true;
        }

        // Apply preset values
        $theme->preset_name = $presetKey;
        $theme->fill($presetData);
        
        // Also update derived colors to match the primary color
        // This ensures icons, links etc. use the new theme color
        $primary = $presetData['primary_color'];
        $theme->icon_color = $primary;
        $theme->link_color = $primary;
        $theme->link_hover_color = ThemeSetting::darkenColor($primary, 0.2);
        $theme->button_text = ThemeSetting::getContrastColor($primary);
        
        // If preset doesn't specify header/footer text, auto-calculate
        if (!isset($presetData['header_text'])) {
            $theme->header_text = ThemeSetting::getContrastColor($presetData['header_bg'] ?? $presetData['secondary_color']);
        }
        if (!isset($presetData['footer_text'])) {
            $theme->footer_text = ThemeSetting::getContrastColor($presetData['footer_bg'] ?? $presetData['secondary_color']);
        }
        if (!isset($presetData['hero_text'])) {
            $theme->hero_text = ThemeSetting::getContrastColor($presetData['hero_bg'] ?? $presetData['secondary_color']);
        }
        
        $theme->save();

        return redirect()->route('admin.theme.index')
            ->with('success', "Preset '{$presetName}' applied successfully!");
    }

    /**
     * Reset to default theme
     */
    public function reset()
    {
        $defaultPreset = ThemeSetting::getPresets()['default'];
        unset($defaultPreset['name']);

        // Get or create the active theme
        $theme = ThemeSetting::getActive();
        
        if (!$theme) {
            $theme = new ThemeSetting();
            $theme->is_active = true;
        }

        // Reset to defaults
        $theme->preset_name = 'default';
        $theme->fill($defaultPreset);
        
        // Reset advanced colors to null (auto-calculate)
        $theme->button_text = null;
        $theme->header_text = null;
        $theme->footer_text = null;
        $theme->icon_color = null;
        $theme->link_color = null;
        $theme->link_hover_color = null;
        $theme->hero_text = null;
        $theme->card_bg = '#FFFFFF';
        $theme->border_color = '#E0E0E0';
        $theme->section_bg_alt = '#F8F9FA';
        
        $theme->save();

        return redirect()->route('admin.theme.index')
            ->with('success', 'Theme reset to default successfully!');
    }

    /**
     * Get theme preview CSS (AJAX endpoint)
     */
    public function preview(Request $request)
    {
        $theme = new ThemeSetting($request->all());
        $css = $theme->generateCss();
        
        return response()->json([
            'css' => $css,
            'variables' => $theme->getCssVariables()
        ]);
    }
}
