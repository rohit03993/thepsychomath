@php
    $themeSettingsHeader = \App\Models\ThemeSetting::getActive();
    $logoUrl = $themeSettingsHeader && $themeSettingsHeader->logo_path ? $themeSettingsHeader->getLogoUrl() : null;
    $logoAlt = $themeSettingsHeader && $themeSettingsHeader->logo_alt_text ? $themeSettingsHeader->logo_alt_text : 'The Psycho Math';
@endphp
<header id="header" class="fixed-top">
    <div class="container">
        <h1 class="logo"><a href="{{ route('home') }}">
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $logoAlt }}" class="img-fluid logo-img" loading="eager" style="max-height: 50px; width: auto;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <span class="logo-text-fallback" style="display:none; width: 50px; height: 50px; background: var(--primary-color, #14b8a6); border-radius: 50%; align-items: center; justify-content: center;">
                    <span style="font-weight: bold; font-size: 1.2rem; color: var(--text-on-primary, #000);">PM</span>
                </span>
            @else
                {{-- Default PM logo --}}
                <span class="logo-circle" style="width: 50px; height: 50px; background: var(--primary-color, #14b8a6); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <span style="font-weight: bold; font-size: 1.2rem; color: var(--text-on-primary, #000);">PM</span>
                </span>
            @endif
        </a></h1>
        
        <nav id="navbar" class="navbar">
            <ul>
                @php
                    try {
                        $menuItems = \App\Models\MenuItem::getActiveMenu();
                    } catch (\Exception $e) {
                        $menuItems = collect([]);
                    }
                @endphp

                @if($menuItems->count() > 0)
                    {{-- Dynamic Menu Items from Database --}}
                    @foreach($menuItems as $menuItem)
                        @include('partials.menu-item', ['item' => $menuItem])
                    @endforeach
                @else
                    {{-- Fallback: Default Career Library Menu if no menu items exist --}}
                    <li class="dropdown"><a href="#"><span>Careers</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            @php
                                try {
                                    $allCareers = \App\Models\Career::where('is_active', true)->orderBy('order')->get();
                                } catch (\Exception $e) {
                                    $allCareers = collect([]);
                                }
                            @endphp
                            @if($allCareers->count() > 0)
                                @foreach($allCareers as $career)
                                    <li><a href="{{ route('careers.show', $career->slug) }}">{{ $career->title }}</a></li>
                                @endforeach
                                <li><a href="{{ route('careers.index') }}"><strong>View All Careers</strong></a></li>
                            @else
                                <li><a href="{{ route('careers.index') }}">Career Library</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <button type="button" class="mobile-nav-toggle" id="mobile-nav-toggle-btn" aria-label="Open menu" aria-expanded="false">
            <span class="mobile-nav-toggle-icon" aria-hidden="true">☰</span>
        </button>
        @php
            $contactInfo = \App\Models\ContactInfo::where('is_active', true)->first();
            $phoneRaw = $contactInfo && $contactInfo->phone ? trim($contactInfo->phone) : '+916396292221';
            $phoneForTel = 'tel:' . preg_replace('/\s+/', '', ltrim($phoneRaw, 'tel:'));
        @endphp
        <a href="{{ $phoneForTel }}" class="get-started-btn scrollto" aria-label="Call us">Call Now</a>
    </div>
</header>

