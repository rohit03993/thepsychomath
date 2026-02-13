@extends('layouts.app')

@section('title', ($testPage->meta_title ?? $testPage->title) . ' - The Psycho Math')

@section('content')

<!-- ======= Page Hero Section ======= -->
<section class="page-hero" style="background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.6) 100%), url('{{ $testPage->hero_image ? asset('storage/' . $testPage->hero_image) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1920&h=600&fit=crop' }}'); background-size: cover; background-position: center; padding: 150px 0 100px; position: relative;">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="text-white mb-4" style="font-size: 3.5rem; font-weight: 700;">{{ $testPage->title }}</h1>
                @if($testPage->short_description)
                    <p class="lead text-white" style="font-size: 1.3rem; opacity: 0.9;">{{ $testPage->short_description }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- ======= Main Content Section ======= -->
<section class="section-bg" style="padding: 80px 0;">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                @if($testPage->featured_image)
                    <div class="mb-5" data-aos="zoom-in">
                        <img src="{{ asset('storage/' . $testPage->featured_image) }}" alt="{{ $testPage->title }}" class="img-fluid rounded" style="box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    </div>
                @endif

                @if($testPage->content)
                    <div class="content-section mb-5" data-aos="fade-up">
                        <div class="content-text" style="font-size: 1.1rem; line-height: 1.8; color: #333;">
                            {!! nl2br(e($testPage->content)) !!}
                        </div>
                    </div>
                @endif

                @if($testPage->features && count($testPage->features) > 0)
                    <div class="features-section mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="mb-4" style="color: var(--text-dark); font-weight: 600;">Key Features</h3>
                        <div class="row">
                            @foreach($testPage->features as $feature)
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

                @if($testPage->test_details && count($testPage->test_details) > 0)
                    <div class="test-details-section mb-5" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="mb-4" style="color: var(--text-dark); font-weight: 600;">Test Details</h3>
                        <div class="card" style="border: 2px solid var(--primary-color); border-radius: 10px; padding: 25px;">
                            <div class="row">
                                @foreach($testPage->test_details as $key => $value)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong style="color: var(--text-dark);">{{ $key }}:</strong>
                                            <span style="color: #666;">{{ $value }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if($testPage->who_can_take)
                    <div class="who-can-take-section mb-5" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="mb-4" style="color: var(--text-dark); font-weight: 600;">Who Can Take This Test?</h3>
                        <div class="card" style="background: #f8f9fa; border: none; border-radius: 10px; padding: 25px;">
                            <p style="font-size: 1.05rem; line-height: 1.8; color: #555; margin: 0;">
                                {!! nl2br(e($testPage->who_can_take)) !!}
                            </p>
                        </div>
                    </div>
                @endif

                @if($testPage->what_you_get)
                    <div class="what-you-get-section mb-5" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="mb-4" style="color: var(--text-dark); font-weight: 600;">What You'll Get</h3>
                        <div class="card" style="background: var(--primary-alpha-10, rgba(255,215,0,0.1)); border: 2px solid var(--primary-color); border-radius: 10px; padding: 25px;">
                            <p style="font-size: 1.05rem; line-height: 1.8; color: #555; margin: 0;">
                                {!! nl2br(e($testPage->what_you_get)) !!}
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar" data-aos="fade-left" data-aos-delay="100">
                    <!-- CTA Card -->
                    <div class="card mb-4" style="background: var(--primary-color); border: none; border-radius: 15px; padding: 30px; text-align: center; box-shadow: 0 10px 30px var(--primary-alpha-30, rgba(0,0,0,0.2));">
                        <h4 class="mb-3" style="color: var(--text-on-primary); font-weight: 700;">Ready to Get Started?</h4>
                        <p class="mb-4" style="color: var(--text-on-primary); opacity: 0.9;">Take this test and discover your potential</p>
                        <button type="button" class="btn btn-lg w-100" data-bs-toggle="modal" data-bs-target="#bookTestModal" style="border-radius: 8px; font-weight: 600; padding: 15px; background: var(--secondary-color); color: var(--text-on-secondary);">
                            <i class="bi bi-calendar-check me-2"></i>Book Your Test
                        </button>
                    </div>

                    <!-- Related Tests -->
                    @if($relatedPages && $relatedPages->count() > 0)
                        <div class="card" style="border: 1px solid #e0e0e0; border-radius: 10px; padding: 25px;">
                            <h5 class="mb-4" style="color: var(--text-dark); font-weight: 600;">Related Tests</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($relatedPages as $related)
                                    <li class="mb-3 pb-3" style="border-bottom: 1px solid #f0f0f0;">
                                        <a href="{{ route('test-pages.show', $related->slug) }}" style="text-decoration: none; color: #333; transition: color 0.3s;">
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

<!-- ======= Contact CTA Section ======= -->
<section id="contact" class="contact" style="padding: 80px 0; background: var(--secondary-color);">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
            <h2 class="mb-4" style="color: var(--text-on-secondary);">Have Questions About This Test?</h2>
            <p class="mb-5" style="color: var(--text-on-secondary); opacity: 0.7;">Get in touch with our career counselors for personalized guidance</p>
            <a href="{{ route('home') }}#contact" class="btn btn-lg" style="border-radius: 8px; font-weight: 600; padding: 15px 40px; background: var(--primary-color); color: var(--text-on-primary);">
                <i class="bi bi-envelope me-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<!-- Book Test Modal -->
<div class="modal fade" id="bookTestModal" tabindex="-1" aria-labelledby="bookTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: 2px solid var(--primary-color);">
            <div class="modal-header" style="background: var(--primary-color); border-bottom: 2px solid var(--primary-color); border-radius: 13px 13px 0 0;">
                <h5 class="modal-title" id="bookTestModalLabel" style="color: var(--text-on-primary); font-weight: 700;">
                    <i class="bi bi-calendar-check me-2"></i>Book Your Test - {{ $testPage->title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px; background: #fff;">
                <form id="bookTestForm" method="POST" action="{{ route('test-bookings.store') }}">
                    @csrf
                    <input type="hidden" name="test_page_id" value="{{ $testPage->id }}">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label" style="font-weight: 600; color: #333;">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required style="border-radius: 8px; padding: 12px; border: 2px solid #e0e0e0; color: #333;">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact_number" class="form-label" style="font-weight: 600; color: #333;">Contact Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" style="background: var(--primary-color); color: var(--text-on-primary); font-weight: 600; border: 2px solid #e0e0e0; border-right: none; border-radius: 8px 0 0 8px;">+91</span>
                            <input type="tel" class="form-control @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" placeholder="Enter 10-digit mobile number" maxlength="10" pattern="[6-9]\d{9}" required style="border-radius: 0 8px 8px 0; padding: 12px; border: 2px solid #e0e0e0; border-left: none; color: #333;">
                        </div>
                        <small class="form-text" style="color: #666;">Format: +91 followed by 10 digits (starting with 6-9)</small>
                        @error('contact_number')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div id="contact_number_error" class="text-danger" style="display: none; font-size: 0.875rem; margin-top: 5px;"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-weight: 600; color: #333;">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required style="border-radius: 8px; padding: 12px; border: 2px solid #e0e0e0; color: #333;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label" style="font-weight: 600; color: #333;">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4" required style="border-radius: 8px; padding: 12px; border: 2px solid #e0e0e0; resize: vertical; color: #333;">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="formMessage" class="alert" style="display: none; border-radius: 8px;"></div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-lg" id="submitBtn" style="border-radius: 8px; font-weight: 600; padding: 12px; background: var(--primary-color); color: var(--text-on-primary);">
                            <span id="submitBtnText"><i class="bi bi-send me-2"></i>Submit Booking Request</span>
                            <span id="submitBtnLoading" style="display: none;">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Submitting...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Wait for Bootstrap to load
function initBookTestForm() {
    if (typeof bootstrap === 'undefined') {
        setTimeout(initBookTestForm, 100);
        return;
    }

    const form = document.getElementById('bookTestForm');
    const contactNumberInput = document.getElementById('contact_number');
    const contactNumberError = document.getElementById('contact_number_error');
    const formMessage = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');
    const submitBtnText = document.getElementById('submitBtnText');
    const submitBtnLoading = document.getElementById('submitBtnLoading');
    const modalElement = document.getElementById('bookTestModal');
    let modal = null;
    
    if (modalElement && typeof bootstrap !== 'undefined') {
        modal = new bootstrap.Modal(modalElement);
    }

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
        formMessage.style.display = 'none';

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
            if (data.success) {
                formMessage.className = 'alert alert-success';
                formMessage.textContent = data.message;
                formMessage.style.display = 'block';
                form.reset();
                
                // Close modal after 2 seconds
                setTimeout(() => {
                    if (modal) {
                        modal.hide();
                    } else if (modalElement) {
                        // Fallback if Bootstrap modal not initialized
                        const bsModal = bootstrap.Modal.getInstance(modalElement);
                        if (bsModal) {
                            bsModal.hide();
                        }
                    }
                    formMessage.style.display = 'none';
                }, 2000);
            } else {
                formMessage.className = 'alert alert-danger';
                if (data.errors) {
                    let errorText = 'Please fix the following errors:\n';
                    Object.keys(data.errors).forEach(key => {
                        errorText += data.errors[key][0] + '\n';
                    });
                    formMessage.textContent = errorText;
                } else {
                    formMessage.textContent = data.message || 'An error occurred. Please try again.';
                }
                formMessage.style.display = 'block';
            }
        })
        .catch(error => {
            formMessage.className = 'alert alert-danger';
            formMessage.textContent = 'An error occurred. Please try again.';
            formMessage.style.display = 'block';
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtnText.style.display = 'inline';
            submitBtnLoading.style.display = 'none';
        });
    });

    // Reset form when modal is closed
    if (modalElement) {
        modalElement.addEventListener('hidden.bs.modal', function() {
            form.reset();
            formMessage.style.display = 'none';
            contactNumberError.style.display = 'none';
            contactNumberInput.classList.remove('is-invalid');
        });
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initBookTestForm);
} else {
    initBookTestForm();
}
</script>

@endsection

