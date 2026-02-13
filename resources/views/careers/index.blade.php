@extends('layouts.app')

@section('title', 'Career Library - The Psycho Math')

@section('content')

<section class="page-hero" style="background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.6) 100%), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1920&h=600&fit=crop'); background-size: cover; background-position: center; padding: 150px 0 100px;">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="text-white mb-4" style="font-size: 3.5rem; font-weight: 700;">Career Library</h1>
                <p class="lead text-white" style="font-size: 1.3rem; opacity: 0.9;">Everything you need to know, from colleges to scope, for hundreds of careers</p>
            </div>
        </div>
    </div>
</section>

<section class="section-bg" style="padding: 80px 0;">
    <div class="container" data-aos="fade-up">
        @if($careers && $careers->count() > 0)
            <div class="row">
                @foreach($careers as $index => $career)
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="{{ ($index % 3) * 100 }}">
                        <div class="card h-100" style="border: 2px solid #f0f0f0; border-radius: 15px; overflow: hidden; transition: all 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                            @if($career->featured_image)
                                <img src="{{ asset('storage/' . $career->featured_image) }}" class="card-img-top" alt="{{ $career->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: var(--primary-color);">
                                    <i class="bi bi-briefcase" style="font-size: 4rem; color: var(--text-on-primary);"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-3" style="color: var(--text-dark); font-weight: 600; font-size: 1.3rem;">{{ $career->title }}</h5>
                                @if($career->short_description)
                                    <p class="card-text flex-grow-1" style="color: #666; line-height: 1.6;">{{ Str::limit($career->short_description, 120) }}</p>
                                @endif
                                <div class="d-grid gap-2 mt-auto">
                                    <a href="{{ route('careers.show', $career->slug) }}" class="btn" style="border-radius: 8px; font-weight: 600; border: 2px solid var(--primary-color); color: var(--primary-color); background: transparent;">
                                        Learn More <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                    <a href="{{ route('home') }}#contact" class="btn" style="border-radius: 8px; font-weight: 600; background: var(--primary-color); color: var(--text-on-primary);">
                                        <i class="bi bi-chat-dots me-2"></i>Get Career Guidance
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-briefcase" style="font-size: 4rem; color: #ccc; margin-bottom: 20px;"></i>
                <h3 style="color: var(--text-dark); margin-bottom: 10px;">No Careers Yet</h3>
                <p style="color: #666;">Career library pages will be available soon.</p>
            </div>
        @endif
    </div>
</section>

<section class="contact" style="padding: 80px 0; background: var(--secondary-color);">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
            <h2 class="mb-4" style="color: var(--text-on-secondary);">Need Help Choosing a Career?</h2>
            <p class="mb-5" style="color: var(--text-on-secondary); opacity: 0.7;">Our career counselors are here to guide you</p>
            <a href="{{ route('home') }}#contact" class="btn btn-lg" style="border-radius: 8px; font-weight: 600; padding: 15px 40px; background: var(--primary-color); color: var(--text-on-primary);">
                <i class="bi bi-envelope me-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>
@endsection
