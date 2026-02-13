@extends('admin.layout')

@section('title', 'Theme Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Theme Settings</h1>
                <div>
                    <form action="{{ route('admin.theme.reset') }}" method="POST" class="d-inline" onsubmit="return confirm('Reset to default theme? This will overwrite all custom colors.');">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset to Default
                        </button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <!-- Settings Panel -->
                <div class="col-lg-7">
                    <!-- Logo Upload -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-image me-2"></i>Site Logo</h5>
                            <small class="text-muted">Upload your logo (recommended: PNG with transparent background, max 200px height)</small>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <div class="logo-preview p-3 border rounded" style="background: {{ $theme->header_bg ?? '#000' }}; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                        @if($theme && $theme->logo_path)
                                            <img src="{{ $theme->getLogoUrl() }}" alt="Current Logo" style="max-height: 60px; max-width: 100%; object-fit: contain;">
                                        @else
                                            <div class="text-center" style="color: {{ $theme->header_text ?? '#fff' }};">
                                                <div style="width: 50px; height: 50px; background: var(--primary-color, #14b8a6); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                                    <span style="font-weight: bold; font-size: 1.2rem; color: #000;">PM</span>
                                                </div>
                                                <small class="d-block mt-2 opacity-75">Default Logo</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <form action="{{ route('admin.theme.logo.upload') }}" method="POST" enctype="multipart/form-data" class="mb-3">
                                        @csrf
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="logo" accept="image/*" required>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-upload me-1"></i> Upload Logo
                                            </button>
                                        </div>
                                        <small class="text-muted">Supported: JPG, PNG, GIF, SVG, WebP (max 2MB)</small>
                                    </form>
                                    
                                    @if($theme && $theme->logo_path)
                                        <form action="{{ route('admin.theme.logo.remove') }}" method="POST" class="d-inline" onsubmit="return confirm('Remove the logo and use the default?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash me-1"></i> Remove Logo
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preset Themes -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-palette me-2"></i>Preset Themes</h5>
                            <small class="text-muted">Quick apply a preset, then customize if needed</small>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach($presets as $key => $preset)
                                    <div class="col-md-4 col-6">
                                        <form action="{{ route('admin.theme.preset') }}" method="POST" class="preset-form">
                                            @csrf
                                            <input type="hidden" name="preset" value="{{ $key }}">
                                            <button type="submit" class="preset-card w-100 p-3 border rounded text-start {{ ($theme && $theme->preset_name === $key) ? 'border-primary border-2' : '' }}">
                                                <div class="d-flex mb-2">
                                                    <div class="color-swatch me-1" style="background: {{ $preset['primary_color'] }};"></div>
                                                    <div class="color-swatch me-1" style="background: {{ $preset['secondary_color'] }};"></div>
                                                    <div class="color-swatch" style="background: {{ $preset['background_color'] }}; border: 1px solid #ddd;"></div>
                                                </div>
                                                <div class="fw-semibold small">{{ $preset['name'] }}</div>
                                                @if($theme && $theme->preset_name === $key)
                                                    <span class="badge bg-primary mt-1">Active</span>
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Custom Colors Form -->
                    <form action="{{ route('admin.theme.update') }}" method="POST" id="themeForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="preset_name" value="{{ $theme->preset_name ?? '' }}">

                        <!-- Core Colors -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-brush me-2"></i>Core Colors</h5>
                                <small class="text-muted">Main colors used throughout the site</small>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Primary Color</label>
                                        <small class="d-block text-muted mb-2">Buttons, links, highlights, accents</small>
                                        <div class="input-group">
                                            <input type="color" class="form-control form-control-color color-picker" name="primary_color" value="{{ $theme->primary_color ?? '#14b8a6' }}" data-preview="primary">
                                            <input type="text" class="form-control color-text" value="{{ $theme->primary_color ?? '#14b8a6' }}" data-for="primary_color" pattern="^#[0-9A-Fa-f]{6}$">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Secondary Color</label>
                                        <small class="d-block text-muted mb-2">Dark backgrounds, accents</small>
                                        <div class="input-group">
                                            <input type="color" class="form-control form-control-color color-picker" name="secondary_color" value="{{ $theme->secondary_color ?? '#000000' }}" data-preview="secondary">
                                            <input type="text" class="form-control color-text" value="{{ $theme->secondary_color ?? '#000000' }}" data-for="secondary_color">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Background Color</label>
                                        <small class="d-block text-muted mb-2">Main page background</small>
                                        <div class="input-group">
                                            <input type="color" class="form-control form-control-color color-picker" name="background_color" value="{{ $theme->background_color ?? '#FFFFFF' }}" data-preview="background">
                                            <input type="text" class="form-control color-text" value="{{ $theme->background_color ?? '#FFFFFF' }}" data-for="background_color">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Text Color</label>
                                        <small class="d-block text-muted mb-2">Main body text</small>
                                        <div class="input-group">
                                            <input type="color" class="form-control form-control-color color-picker" name="text_color" value="{{ $theme->text_color ?? '#333333' }}" data-preview="text">
                                            <input type="text" class="form-control color-text" value="{{ $theme->text_color ?? '#333333' }}" data-for="text_color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Colors (Collapsible) -->
                        <div class="card mb-4">
                            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#advancedColors" style="cursor: pointer;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0"><i class="bi bi-sliders me-2"></i>Advanced Colors</h5>
                                        <small class="text-muted">Fine-tune individual elements</small>
                                    </div>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            <div class="collapse" id="advancedColors">
                                <div class="card-body">
                                    <!-- Header & Footer -->
                                    <h6 class="text-uppercase text-muted small mb-3">Header & Footer</h6>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Header Background</label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="header_bg" value="{{ $theme->header_bg ?? '#000000' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->header_bg ?? '#000000' }}" data-for="header_bg">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Header Text <span class="text-muted">(auto if empty)</span></label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="header_text" value="{{ $theme->header_text ?? '#FFFFFF' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->header_text ?? '' }}" data-for="header_text" placeholder="Auto">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Footer Background</label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="footer_bg" value="{{ $theme->footer_bg ?? '#000000' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->footer_bg ?? '#000000' }}" data-for="footer_bg">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Footer Text <span class="text-muted">(auto if empty)</span></label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="footer_text" value="{{ $theme->footer_text ?? '#FFFFFF' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->footer_text ?? '' }}" data-for="footer_text" placeholder="Auto">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons & Links -->
                                    <h6 class="text-uppercase text-muted small mb-3">Buttons & Links</h6>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-4">
                                            <label class="form-label">Button Text <span class="text-muted">(auto)</span></label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="button_text" value="{{ $theme->button_text ?? '#000000' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->button_text ?? '' }}" data-for="button_text" placeholder="Auto">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Link Color <span class="text-muted">(auto)</span></label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="link_color" value="{{ $theme->link_color ?? ($theme->primary_color ?? '#14b8a6') }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->link_color ?? '' }}" data-for="link_color" placeholder="Auto">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Link Hover <span class="text-muted">(auto)</span></label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="link_hover_color" value="{{ $theme->link_hover_color ?? '#0d9488' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->link_hover_color ?? '' }}" data-for="link_hover_color" placeholder="Auto">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cards & Sections -->
                                    <h6 class="text-uppercase text-muted small mb-3">Cards & Sections</h6>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-4">
                                            <label class="form-label">Card Background</label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="card_bg" value="{{ $theme->card_bg ?? '#FFFFFF' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->card_bg ?? '#FFFFFF' }}" data-for="card_bg">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Alt Section BG</label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="section_bg_alt" value="{{ $theme->section_bg_alt ?? '#F8F9FA' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->section_bg_alt ?? '#F8F9FA' }}" data-for="section_bg_alt">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Border Color</label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="border_color" value="{{ $theme->border_color ?? '#E0E0E0' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->border_color ?? '#E0E0E0' }}" data-for="border_color">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hero Section -->
                                    <h6 class="text-uppercase text-muted small mb-3">Hero Section</h6>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Hero Background</label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="hero_bg" value="{{ $theme->hero_bg ?? '#000000' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->hero_bg ?? '#000000' }}" data-for="hero_bg">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Hero Text <span class="text-muted">(auto)</span></label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="hero_text" value="{{ $theme->hero_text ?? '#FFFFFF' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->hero_text ?? '' }}" data-for="hero_text" placeholder="Auto">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Gradient Start</label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="hero_gradient_start" value="{{ $theme->hero_gradient_start ?? '#14b8a6' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->hero_gradient_start ?? '#14b8a6' }}" data-for="hero_gradient_start">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Gradient End</label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="hero_gradient_end" value="{{ $theme->hero_gradient_end ?? '#000000' }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->hero_gradient_end ?? '#000000' }}" data-for="hero_gradient_end">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Icon Color <span class="text-muted">(auto = primary)</span></label>
                                            <div class="input-group">
                                                <input type="color" class="form-control form-control-color color-picker" name="icon_color" value="{{ $theme->icon_color ?? ($theme->primary_color ?? '#14b8a6') }}">
                                                <input type="text" class="form-control color-text" value="{{ $theme->icon_color ?? '' }}" data-for="icon_color" placeholder="Auto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Homepage sections -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-layout-text-sidebar me-2"></i>Homepage Sections</h5>
                                <small class="text-muted">Show or hide sections on the homepage</small>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="show_portfolio" name="show_portfolio" value="1" {{ ($theme->show_portfolio ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_portfolio">Show Portfolio section on homepage</label>
                                </div>
                                <small class="text-muted d-block mt-1">When off, the Portfolio / gallery block is hidden completely.</small>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-lg me-1"></i> Save Theme Settings
                            </button>
                            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-eye me-1"></i> View Site
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Live Preview Panel -->
                <div class="col-lg-5">
                    <div class="card sticky-top" style="top: 20px;">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-eye me-2"></i>Live Preview</h5>
                        </div>
                        <div class="card-body p-0">
                            <div id="previewContainer" class="preview-container">
                                <!-- Mini Header Preview -->
                                <div class="preview-header" id="previewHeader">
                                    <div class="d-flex justify-content-between align-items-center px-3 py-2">
                                        <span class="fw-bold">LOGO</span>
                                        <div class="d-flex gap-2">
                                            <span class="small">Home</span>
                                            <span class="small">About</span>
                                            <span class="small">Services</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mini Hero Preview -->
                                <div class="preview-hero" id="previewHero">
                                    <div class="preview-hero-content">
                                        <h5 class="mb-2" id="previewHeroText">Discover Your Career</h5>
                                        <button class="btn btn-sm preview-btn" id="previewButton">Get Started</button>
                                    </div>
                                    <div class="preview-hero-gradient" id="previewGradient"></div>
                                </div>

                                <!-- Mini Content Preview -->
                                <div class="preview-content" id="previewContent">
                                    <div class="preview-section" id="previewSection1">
                                        <h6 id="previewSectionTitle">About Us</h6>
                                        <p class="small mb-2" id="previewText">Sample text content to show how body text appears with the selected colors.</p>
                                        <a href="#" class="preview-link" id="previewLink">Learn More →</a>
                                    </div>
                                    
                                    <div class="preview-section preview-section-alt" id="previewSection2">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="preview-card" id="previewCard1">
                                                    <i class="bi bi-star-fill preview-icon" id="previewIcon1"></i>
                                                    <span class="small">Service 1</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="preview-card" id="previewCard2">
                                                    <i class="bi bi-heart-fill preview-icon" id="previewIcon2"></i>
                                                    <span class="small">Service 2</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mini Footer Preview -->
                                <div class="preview-footer" id="previewFooter">
                                    <div class="px-3 py-2 small">
                                        <span>© 2026 The Psycho Math</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                This preview updates in real-time as you change colors. Save to apply changes site-wide.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Color Picker Styles */
.color-picker {
    width: 50px;
    height: 38px;
    padding: 2px;
    cursor: pointer;
}

.color-text {
    font-family: monospace;
    text-transform: uppercase;
}

.color-swatch {
    width: 24px;
    height: 24px;
    border-radius: 4px;
}

/* Preset Card Styles */
.preset-card {
    background: #fff;
    cursor: pointer;
    transition: all 0.2s ease;
}

.preset-card:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Preview Container Styles */
.preview-container {
    background: #fff;
    border-radius: 0 0 8px 8px;
    overflow: hidden;
}

.preview-header {
    background: var(--preview-header-bg, #000);
    color: var(--preview-header-text, #fff);
}

.preview-hero {
    position: relative;
    padding: 30px 15px;
    background: var(--preview-hero-bg, #000);
    color: var(--preview-hero-text, #fff);
    overflow: hidden;
}

.preview-hero-content {
    position: relative;
    z-index: 2;
}

.preview-hero-gradient {
    position: absolute;
    right: 0;
    top: 0;
    width: 50%;
    height: 100%;
    background: linear-gradient(135deg, var(--preview-gradient-start, #14b8a6) 0%, var(--preview-gradient-end, #000) 100%);
    opacity: 0.8;
}

.preview-btn {
    background: var(--preview-primary, #14b8a6) !important;
    color: var(--preview-button-text, #000) !important;
    border: none !important;
}

.preview-content {
    background: var(--preview-bg, #fff);
    color: var(--preview-text, #333);
}

.preview-section {
    padding: 15px;
}

.preview-section-alt {
    background: var(--preview-section-alt, #f8f9fa);
}

.preview-card {
    background: var(--preview-card-bg, #fff);
    border: 1px solid var(--preview-border, #e0e0e0);
    border-radius: 8px;
    padding: 15px;
    text-align: center;
}

.preview-icon {
    font-size: 1.5rem;
    color: var(--preview-icon, #14b8a6);
    display: block;
    margin-bottom: 5px;
}

.preview-link {
    color: var(--preview-link, #14b8a6);
    text-decoration: none;
}

.preview-link:hover {
    color: var(--preview-link-hover, #0d9488);
}

.preview-footer {
    background: var(--preview-footer-bg, #000);
    color: var(--preview-footer-text, #fff);
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorPickers = document.querySelectorAll('.color-picker');
    const colorTexts = document.querySelectorAll('.color-text');
    const previewContainer = document.getElementById('previewContainer');
    
    // Sync color picker with text input
    colorPickers.forEach(picker => {
        picker.addEventListener('input', function() {
            const textInput = this.nextElementSibling;
            if (textInput && textInput.classList.contains('color-text')) {
                textInput.value = this.value.toUpperCase();
            }
            updatePreview();
        });
    });
    
    colorTexts.forEach(text => {
        text.addEventListener('input', function() {
            let value = this.value;
            if (value && !value.startsWith('#')) {
                value = '#' + value;
            }
            if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
                const picker = this.previousElementSibling;
                if (picker && picker.classList.contains('color-picker')) {
                    picker.value = value;
                }
                updatePreview();
            }
        });
    });
    
    // Calculate contrast color
    function getContrastColor(hex) {
        hex = hex.replace('#', '');
        const r = parseInt(hex.substr(0, 2), 16);
        const g = parseInt(hex.substr(2, 2), 16);
        const b = parseInt(hex.substr(4, 2), 16);
        const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
        return luminance > 0.5 ? '#000000' : '#FFFFFF';
    }
    
    // Darken color
    function darkenColor(hex, percent = 0.15) {
        hex = hex.replace('#', '');
        let r = parseInt(hex.substr(0, 2), 16);
        let g = parseInt(hex.substr(2, 2), 16);
        let b = parseInt(hex.substr(4, 2), 16);
        r = Math.max(0, Math.floor(r * (1 - percent)));
        g = Math.max(0, Math.floor(g * (1 - percent)));
        b = Math.max(0, Math.floor(b * (1 - percent)));
        return '#' + [r, g, b].map(x => x.toString(16).padStart(2, '0')).join('').toUpperCase();
    }
    
    // Update live preview
    function updatePreview() {
        const primary = document.querySelector('input[name="primary_color"]').value;
        const secondary = document.querySelector('input[name="secondary_color"]').value;
        const background = document.querySelector('input[name="background_color"]').value;
        const text = document.querySelector('input[name="text_color"]').value;
        const headerBg = document.querySelector('input[name="header_bg"]').value;
        const footerBg = document.querySelector('input[name="footer_bg"]').value;
        const heroBg = document.querySelector('input[name="hero_bg"]').value;
        const heroGradientStart = document.querySelector('input[name="hero_gradient_start"]').value;
        const heroGradientEnd = document.querySelector('input[name="hero_gradient_end"]').value;
        const cardBg = document.querySelector('input[name="card_bg"]').value || '#FFFFFF';
        const sectionAlt = document.querySelector('input[name="section_bg_alt"]').value || '#F8F9FA';
        const borderColor = document.querySelector('input[name="border_color"]').value || '#E0E0E0';
        
        // Auto-calculated colors
        const buttonText = getContrastColor(primary);
        const headerText = getContrastColor(headerBg);
        const footerText = getContrastColor(footerBg);
        const heroText = getContrastColor(heroBg);
        const linkHover = darkenColor(primary, 0.2);
        
        // Apply to CSS variables
        previewContainer.style.setProperty('--preview-primary', primary);
        previewContainer.style.setProperty('--preview-secondary', secondary);
        previewContainer.style.setProperty('--preview-bg', background);
        previewContainer.style.setProperty('--preview-text', text);
        previewContainer.style.setProperty('--preview-header-bg', headerBg);
        previewContainer.style.setProperty('--preview-header-text', headerText);
        previewContainer.style.setProperty('--preview-footer-bg', footerBg);
        previewContainer.style.setProperty('--preview-footer-text', footerText);
        previewContainer.style.setProperty('--preview-hero-bg', heroBg);
        previewContainer.style.setProperty('--preview-hero-text', heroText);
        previewContainer.style.setProperty('--preview-gradient-start', heroGradientStart);
        previewContainer.style.setProperty('--preview-gradient-end', heroGradientEnd);
        previewContainer.style.setProperty('--preview-button-text', buttonText);
        previewContainer.style.setProperty('--preview-card-bg', cardBg);
        previewContainer.style.setProperty('--preview-section-alt', sectionAlt);
        previewContainer.style.setProperty('--preview-border', borderColor);
        previewContainer.style.setProperty('--preview-icon', primary);
        previewContainer.style.setProperty('--preview-link', primary);
        previewContainer.style.setProperty('--preview-link-hover', linkHover);
        
        // Mark preset as custom if colors were changed
        document.querySelector('input[name="preset_name"]').value = '';
    }
    
    // Initial preview update
    updatePreview();
});
</script>
@endpush
@endsection
