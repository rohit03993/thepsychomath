@php
    $themeSettingsHeader = \App\Models\ThemeSetting::getActive();
    $logoUrl = $themeSettingsHeader && $themeSettingsHeader->logo_path ? $themeSettingsHeader->getLogoUrl() : null;
    $logoAlt = $themeSettingsHeader && $themeSettingsHeader->logo_alt_text ? $themeSettingsHeader->logo_alt_text : 'Career Mapper';
@endphp
<header id="header" class="fixed-top">
    <div class="container">
        <h1 class="logo"><a href="{{ route('home') }}">
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $logoAlt }}" class="img-fluid logo-img" loading="eager" style="max-height: 50px; width: auto;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <span class="logo-text-fallback" style="display:none; width: 50px; height: 50px; background: var(--primary-color, #FFC107); border-radius: 50%; align-items: center; justify-content: center;">
                    <span style="font-weight: bold; font-size: 1.2rem; color: var(--text-on-primary, #000);">CM</span>
                </span>
            @else
                {{-- Default CM logo --}}
                <span class="logo-circle" style="width: 50px; height: 50px; background: var(--primary-color, #FFC107); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <span style="font-weight: bold; font-size: 1.2rem; color: var(--text-on-primary, #000);">CM</span>
                </span>
            @endif
        </a></h1>
        
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ route('home') }}#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="{{ route('home') }}#why-choose-us">Why Choose Us</a></li>
                <li class="dropdown"><a href="#"><span>All Test</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @php
                            try {
                                $allTestPages = \App\Models\TestPage::where('is_active', true)->orderBy('order')->get();
                                // Main tests (order 1-8)
                                $mainTests = $allTestPages->where('order', '<=', 8);
                                // Other tests (order 9+)
                                $otherTests = $allTestPages->where('order', '>', 8);
                            } catch (\Exception $e) {
                                $mainTests = collect([]);
                                $otherTests = collect([]);
                            }
                        @endphp
                        @if($mainTests->count() > 0 || $otherTests->count() > 0)
                            {{-- Main Tests (order 1-8) --}}
                            @foreach($mainTests as $testPage)
                                <li><a href="{{ route('test-pages.show', $testPage->slug) }}">{{ $testPage->title }}</a></li>
                            @endforeach
                            
                            {{-- Other Test Submenu --}}
                            @if($otherTests->count() > 0)
                                <li class="dropdown"><a href="#"><span>Other Test</span> <i class="bi bi-chevron-right"></i></a>
                                    <ul>
                                        @foreach($otherTests as $testPage)
                                            <li><a href="{{ route('test-pages.show', $testPage->slug) }}">{{ $testPage->title }}</a></li>
                                        @endforeach
                                        <li><a href="{{ route('test-pages.index') }}"><strong>For All Test Click Here</strong></a></li>
                                    </ul>
                                </li>
                            @endif
                        @else
                            {{-- Fallback links if no test pages exist yet --}}
                            <li><a href="{{ route('test-pages.show', 'aptitude-mappers') }}">Aptitude Mappers</a></li>
                            <li><a href="{{ route('test-pages.show', 'achievement-mappers') }}">Achievement Mappers</a></li>
                            <li><a href="{{ route('test-pages.show', 'attitude-mappers') }}">Attitude Mappers</a></li>
                            <li><a href="{{ route('test-pages.show', 'aspiration-mappers') }}">Aspiration Mappers</a></li>
                            <li><a href="{{ route('test-pages.show', 'aggression-mappers') }}">Aggression Mappers</a></li>
                            <li><a href="{{ route('test-pages.show', 'career-related-mappers') }}">Career Related Mappers</a></li>
                            <li><a href="{{ route('test-pages.show', 'educational-mappers') }}">Educational Mappers</a></li>
                            <li><a href="{{ route('test-pages.show', 'frustration-aggression-mappers') }}">Frustration and Aggression Mappers</a></li>
                            <li class="dropdown"><a href="#"><span>Other Test</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="{{ route('test-pages.show', 'human-rights-related-mappers') }}">Human Rights Related Mappers</a></li>
                                    <li><a href="{{ route('test-pages.show', 'interest-mappers') }}">Interest Mappers</a></li>
                                    <li><a href="{{ route('test-pages.show', 'interpersonal-relations-mappers') }}">Interpersonal Relations Mappers</a></li>
                                    <li><a href="{{ route('test-pages.show', 'motivational-mappers') }}">Motivational Mappers</a></li>
                                    <li><a href="{{ route('test-pages.index') }}"><strong>For All Test Click Here</strong></a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Career Library</span> <i class="bi bi-chevron-down"></i></a>
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
                <li><a class="nav-link scrollto" href="{{ route('home') }}#team">Team</a></li>
                <li><a class="nav-link scrollto" href="{{ route('home') }}#contact">Contact</a></li>
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

