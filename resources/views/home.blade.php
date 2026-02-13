@extends('layouts.app')

@section('title', 'Best Career Counselling in India - The Psycho Math')

@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>Discover Your Perfect Career.</h1>
                <h2>Make smart decisions with our career guidance and expert counsellors</h2>
                <div class="d-flex justify-content-center justify-content-lg-start flex-wrap">
                    <a href="{{ route('grade-pages.show', 'class-8-9') }}" class="card-link">
                        <div class="card">
                            <div class="card-logo">
                                <div class="logo-badge">PM</div>
                            </div>
                            <i class="ri-book-open-line"></i>
                            <p>Class 8-9</p>
                        </div>
                    </a>
                    <a href="{{ route('grade-pages.show', 'class-10-12') }}" class="card-link">
                        <div class="card">
                            <div class="card-logo">
                                <div class="logo-badge">PM</div>
                            </div>
                            <i class="ri-bar-chart-line"></i>
                            <p>Class 10-12</p>
                        </div>
                    </a>
                    <a href="{{ route('grade-pages.show', 'college-graduates') }}" class="card-link">
                        <div class="card">
                            <div class="card-logo">
                                <div class="logo-badge">PM</div>
                            </div>
                            <i class="ri-calendar-line"></i>
                            <p>College and Graduates</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop" class="img-fluid animated" alt="Career Guidance" loading="lazy" onerror="this.src='https://via.placeholder.com/800x600/8b0000/ffffff?text=Career+Guidance'; this.onerror=null;">
            </div>
        </div>
    </div>
</section>

<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{ $aboutUs->title ?? 'About Us' }}</h2>
        </div>
        <div class="row content">
            <div class="col-lg-6">
                <p>
                    {{ $aboutUs->left_column_text ?? 'At THE PSYCHO MATH, we are dedicated to providing structured career counseling services tailored specifically for underprivileged students and those in government schools across the state—ensuring they receive the same opportunities as their peers in private institutions.' }}
                </p>
                @if($aboutUs && $aboutUs->features)
                    <ul>
                        @foreach($aboutUs->features as $feature)
                            <li><i class="ri-check-double-line"></i> {{ $feature }}</li>
                        @endforeach
                    </ul>
                @else
                    <ul>
                        <li><i class="ri-check-double-line"></i> Scientifically designed psychometric tests</li>
                        <li><i class="ri-check-double-line"></i> Personalized career guidance aligned with NEP 2020</li>
                        <li><i class="ri-check-double-line"></i> Integration of psychometric analysis with skill development</li>
                    </ul>
                @endif
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0">
                <p>
                    {{ $aboutUs->right_column_text_1 ?? 'Our scientifically designed psychometric tests assess students\' aptitudes, interests, and skills, delivering personalized career guidance aligned with the National Education Policy (NEP) 2020. By integrating psychometric analysis with skill development, we bridge the gap between education and career readiness, empowering students to make informed decisions about their future.' }}
                </p>
                <p>
                    {{ $aboutUs->right_column_text_2 ?? 'Our mission is to ensure that every student, regardless of their background, has access to the right guidance and opportunities to build a successful and fulfilling career.' }}
                </p>
                @if($aboutUs && $aboutUs->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $aboutUs->image) }}" alt="About Us" class="img-fluid rounded">
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- ======= Why Us Section ======= -->
<section id="why-us" class="why-us">
    <div class="container" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                <div class="content">
                    <h3><strong>{{ $whyUs->title ?? 'Shaping the Career Guidance Landscape' }}</strong></h3>
                    <p class="intro-text">
                        {{ $whyUs->intro_text ?? 'Comprehensive career guidance solutions for students, parents, educators and schools' }}
                    </p>
                </div>
                <div class="accordion-list">
                    <ul>
                        @if($whyUs && $whyUs->items)
                            @foreach($whyUs->items as $item)
                                <li>
                                    <div class="list-item-content">
                                        <span class="item-number">{{ $item['number'] ?? '' }}</span>
                                        <span class="item-text">{{ $item['text'] ?? '' }}</span>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li>
                                <div class="list-item-content">
                                    <span class="item-number">01</span>
                                    <span class="item-text">Enable students to identify their best-fit career with our world-class career assessment and personalised guidance.</span>
                                </div>
                            </li>
                            <li>
                                <div class="list-item-content">
                                    <span class="item-number">02</span>
                                    <span class="item-text">Empower students to learn all about the professional world with virtual career simulations, exhaustive career library, career blogs and vlogs.</span>
                                </div>
                            </li>
                            <li>
                                <div class="list-item-content">
                                    <span class="item-number">03</span>
                                    <span class="item-text">Pave student's way to their dream college with our end-to-end college application guidance, scholarship drive and corporate internship program.</span>
                                </div>
                            </li>
                            <li>
                                <div class="list-item-content">
                                    <span class="item-number">04</span>
                                    <span class="item-text">Enable schools in creating a career guidance ecosystem in sync with the vision of New Education Policy.</span>
                                </div>
                            </li>
                            <li>
                                <div class="list-item-content">
                                    <span class="item-number">05</span>
                                    <span class="item-text">Empower educators to become International Certified Career Coaches and build a career in career guidance & counselling.</span>
                                </div>
                            </li>
                            <li>
                                <div class="list-item-content">
                                    <span class="item-number">06</span>
                                    <span class="item-text">Revolutionary assessment platform and technology driven career guidance solutions for educators to boost their career guidance & counselling practice.</span>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
                <p class="conclusion-text">
                    <strong>{{ $whyUs->conclusion_text ?? 'Personalized, expert services & support for all stakeholders in the career guidance process.' }}</strong>
                </p>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0" data-aos="fade-left" data-aos-delay="100">
                <div class="why-us-image" style='background-image: url("{{ $whyUs && $whyUs->image ? asset('storage/' . $whyUs->image) : 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=700&fit=crop' }}");'></div>
            </div>
        </div>
    </div>
</section>

<!-- ======= Clients Section ======= -->
<section id="clients" class="clients section-bg">
    <div class="container" data-aos="zoom-in">
        <div class="section-title">
            <h2>Clients</h2>
            <p>Our Collaborators</p>
        </div>
        <!-- Desktop View -->
        <div class="row clients-desktop d-none d-md-flex">
            @if($clients && $clients->count() > 0)
                @foreach($clients as $client)
                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <div class="client-logo">
                            @if($client->logo)
                                <div class="logo-image-wrapper">
                                    <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="client-logo-img">
                                </div>
                            @else
                                <div class="logo-circle">{{ $client->initials ?? substr($client->name, 0, 2) }}</div>
                            @endif
                            <div class="logo-text">{{ $client->name }}</div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <div class="client-logo">
                        <div class="logo-circle">PM</div>
                        <div class="logo-text">The Psycho Math</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <div class="client-logo">
                        <div class="logo-circle">EDU</div>
                        <div class="logo-text">EduTech Solutions</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <div class="client-logo">
                        <div class="logo-circle">GC</div>
                        <div class="logo-text">Guidance Connect</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <div class="client-logo">
                        <div class="logo-circle">CS</div>
                        <div class="logo-text">Career Success</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <div class="client-logo">
                        <div class="logo-circle">FP</div>
                        <div class="logo-text">Future Path</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <div class="client-logo">
                        <div class="logo-circle">SC</div>
                        <div class="logo-text">Student Care</div>
                    </div>
                </div>
            @endif
        </div>
        <!-- Mobile Swiper View -->
        <div class="clients-mobile swiper d-md-none">
            <div class="swiper-wrapper">
                @if($clients && $clients->count() > 0)
                    @foreach($clients as $client)
                        <div class="swiper-slide">
                            <div class="client-logo">
                                @if($client->logo)
                                    <div class="logo-image-wrapper">
                                        <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="client-logo-img">
                                    </div>
                                @else
                                    <div class="logo-circle">{{ $client->initials ?? substr($client->name, 0, 2) }}</div>
                                @endif
                                <div class="logo-text">{{ $client->name }}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide">
                        <div class="client-logo">
                            <div class="logo-circle">PM</div>
                            <div class="logo-text">The Psycho Math</div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="client-logo">
                            <div class="logo-circle">EDU</div>
                            <div class="logo-text">EduTech Solutions</div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="client-logo">
                            <div class="logo-circle">GC</div>
                            <div class="logo-text">Guidance Connect</div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="client-logo">
                            <div class="logo-circle">CS</div>
                            <div class="logo-text">Career Success</div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="client-logo">
                            <div class="logo-circle">FP</div>
                            <div class="logo-text">Future Path</div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="client-logo">
                            <div class="logo-circle">SC</div>
                            <div class="logo-text">Student Care</div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- ======= Features Section ======= -->
<section id="features" class="features">
    <div class="container" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="100">
                <div class="image" style='background-image: url("{{ (isset($feature) && is_object($feature) && $feature->image) ? asset('storage/' . $feature->image) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&h=600&fit=crop' }}");'></div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                @if(isset($feature) && is_object($feature) && isset($feature->items) && is_array($feature->items))
                    @foreach($feature->items as $item)
                        <div class="icon-box">
                            <div class="icon-wrapper">
                                <i class="{{ $item['icon'] ?? 'bx bx-receipt' }}"></i>
                            </div>
                            <div class="content-wrapper">
                                <h4>{{ $item['title'] ?? '' }}</h4>
                                <p>{{ $item['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="icon-box">
                        <div class="icon-wrapper">
                            <i class="bx bx-receipt"></i>
                        </div>
                        <div class="content-wrapper">
                            <h4>Advanced Assessment</h4>
                            <p>Learn about your strengths and interests with our assessment and stream report.</p>
                        </div>
                    </div>
                    <div class="icon-box">
                        <div class="icon-wrapper">
                            <i class="bx bx-cube-alt"></i>
                        </div>
                        <div class="content-wrapper">
                            <h4>Interactive Career & Stream Activities</h4>
                            <p>Evaluate your academics, work style, aptitude and subject compatibility to identify your perfect stream.</p>
                        </div>
                    </div>
                    <div class="icon-box">
                        <div class="icon-wrapper">
                            <i class="bx bx-images"></i>
                        </div>
                        <div class="content-wrapper">
                            <h4>Simulated Virtual Career Internships</h4>
                            <p>Explore multiple career options through role play, simulations and experiential videos with our Virtual Internship Program</p>
                        </div>
                    </div>
                    <div class="icon-box">
                        <div class="icon-wrapper">
                            <i class="bx bx-shield"></i>
                        </div>
                        <div class="content-wrapper">
                            <h4>Personalised Guidance from Experts</h4>
                            <p>Finalise your stream and subjects and build a customised career plan with help from our career experts.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- ======= Services Section ======= -->
<section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{ isset($service) && is_object($service) ? $service->title : 'Services' }}</h2>
            <p>{{ isset($service) && is_object($service) && $service->subtitle ? $service->subtitle : 'Our Services / Assessment' }}</p>
        </div>
        <div class="row">
            @if(isset($service) && is_object($service) && isset($service->items) && is_array($service->items))
                @foreach($service->items as $index => $item)
                    @php
                        // Margin logic: 2 columns on mobile/md, 4 columns on xl
                        // Mobile: every 2 items = new row (mt-4)
                        // MD: every 2 items = new row (mt-4, but mt-md-0 for 2nd item)
                        // XL: every 4 items = new row (mt-4, but mt-xl-0 for items 2-3)
                        $marginClass = '';
                        if ($index > 0) {
                            if ($index % 4 == 0) {
                                // New row on all breakpoints (index 4, 8, 12...)
                                $marginClass = 'mt-4';
                            } elseif ($index % 2 == 0) {
                                // New row on mobile/md but not xl (index 2, 6, 10...)
                                $marginClass = 'mt-4 mt-xl-0';
                            } else {
                                // 2nd item in mobile/md row, but not new row on xl (index 1, 3, 5, 7...)
                                $marginClass = 'mt-4 mt-md-0 mt-xl-0';
                            }
                        }
                        
                        // Auto-generate link if not provided or empty
                        $itemLink = $item['link'] ?? '#';
                        if ($itemLink === '#' || empty($itemLink)) {
                            $title = strtolower(trim($item['title'] ?? ''));
                            // Map common test names to slugs
                            $testSlugMap = [
                                'aptitude mappers' => 'aptitude-mappers',
                                'achievement mappers' => 'achievement-mappers',
                                'attitude mappers' => 'attitude-mappers',
                                'aspiration mappers' => 'aspiration-mappers',
                                'aggression mappers' => 'aggression-mappers',
                                'career related mappers' => 'career-related-mappers',
                                'educational mappers' => 'educational-mappers',
                                'all test' => 'test-pages.index',
                                'all test here' => 'test-pages.index',
                            ];
                            
                            if (isset($testSlugMap[$title])) {
                                if ($testSlugMap[$title] === 'test-pages.index') {
                                    $itemLink = route('test-pages.index');
                                } else {
                                    $itemLink = route('test-pages.show', $testSlugMap[$title]);
                                }
                            }
                        }
                    @endphp
                    <div class="col-xl-3 col-md-6 col-6 d-flex align-items-stretch {{ $marginClass }}" data-aos="zoom-in" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
                        <a href="{{ $itemLink }}" class="service-card-link">
                            <div class="icon-box">
                                <div class="icon"><i class="{{ $item['icon'] ?? 'bx bx-layer' }}"></i></div>
                                <h4>{{ $item['title'] ?? '' }}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-xl-3 col-md-6 col-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <a href="{{ route('test-pages.show', 'aptitude-mappers') }}" class="service-card-link">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4>Aptitude Mappers</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                    <a href="{{ route('test-pages.show', 'achievement-mappers') }}" class="service-card-link">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4>Achievement Mappers</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                    <a href="{{ route('test-pages.show', 'attitude-mappers') }}" class="service-card-link">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4>Attitude Mappers</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                    <a href="{{ route('test-pages.show', 'aspiration-mappers') }}" class="service-card-link">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-layer"></i></div>
                            <h4>Aspiration Mappers</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
                    <a href="{{ route('test-pages.show', 'aggression-mappers') }}" class="service-card-link">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-layer"></i></div>
                            <h4>Aggression Mappers</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                    <a href="{{ route('test-pages.show', 'career-related-mappers') }}" class="service-card-link">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-layer"></i></div>
                            <h4>Career Related Mappers</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                    <a href="{{ route('test-pages.show', 'educational-mappers') }}" class="service-card-link">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-layer"></i></div>
                            <h4>Educational Mappers</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                    <a href="{{ route('test-pages.index') }}" class="service-card-link">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-layer"></i></div>
                            <h4>All Test Here</h4>
                        </div>
                    </a>
                </div>
            @endif
        </div>
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('test-pages.index') }}" class="btn btn-primary">Click here to get All Test List</a>
            </div>
        </div>
    </div>
</section>

<!-- ======= Gallery Section (optional: hide via Admin → Theme → Homepage Sections) ======= -->
@if(($themePortfolio = \App\Models\ThemeSetting::getActive()) === null || $themePortfolio->getAttribute('show_portfolio') !== false)
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Portfolio</h2>
            <p>Check Our Portfolio</p>
        </div>
        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            @if(isset($portfolioCategories) && $portfolioCategories->count() > 0)
                @foreach($portfolioCategories as $category)
                    <li data-filter=".{{ $category->slug }}">{{ $category->name }}</li>
                @endforeach
            @else
                <li data-filter=".filter-app">App</li>
                <li data-filter=".filter-card">Card</li>
                <li data-filter=".filter-web">Web</li>
            @endif
        </ul>
        <!-- Desktop View -->
        <div class="portfolio-container portfolio-desktop d-none d-md-grid" data-aos="fade-up" data-aos-delay="200">
            @if(isset($portfolioItems) && $portfolioItems->count() > 0)
                @foreach($portfolioItems as $item)
                    @php
                        // Handle both local storage paths and external URLs
                        $imageUrl = (strpos($item->image, 'http') === 0) ? $item->image : asset('storage/' . $item->image);
                        $thumbnailUrl = ($item->thumbnail) 
                            ? ((strpos($item->thumbnail, 'http') === 0) ? $item->thumbnail : asset('storage/' . $item->thumbnail))
                            : $imageUrl;
                    @endphp
                    <div class="portfolio-item {{ $item->category->slug ?? '' }}">
                        <a href="{{ $imageUrl }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ $item->title }}">
                            <div class="portfolio-img">
                                <img src="{{ $thumbnailUrl }}" class="img-fluid" alt="{{ $item->title }}" loading="lazy" onerror="this.src='https://via.placeholder.com/800x800/cccccc/666666?text=Image+Error'; this.onerror=null;">
                                <div class="portfolio-info">
                                    <h4>{{ $item->title }}</h4>
                                    <p>{{ $item->category->name ?? '' }}</p>
                                    <div class="portfolio-link"><i class="bx bx-plus"></i></div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="portfolio-item filter-app">
                    <a href="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1200&h=1200&fit=crop" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Career Counseling Session">
                        <div class="portfolio-img">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=800&fit=crop" class="img-fluid" alt="Career Counseling Session" loading="lazy">
                            <div class="portfolio-info">
                                <h4>Career Counseling</h4>
                                <p>App</p>
                                <div class="portfolio-link"><i class="bx bx-plus"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="portfolio-item filter-web">
                    <a href="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1200&h=1200&fit=crop" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Student Assessment">
                        <div class="portfolio-img">
                            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&h=800&fit=crop" class="img-fluid" alt="Student Assessment" loading="lazy">
                            <div class="portfolio-info">
                                <h4>Student Assessment</h4>
                                <p>Web</p>
                                <div class="portfolio-link"><i class="bx bx-plus"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="portfolio-item filter-app">
                    <a href="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1200&h=1200&fit=crop" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Career Guidance Workshop">
                        <div class="portfolio-img">
                            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=800&fit=crop" class="img-fluid" alt="Career Guidance Workshop" loading="lazy">
                            <div class="portfolio-info">
                                <h4>Career Workshop</h4>
                                <p>App</p>
                                <div class="portfolio-link"><i class="bx bx-plus"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="portfolio-item filter-card">
                    <a href="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=1200&h=1200&fit=crop" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Team Collaboration">
                        <div class="portfolio-img">
                            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800&h=800&fit=crop" class="img-fluid" alt="Team Collaboration" loading="lazy">
                            <div class="portfolio-info">
                                <h4>Team Collaboration</h4>
                                <p>Card</p>
                                <div class="portfolio-link"><i class="bx bx-plus"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="portfolio-item filter-web">
                    <a href="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&h=1200&fit=crop" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Career Planning">
                        <div class="portfolio-img">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=800&fit=crop" class="img-fluid" alt="Career Planning" loading="lazy">
                            <div class="portfolio-info">
                                <h4>Career Planning</h4>
                                <p>Web</p>
                                <div class="portfolio-link"><i class="bx bx-plus"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="portfolio-item filter-app">
                    <a href="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=1200&h=1200&fit=crop" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Student Success">
                        <div class="portfolio-img">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&h=800&fit=crop" class="img-fluid" alt="Student Success" loading="lazy">
                            <div class="portfolio-info">
                                <h4>Student Success</h4>
                                <p>App</p>
                                <div class="portfolio-link"><i class="bx bx-plus"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
        <!-- Mobile Swiper View -->
        <div class="portfolio-mobile swiper d-md-none" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper">
                @if(isset($portfolioItems) && $portfolioItems->count() > 0)
                    @foreach($portfolioItems as $item)
                        @php
                            // Handle both local storage paths and external URLs
                            $imageUrl = (strpos($item->image, 'http') === 0) ? $item->image : asset('storage/' . $item->image);
                            $thumbnailUrl = ($item->thumbnail) 
                                ? ((strpos($item->thumbnail, 'http') === 0) ? $item->thumbnail : asset('storage/' . $item->thumbnail))
                                : $imageUrl;
                        @endphp
                        <div class="swiper-slide">
                            <div class="portfolio-item {{ $item->category->slug ?? '' }}">
                                <a href="{{ $imageUrl }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ $item->title }}">
                                    <div class="portfolio-img">
                                        <img src="{{ $thumbnailUrl }}" class="img-fluid" alt="{{ $item->title }}" loading="lazy" onerror="this.src='https://via.placeholder.com/800x800/cccccc/666666?text=Image+Error'; this.onerror=null;">
                                        <div class="portfolio-info">
                                            <h4>{{ $item->title }}</h4>
                                            <p>{{ $item->category->name ?? '' }}</p>
                                            <div class="portfolio-link"><i class="bx bx-plus"></i></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide">
                        <div class="portfolio-item filter-app">
                            <a href="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1200&h=1200&fit=crop" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Career Counseling Session">
                                <div class="portfolio-img">
                                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=800&fit=crop" class="img-fluid" alt="Career Counseling Session" loading="lazy">
                                    <div class="portfolio-info">
                                        <h4>Career Counseling</h4>
                                        <p>App</p>
                                        <div class="portfolio-link"><i class="bx bx-plus"></i></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endif

<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Testimonials</h2>
        </div>
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @if(isset($testimonials) && $testimonials->count() > 0)
                    @foreach($testimonials as $testimonial)
                        @php
                            $imageUrl = $testimonial->image 
                                ? ((strpos($testimonial->image, 'http') === 0) ? $testimonial->image : asset('storage/' . $testimonial->image))
                                : 'https://i.pravatar.cc/150?img=' . ($loop->index + 1);
                        @endphp
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ $imageUrl }}" class="testimonial-img" alt="{{ $testimonial->name }}" 
                                     loading="lazy" onerror="this.src='https://i.pravatar.cc/150?img={{ $loop->index + 1 }}'; this.onerror=null;">
                                <h3>{{ $testimonial->name }}</h3>
                                <h4>{{ $testimonial->designation }}</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    {{ $testimonial->testimonial }}
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Default placeholder testimonials --}}
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="https://i.pravatar.cc/150?img=1" class="testimonial-img" alt="Harshit Gupta">
                            <h3>Harshit Gupta</h3>
                            <h4>Student</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                I got a chance to recieve career counselling from Shruti Ma'am. She created a comfortable environment where I could openly discuss my goals and concerns. Her attentive listening and tailored guidance helped me gain clarity. The personality tests she used were accurate and provided valuable insights. With her expertise, she explored various career paths and provided relevant information. Shruti Ma'am's dedication, ongoing support, and valuable resources have been invaluable. I highly recommend her services for anyone seeking professional guidance.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- ======= Why Choose Us Section ======= -->
<section id="why-choose-us" class="why-choose-us section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>{{ isset($whyChooseUs) && $whyChooseUs->title ? $whyChooseUs->title : 'Why Choose Us' }}</h2>
        </div>
        <div class="row content">
            <div class="col-lg-12">
                @if(isset($whyChooseUs) && $whyChooseUs->paragraph_1)
                    <p>{{ $whyChooseUs->paragraph_1 }}</p>
                @else
                    <p>
                        At THE PSYCHO MATH, we are dedicated to providing structured career counseling services tailored specifically for underprivileged students and those in government schools across the state—ensuring they receive the same opportunities as their peers in private institutions. Our scientifically designed psychometric tests assess students' aptitudes, interests, and skills, delivering personalized career guidance aligned with the National Education Policy (NEP) 2020. By integrating psychometric analysis with skill development, we bridge the gap between education and career readiness, empowering students to make informed decisions about their future. Our mission is to ensure that every student, regardless of their background, has access to the right guidance and opportunities to build a successful and fulfilling career.
                    </p>
                @endif
                @if(isset($whyChooseUs) && $whyChooseUs->paragraph_2)
                    <p>{{ $whyChooseUs->paragraph_2 }}</p>
                @else
                    <p>
                        At The Psycho Math, we are honored to support the children of martyrs from all three Indian Armed Forces by providing free* career counseling services. Our approach is rooted in scientifically designed psychometric tests that assess students' aptitudes, interests, and skills, ensuring personalized career guidance aligned with the *National Education Policy (NEP) 2020. By integrating psychometric analysis with *skill development, we empower these students to make well-informed career choices that align with their strengths and aspirations. Additionally, we prioritize *mental health care*, offering emotional support to help them navigate their future with confidence and resilience. Our mission is to honor the sacrifices of our brave soldiers by equipping their children with the right guidance, opportunities, and well-being to build a successful and fulfilling future.
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- ======= Team Section ======= -->
<section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <p>TEAM</p>
            <h2>OUR TEAM</h2>
        </div>
        <!-- Desktop View -->
        <div class="row team-desktop d-none d-md-flex">
            @if(isset($teamMembers) && $teamMembers->count() > 0)
                @foreach($teamMembers as $index => $member)
                    @php
                        $delay = ($index + 1) * 100;
                        $imageUrl = $member->image 
                            ? ((strpos($member->image, 'http') === 0) ? $member->image : asset('storage/' . $member->image))
                            : 'https://i.pravatar.cc/150?img=' . ($index + 1);
                        $hasSocial = $member->linkedin || $member->twitter || $member->facebook || $member->instagram || $member->youtube;
                    @endphp
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="{{ $delay }}">
                        <div class="team-member-card">
                            <div class="member-img-wrapper">
                                <img src="{{ $imageUrl }}" class="member-img" alt="{{ $member->name }}" 
                                     loading="lazy" onerror="this.src='https://i.pravatar.cc/150?img={{ $index + 1 }}'; this.onerror=null;">
                                @if($hasSocial)
                                    <div class="member-social">
                                        @if($member->linkedin)
                                            <a href="{{ $member->linkedin }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                                                <i class="bi bi-linkedin"></i>
                                            </a>
                                        @endif
                                        @if($member->twitter)
                                            <a href="{{ $member->twitter }}" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                                                <i class="bi bi-twitter"></i>
                                            </a>
                                        @endif
                                        @if($member->facebook)
                                            <a href="{{ $member->facebook }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                                <i class="bi bi-facebook"></i>
                                            </a>
                                        @endif
                                        @if($member->instagram)
                                            <a href="{{ $member->instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                                <i class="bi bi-instagram"></i>
                                            </a>
                                        @endif
                                        @if($member->youtube)
                                            <a href="{{ $member->youtube }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                                                <i class="bi bi-youtube"></i>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="member-info">
                                <h4>{{ $member->name }}</h4>
                                <p class="member-position">{!! nl2br(e($member->position)) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Default placeholder team members in card layout --}}
                @php
                    $defaultMembers = [
                        ['name' => 'Shruti Sharma', 'position' => "Founder & Cheif Assessment Officer\nICCC Certified Career Coach", 'img' => 47],
                        ['name' => 'Dr. Toshendra Dwivedi', 'position' => 'Cheif Psychologist, Professor of Psychology, Alliance University', 'img' => 33],
                        ['name' => 'Ritesh Jain', 'position' => 'Cheif Strategy Expert, Harvard Alumunus, Director at AaptPrep', 'img' => 13],
                    ];
                @endphp
                @foreach($defaultMembers as $index => $member)
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="team-member-card">
                            <div class="member-img-wrapper">
                                <img src="https://i.pravatar.cc/150?img={{ $member['img'] }}" class="member-img" alt="{{ $member['name'] }}" loading="lazy">
                            </div>
                            <div class="member-info">
                                <h4>{{ $member['name'] }}</h4>
                                <p class="member-position">{{ $member['position'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Mobile Swiper View -->
        <div class="team-mobile swiper d-md-none">
            <div class="swiper-wrapper">
                @if(isset($teamMembers) && $teamMembers->count() > 0)
                    @foreach($teamMembers as $index => $member)
                        @php
                            $imageUrl = $member->image 
                                ? ((strpos($member->image, 'http') === 0) ? $member->image : asset('storage/' . $member->image))
                                : 'https://i.pravatar.cc/150?img=' . ($index + 1);
                            $hasSocial = $member->linkedin || $member->twitter || $member->facebook || $member->instagram || $member->youtube;
                        @endphp
                        <div class="swiper-slide">
                            <div class="team-member-card">
                                <div class="member-img-wrapper">
                                    <img src="{{ $imageUrl }}" class="member-img" alt="{{ $member->name }}" 
                                         loading="lazy" onerror="this.src='https://i.pravatar.cc/150?img={{ $index + 1 }}'; this.onerror=null;">
                                    @if($hasSocial)
                                        <div class="member-social">
                                            @if($member->linkedin)
                                                <a href="{{ $member->linkedin }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                                                    <i class="bi bi-linkedin"></i>
                                                </a>
                                            @endif
                                            @if($member->twitter)
                                                <a href="{{ $member->twitter }}" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                                                    <i class="bi bi-twitter"></i>
                                                </a>
                                            @endif
                                            @if($member->facebook)
                                                <a href="{{ $member->facebook }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                                    <i class="bi bi-facebook"></i>
                                                </a>
                                            @endif
                                            @if($member->instagram)
                                                <a href="{{ $member->instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                                    <i class="bi bi-instagram"></i>
                                                </a>
                                            @endif
                                            @if($member->youtube)
                                                <a href="{{ $member->youtube }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                                                    <i class="bi bi-youtube"></i>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="member-info">
                                    <h4>{{ $member->name }}</h4>
                                    <p class="member-position">{!! nl2br(e($member->position)) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Default placeholder team members for mobile --}}
                    @php
                        $defaultMembers = [
                            ['name' => 'Shruti Sharma', 'position' => "Founder & Cheif Assessment Officer\nICCC Certified Career Coach", 'img' => 47],
                            ['name' => 'Dr. Toshendra Dwivedi', 'position' => 'Cheif Psychologist, Professor of Psychology, Alliance University', 'img' => 33],
                            ['name' => 'Ritesh Jain', 'position' => 'Cheif Strategy Expert, Harvard Alumunus, Director at AaptPrep', 'img' => 13],
                        ];
                    @endphp
                    @foreach($defaultMembers as $index => $member)
                        <div class="swiper-slide">
                            <div class="team-member-card">
                                <div class="member-img-wrapper">
                                    <img src="https://i.pravatar.cc/150?img={{ $member['img'] }}" class="member-img" alt="{{ $member['name'] }}" loading="lazy">
                                </div>
                                <div class="member-info">
                                    <h4>{{ $member['name'] }}</h4>
                                    <p class="member-position">{{ $member['position'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Contact Us</h2>
        </div>
        
        <!-- Map Section at Top -->
        @if(isset($contactInfo) && $contactInfo->map_embed_url)
            <div class="row mb-4">
                <div class="col-12">
                    <iframe src="{{ $contactInfo->map_embed_url }}" frameborder="0" style="border:0; width: 100%; height: 450px;" allowfullscreen></iframe>
                </div>
            </div>
        @else
            <div class="row mb-4">
                <div class="col-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.1234567890!2d77.2069!3d28.6280!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x52c2b7494e204dce!2sConnaught%20Place%2C%20New%20Delhi%2C%20Delhi%20110001!5e0!3m2!1sen!2sin!4v1234567890" frameborder="0" style="border:0; width: 100%; height: 450px;" allowfullscreen></iframe>
                </div>
            </div>
        @endif
        
        <!-- Contact Info and Form Section -->
        <div class="row">
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="info">
                    @php
                        // Get all centers that have addresses
                        $centers = [];
                        if(isset($contactInfo)) {
                            if(!empty($contactInfo->center_1)) $centers[] = ['name' => 'Center 1', 'address' => $contactInfo->center_1];
                            if(!empty($contactInfo->center_2)) $centers[] = ['name' => 'Center 2', 'address' => $contactInfo->center_2];
                            if(!empty($contactInfo->center_3)) $centers[] = ['name' => 'Center 3', 'address' => $contactInfo->center_3];
                            if(!empty($contactInfo->center_4)) $centers[] = ['name' => 'Center 4', 'address' => $contactInfo->center_4];
                        }
                        
                        // Fallback to legacy location/office_address if no centers are set
                        if(empty($centers)) {
                            if(isset($contactInfo) && $contactInfo->location) {
                                $centers[] = ['name' => 'Location', 'address' => $contactInfo->location];
                            }
                            if(isset($contactInfo) && $contactInfo->office_address) {
                                $centers[] = ['name' => 'Office Address', 'address' => $contactInfo->office_address];
                            }
                        }
                        
                        // Default fallback if nothing is set
                        if(empty($centers)) {
                            $centers[] = ['name' => 'Location', 'address' => 'A, 25/39, Middle Circle, Near Me A, Behind Marina Hotel, Block G, Connaught Place, New Delhi, Delhi 110001'];
                            $centers[] = ['name' => 'Office Address', 'address' => 'Raj Bharti House, Bhagwanpur, BHU, Varanasi -221005 U.P'];
                        }
                    @endphp
                    
                    @foreach($centers as $index => $center)
                        <div class="address {{ $index > 0 ? 'mt-4' : '' }}">
                            <i class="bi bi-geo-alt"></i>
                            <h4>{{ $center['name'] }}:</h4>
                            <p>{{ $center['address'] }}</p>
                        </div>
                    @endforeach
                    
                    <div class="email mt-4">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>{{ isset($contactInfo) && $contactInfo->email ? $contactInfo->email : 'info@thepsychomath.org' }}</p>
                    </div>
                    
                    <div class="phone mt-4">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>{{ isset($contactInfo) && $contactInfo->phone ? $contactInfo->phone : '+91 6396292221' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form action="{{ route('contact.store') }}" method="post" role="form" class="php-email-form" id="contactForm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Your Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Your Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" style="background: var(--primary-color); color: var(--text-on-primary); font-weight: 600; border: 2px solid #e0e0e0; border-right: none; border-radius: 8px 0 0 8px;">+91</span>
                            <input type="tel" class="form-control @error('contact_number') is-invalid @enderror contact-number-input" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" placeholder="Enter 10-digit mobile number" maxlength="10" pattern="[6-9]\d{9}" required style="border-radius: 0 8px 8px 0; border: 2px solid #e0e0e0; border-left: none;">
                        </div>
                        <small class="form-text text-muted">Format: +91 followed by 10 digits (starting with 6-9)</small>
                        @error('contact_number')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div id="contact_number_error" class="text-danger" style="display: none; font-size: 0.875rem; margin-top: 5px;"></div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="6" required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="contactSubmitBtn">
                            <span id="contactSubmitBtnText">Send Message</span>
                            <span id="contactSubmitBtnLoading" style="display: none;">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Sending...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const contactNumberInput = document.getElementById('contact_number');
    const contactNumberError = document.getElementById('contact_number_error');
    const submitBtn = document.getElementById('contactSubmitBtn');
    const submitBtnText = document.getElementById('contactSubmitBtnText');
    const submitBtnLoading = document.getElementById('contactSubmitBtnLoading');
    const errorMessage = form ? form.querySelector('.error-message') : null;
    const sentMessage = form ? form.querySelector('.sent-message') : null;

    if (!form || !contactNumberInput) return;

    // Format contact number input (only digits, max 10)
    contactNumberInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
        if (value.length > 10) {
            value = value.slice(0, 10);
        }
        e.target.value = value;
        validateContactNumber();
    });

    // Validate contact number format
    function validateContactNumber() {
        const value = contactNumberInput.value;
        const pattern = /^[6-9]\d{9}$/;
        
        if (value.length === 0) {
            contactNumberError.style.display = 'none';
            contactNumberInput.classList.remove('is-invalid');
            return false;
        }
        
        if (!pattern.test(value)) {
            contactNumberError.textContent = 'Contact number must start with 6-9 and be exactly 10 digits.';
            contactNumberError.style.display = 'block';
            contactNumberInput.classList.add('is-invalid');
            return false;
        } else {
            contactNumberError.style.display = 'none';
            contactNumberInput.classList.remove('is-invalid');
            return true;
        }
    }

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate contact number before submission
        if (!validateContactNumber()) {
            return;
        }

        // Prepare form data with +91 prefix
        const formData = new FormData(form);
        const contactNumber = formData.get('contact_number');
        formData.set('contact_number', '+91' + contactNumber);

        // Show loading state
        submitBtn.disabled = true;
        submitBtnText.style.display = 'none';
        submitBtnLoading.style.display = 'inline';
        if (errorMessage) errorMessage.style.display = 'none';
        if (sentMessage) sentMessage.style.display = 'none';

        // Submit via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            submitBtn.disabled = false;
            submitBtnText.style.display = 'inline';
            submitBtnLoading.style.display = 'none';

            if (data.success) {
                if (sentMessage) {
                    sentMessage.style.display = 'block';
                    sentMessage.textContent = data.message || 'Your message has been sent. Thank you!';
                }
                form.reset();
                
                // Scroll to success message
                if (sentMessage) {
                    sentMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                if (errorMessage) {
                    let errorText = 'Please fix the following errors:';
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            errorText += '\n' + data.errors[key][0];
                        });
                    } else {
                        errorText = data.message || 'An error occurred. Please try again.';
                    }
                    errorMessage.textContent = errorText;
                    errorMessage.style.display = 'block';
                }
            }
        })
        .catch(error => {
            submitBtn.disabled = false;
            submitBtnText.style.display = 'inline';
            submitBtnLoading.style.display = 'none';
            
            if (errorMessage) {
                errorMessage.textContent = 'An error occurred. Please try again.';
                errorMessage.style.display = 'block';
            }
        });
    });
});
</script>
@endpush

@endsection

