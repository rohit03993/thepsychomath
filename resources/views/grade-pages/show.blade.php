@extends('layouts.app')

@section('title', 'Career Guidance - The Psycho Math')

@section('content')

@php
    // Get hero image URL
    $heroImageUrl = $gradePage->hero_image;
    if ($heroImageUrl && strpos($heroImageUrl, 'http') !== 0) {
        $heroImageUrl = asset('storage/' . $heroImageUrl);
    }
    $heroImageUrl = $heroImageUrl ?: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop';
    
    // Get feature links
    $featureLinks = $gradePage->feature_links ?? [
        'Career & Subject Assessment',
        'Personalised Guidance',
        'Profile Building',
        'Virtual Internships',
        'Subject & Career Mapping'
    ];
    
    // Get features
    $features = $gradePage->features ?? [];
    
    // Get button text
    $buttonText = $gradePage->button_text ?? 'Apply for Counseling Session';
@endphp

<!-- ======= Hero Section ======= -->
<section id="grade-hero" class="d-flex align-items-center" style="min-height: 70vh; padding: 140px 0 100px; background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%); position: relative; overflow: hidden;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                <h1 style="color: #fff; font-size: 3.5rem; font-weight: 700; line-height: 1.2; margin-bottom: 25px;">
                    {{ $gradePage->hero_title }}
                </h1>
                <p style="color: #e0e0e0; font-size: 1.3rem; line-height: 1.8; margin-bottom: 40px;">
                    {{ $gradePage->hero_subtitle }}
                </p>
                <a href="#apply-form" class="get-started-btn" style="background: var(--primary-color); color: var(--text-on-primary); padding: 18px 45px; border-radius: 50px; font-weight: 700; font-size: 1.1rem; text-decoration: none; display: inline-block; transition: all 0.3s; border: 2px solid var(--primary-color);">
                    {{ $buttonText }}
                </a>
            </div>
            <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ $heroImageUrl }}" 
                     class="img-fluid" 
                     alt="Career Guidance" 
                     style="border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.3);"
                     loading="lazy" 
                     onerror="this.src='https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Career+Guidance'; this.onerror=null;">
            </div>
        </div>
    </div>
</section>

<!-- ======= Feature Links Bar ======= -->
<section id="feature-links" style="padding: 40px 0; background: #f8f9fa; border-top: 1px solid #e0e0e0; border-bottom: 1px solid #e0e0e0;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="feature-links-bar" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 15px 25px;">
                    @foreach($featureLinks as $index => $link)
                        <a href="#feature-{{ $index }}" style="color: var(--text-dark); text-decoration: none; font-weight: 600; font-size: 1rem; transition: color 0.3s; position: relative;">
                            {{ $link }}
                        </a>
                        @if(!$loop->last)
                            <span style="color: #ccc;">|</span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======= Features Section ======= -->
<section id="grade-features" class="section-bg" style="padding: 100px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row g-4" style="margin: 0 -15px;">
            @foreach($features as $index => $feature)
                <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}" id="feature-{{ $index }}" style="padding: 0 15px;">
                    <div class="feature-card" style="background: #fff; padding: 0; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); height: 100%; transition: all 0.3s ease; border: 1px solid #e0e0e0; overflow: hidden; display: flex; flex-direction: column;">
                        <div class="feature-image-wrapper" style="width: 100%; height: 220px; overflow: hidden; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); display: flex; align-items: center; justify-content: center; padding: 25px; position: relative;">
                            @if(isset($feature['image']) && !empty($feature['image']))
                                <img src="{{ $feature['image'] }}" alt="{{ $feature['title'] ?? 'Feature' }}" 
                                     style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: cover; border-radius: 0;"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                @if(isset($feature['icon']) && !empty($feature['icon']))
                                    <i class="{{ $feature['icon'] }}" style="font-size: 5rem; color: var(--primary-color); display: none; position: absolute;"></i>
                                @else
                                    <i class="ri-book-open-line" style="font-size: 5rem; color: var(--primary-color); display: none; position: absolute;"></i>
                                @endif
                            @elseif(isset($feature['icon']) && !empty($feature['icon']))
                                <i class="{{ $feature['icon'] }}" style="font-size: 5rem; color: var(--primary-color);"></i>
                            @else
                                <i class="ri-book-open-line" style="font-size: 5rem; color: var(--primary-color);"></i>
                            @endif
                        </div>
                        <div class="feature-content" style="padding: 35px 30px; flex: 1; display: flex; flex-direction: column;">
                            <h4 style="color: var(--text-dark); font-size: 1.35rem; font-weight: 700; margin-bottom: 15px; line-height: 1.4;">
                                {{ $feature['title'] ?? '' }}
                            </h4>
                            <p style="color: #666; font-size: 1rem; line-height: 1.7; margin: 0; flex: 1;">
                                {{ $feature['description'] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ======= Apply Form Section ======= -->
<section id="apply-form" style="padding: 100px 0; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="apply-form-box" style="background: #fff; padding: 50px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                    <div class="text-center mb-4">
                        <h2 style="color: var(--text-dark); font-size: 2.5rem; font-weight: 700; margin-bottom: 15px;">
                            Apply for Counseling Session
                        </h2>
                        <p style="color: #666; font-size: 1.1rem;">
                            Fill out the form below and our expert counselors will get in touch with you soon.
                        </p>
                    </div>
                    
                    <form action="{{ route('contact.store') }}" method="POST" id="counselingForm">
                        @csrf
                        <input type="hidden" name="grade_level" value="{{ $slug }}">
                        <input type="hidden" name="message" value="Application for {{ ucfirst(str_replace('-', ' ', $slug)) }} Counseling Session">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label" style="font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">
                                    Your Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required
                                       style="padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label" style="font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">
                                    Your Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" id="email" value="{{ old('email') }}" required
                                       style="padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="contact_number" class="form-label" style="font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">
                                Contact Number <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: var(--primary-color); color: var(--text-on-primary); font-weight: 600; border: 2px solid #e0e0e0; border-right: none; border-radius: 8px 0 0 8px; padding: 12px 15px;">+91</span>
                                <input type="tel" class="form-control @error('contact_number') is-invalid @enderror contact-number-input" 
                                       id="contact_number" name="contact_number" value="{{ old('contact_number') }}" 
                                       placeholder="Enter 10-digit mobile number" maxlength="10" pattern="[6-9]\d{9}" required 
                                       style="border-radius: 0 8px 8px 0; border: 2px solid #e0e0e0; border-left: none; padding: 12px 15px; font-size: 1rem; color: #333;">
                            </div>
                            <small class="form-text text-muted" style="margin-top: 5px; display: block;">Format: +91 followed by 10 digits (starting with 6-9)</small>
                            @error('contact_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="additional_message" class="form-label" style="font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">
                                Additional Message (Optional)
                            </label>
                            <textarea class="form-control" name="additional_message" id="additional_message" rows="4" 
                                      placeholder="Tell us more about your career goals and what you'd like to discuss..."
                                      style="padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('additional_message') }}</textarea>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="get-started-btn" 
                                    style="background: var(--primary-color); color: var(--text-on-primary); padding: 18px 50px; border-radius: 50px; font-weight: 700; font-size: 1.1rem; border: 2px solid var(--primary-color); cursor: pointer; transition: all 0.3s;">
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('counselingForm');
    const contactNumberInput = document.getElementById('contact_number');
    
    if (contactNumberInput) {
        contactNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 10) {
                value = value.slice(0, 10);
            }
            e.target.value = value;
        });
    }
    
    // Add +91 prefix before form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            const contactNumber = contactNumberInput.value;
            if (contactNumber && !contactNumber.startsWith('+91')) {
                contactNumberInput.value = '+91' + contactNumber;
            }
        });
    }
    
    // Smooth scroll for feature links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // Feature card hover effects
    document.querySelectorAll('.feature-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.borderColor = 'var(--primary-color)';
            this.style.boxShadow = '0 15px 50px rgba(255,215,0,0.25)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.borderColor = '#e0e0e0';
            this.style.boxShadow = '0 10px 40px rgba(0,0,0,0.1)';
        });
    });
});
</script>
@endpush

@endsection
