@extends('layouts.app')

@section('title', ($career->meta_title ?? $career->title) . ' - The Psycho Math')

@section('content')

<section class="page-hero" style="background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.6) 100%), url('{{ $career->hero_image ? asset('storage/' . $career->hero_image) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1920&h=600&fit=crop' }}'); background-size: cover; background-position: center; padding: 150px 0 100px;">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="text-white mb-4" style="font-size: 3.5rem; font-weight: 700;">{{ $career->title }}</h1>
                @if($career->short_description)
                    <p class="lead text-white" style="font-size: 1.3rem; opacity: 0.9;">{{ $career->short_description }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="section-bg" style="padding: 80px 0;">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8">
                @if($career->featured_image)
                    <div class="mb-5" data-aos="zoom-in">
                        <img src="{{ asset('storage/' . $career->featured_image) }}" alt="{{ $career->title }}" class="img-fluid rounded" style="box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    </div>
                @endif

                @if($career->content)
                    <div class="content-section mb-5" data-aos="fade-up">
                        <div class="content-text" style="font-size: 1.1rem; line-height: 1.8; color: #333;">
                            {!! nl2br(e($career->content)) !!}
                        </div>
                    </div>
                @endif

                @if($career->features && count($career->features) > 0)
                    <div class="features-section mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="mb-4" style="color: var(--text-dark); font-weight: 600;">Key Features</h3>
                        <div class="row">
                            @foreach($career->features as $feature)
                                <div class="col-md-6 mb-3">
                                    <div class="feature-item d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill me-3" style="font-size: 1.5rem; flex-shrink: 0; color: var(--primary-color);"></i>
                                        <span style="font-size: 1rem; color: #555;">{{ $feature }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($career->scope)
                    <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="mb-4" style="color: var(--text-dark); font-weight: 600;">Scope & Career Prospects</h3>
                        <div class="card" style="border: 2px solid var(--primary-color); border-radius: 10px; padding: 25px;">
                            <p style="font-size: 1.05rem; line-height: 1.8; color: #555; margin: 0;">{!! nl2br(e($career->scope)) !!}</p>
                        </div>
                    </div>
                @endif

                @if($career->who_can_pursue)
                    <div class="mb-5" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="mb-4" style="color: var(--text-dark); font-weight: 600;">Who Can Pursue?</h3>
                        <div class="card" style="background: #f8f9fa; border: none; border-radius: 10px; padding: 25px;">
                            <p style="font-size: 1.05rem; line-height: 1.8; color: #555; margin: 0;">{!! nl2br(e($career->who_can_pursue)) !!}</p>
                        </div>
                    </div>
                @endif

                @if($career->what_you_get)
                    <div class="mb-5" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="mb-4" style="color: var(--text-dark); font-weight: 600;">What You'll Get</h3>
                        <div class="card" style="background: var(--primary-alpha-10, rgba(255,215,0,0.1)); border: 2px solid var(--primary-color); border-radius: 10px; padding: 25px;">
                            <p style="font-size: 1.05rem; line-height: 1.8; color: #555; margin: 0;">{!! nl2br(e($career->what_you_get)) !!}</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="sidebar" data-aos="fade-left" data-aos-delay="100">
                    <div class="card mb-4" style="background: var(--primary-color); border: none; border-radius: 15px; padding: 30px; text-align: center; box-shadow: 0 10px 30px var(--primary-alpha-30, rgba(0,0,0,0.2));">
                        <h4 class="mb-3" style="color: var(--text-on-primary); font-weight: 700;">Ready to Get Started?</h4>
                        <p class="mb-4" style="color: var(--text-on-primary); opacity: 0.9;">Get personalized career guidance from our counselors</p>
                        <a href="{{ route('home') }}#contact" class="btn btn-lg w-100" style="border-radius: 8px; font-weight: 600; padding: 15px; background: var(--secondary-color); color: var(--text-on-secondary);">
                            <i class="bi bi-chat-dots me-2"></i>Get Career Guidance
                        </a>
                    </div>

                    @if($relatedCareers && $relatedCareers->count() > 0)
                        <div class="card" style="border: 1px solid #e0e0e0; border-radius: 10px; padding: 25px;">
                            <h5 class="mb-4" style="color: var(--text-dark); font-weight: 600;">Related Careers</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($relatedCareers as $related)
                                    <li class="mb-3 pb-3" style="border-bottom: 1px solid #f0f0f0;">
                                        <a href="{{ route('careers.show', $related->slug) }}" style="text-decoration: none; color: #333; transition: color 0.3s;">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-arrow-right-circle me-2" style="color: var(--primary-color);"></i>
                                                <span>{{ $related->title }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact" style="padding: 80px 0; background: var(--secondary-color);">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
            <h2 class="mb-4" style="color: var(--text-on-secondary);">Have Questions About This Career?</h2>
            <p class="mb-5" style="color: var(--text-on-secondary); opacity: 0.7;">Get in touch with our career counselors for personalized guidance</p>
            <a href="{{ route('home') }}#contact" class="btn btn-lg" style="border-radius: 8px; font-weight: 600; padding: 15px 40px; background: var(--primary-color); color: var(--text-on-primary);">
                <i class="bi bi-envelope me-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>
@endsection
