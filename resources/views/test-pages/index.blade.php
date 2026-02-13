@extends('layouts.app')

@section('title', 'Psychological Assessment Tests - The Psycho Math')

@section('content')

<!-- ======= Page Hero Section ======= -->
<section class="page-hero" style="background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.6) 100%), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1920&h=600&fit=crop'); background-size: cover; background-position: center; padding: 150px 0 100px;">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="text-white mb-4" style="font-size: 3.5rem; font-weight: 700;">Psychological Assessment Tests</h1>
                <p class="lead text-white" style="font-size: 1.3rem; opacity: 0.9;">Discover your potential with our comprehensive range of psychological assessments</p>
            </div>
        </div>
    </div>
</section>

<!-- ======= Tests Grid Section ======= -->
<section class="section-bg" style="padding: 80px 0;">
    <div class="container" data-aos="fade-up">
        @if($testPages && $testPages->count() > 0)
            <div class="row">
                @foreach($testPages as $index => $testPage)
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="{{ ($index % 3) * 100 }}">
                        <div class="card h-100" style="border: 2px solid #f0f0f0; border-radius: 15px; overflow: hidden; transition: all 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                            @if($testPage->featured_image)
                                <img src="{{ asset('storage/' . $testPage->featured_image) }}" class="card-img-top" alt="{{ $testPage->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: var(--primary-color);">
                                    <i class="bi bi-clipboard-data" style="font-size: 4rem; color: var(--text-on-primary);"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-3" style="color: var(--text-dark); font-weight: 600; font-size: 1.3rem;">{{ $testPage->title }}</h5>
                                @if($testPage->short_description)
                                    <p class="card-text flex-grow-1" style="color: #666; line-height: 1.6;">{{ Str::limit($testPage->short_description, 120) }}</p>
                                @endif
                                <div class="d-grid gap-2 mt-auto">
                                    <a href="{{ route('test-pages.show', $testPage->slug) }}" class="btn" style="border-radius: 8px; font-weight: 600; border: 2px solid var(--primary-color); color: var(--primary-color); background: transparent;">
                                        Learn More <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#bookTestModal{{ $testPage->id }}" style="border-radius: 8px; font-weight: 600; background: var(--primary-color); color: var(--text-on-primary);">
                                        <i class="bi bi-calendar-check me-2"></i>Book Your Test
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc; margin-bottom: 20px;"></i>
                <h3 style="color: var(--text-dark); margin-bottom: 10px;">No Tests Available Yet</h3>
                <p style="color: #666;">Test pages will be available soon.</p>
            </div>
        @endif
    </div>
</section>

<!-- ======= CTA Section ======= -->
<section class="contact" style="padding: 80px 0; background: var(--secondary-color);">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
            <h2 class="mb-4" style="color: var(--text-on-secondary);">Need Help Choosing the Right Test?</h2>
            <p class="mb-5" style="color: var(--text-on-secondary); opacity: 0.7;">Our career counselors are here to guide you</p>
            <a href="{{ route('home') }}#contact" class="btn btn-lg" style="border-radius: 8px; font-weight: 600; padding: 15px 40px; background: var(--primary-color); color: var(--text-on-primary);">
                <i class="bi bi-envelope me-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>

<!-- Book Test Modals for each test page -->
@foreach($testPages as $testPage)
<!-- Book Test Modal for {{ $testPage->title }} -->
<div class="modal fade" id="bookTestModal{{ $testPage->id }}" tabindex="-1" aria-labelledby="bookTestModalLabel{{ $testPage->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: 2px solid var(--primary-color);">
            <div class="modal-header" style="background: var(--primary-color); border-bottom: 2px solid var(--primary-color); border-radius: 13px 13px 0 0;">
                <h5 class="modal-title" id="bookTestModalLabel{{ $testPage->id }}" style="color: var(--text-on-primary); font-weight: 700;">
                    <i class="bi bi-calendar-check me-2"></i>Book Your Test - {{ $testPage->title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px; background: #fff;">
                <form class="bookTestForm" method="POST" action="{{ route('test-bookings.store') }}" data-test-id="{{ $testPage->id }}">
                    @csrf
                    <input type="hidden" name="test_page_id" value="{{ $testPage->id }}">
                    
                    <div class="mb-3">
                        <label for="name{{ $testPage->id }}" class="form-label" style="font-weight: 600; color: #333;">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name{{ $testPage->id }}" name="name" value="{{ old('name') }}" required style="border-radius: 8px; padding: 12px; border: 2px solid #e0e0e0; color: #333;">
                    </div>

                    <div class="mb-3">
                        <label for="contact_number{{ $testPage->id }}" class="form-label" style="font-weight: 600; color: #333;">Contact Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" style="background: var(--primary-color); color: var(--text-on-primary); font-weight: 600; border: 2px solid #e0e0e0; border-right: none; border-radius: 8px 0 0 8px;">+91</span>
                            <input type="tel" class="form-control contact-number-input" id="contact_number{{ $testPage->id }}" name="contact_number" value="{{ old('contact_number') }}" placeholder="Enter 10-digit mobile number" maxlength="10" pattern="[6-9]\d{9}" required style="border-radius: 0 8px 8px 0; padding: 12px; border: 2px solid #e0e0e0; border-left: none; color: #333;">
                        </div>
                        <small class="form-text" style="color: #666;">Format: +91 followed by 10 digits (starting with 6-9)</small>
                        <div class="contact-number-error text-danger" style="display: none; font-size: 0.875rem; margin-top: 5px;"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email{{ $testPage->id }}" class="form-label" style="font-weight: 600; color: #333;">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email{{ $testPage->id }}" name="email" value="{{ old('email') }}" required style="border-radius: 8px; padding: 12px; border: 2px solid #e0e0e0; color: #333;">
                    </div>

                    <div class="mb-3">
                        <label for="message{{ $testPage->id }}" class="form-label" style="font-weight: 600; color: #333;">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="message{{ $testPage->id }}" name="message" rows="4" required style="border-radius: 8px; padding: 12px; border: 2px solid #e0e0e0; resize: vertical; color: #333;">{{ old('message') }}</textarea>
                    </div>

                    <div class="form-message alert" style="display: none; border-radius: 8px;"></div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-lg submit-btn" style="border-radius: 8px; font-weight: 600; padding: 12px; background: var(--primary-color); color: var(--text-on-primary);">
                            <span class="submit-btn-text"><i class="bi bi-send me-2"></i>Submit Booking Request</span>
                            <span class="submit-btn-loading" style="display: none;">
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
@endforeach

<script>
// Wait for Bootstrap to load
function initBookTestForms() {
    if (typeof bootstrap === 'undefined') {
        setTimeout(initBookTestForms, 100);
        return;
    }

    // Handle all book test forms on the page
    const forms = document.querySelectorAll('.bookTestForm');
    
    forms.forEach(function(form) {
        const contactNumberInput = form.querySelector('.contact-number-input');
        const contactNumberError = form.querySelector('.contact-number-error');
        const formMessage = form.querySelector('.form-message');
        const submitBtn = form.querySelector('.submit-btn');
        const submitBtnText = form.querySelector('.submit-btn-text');
        const submitBtnLoading = form.querySelector('.submit-btn-loading');
        const modalId = form.closest('.modal').id;
        const modalElement = document.getElementById(modalId);
        let modal = null;
        
        if (modalElement && typeof bootstrap !== 'undefined') {
            modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        }

        // Format contact number input (only digits, max 10)
        if (contactNumberInput) {
            contactNumberInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
                if (value.length > 10) {
                    value = value.slice(0, 10);
                }
                e.target.value = value;
                validateContactNumber();
            });
        }

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
                    formMessage.className = 'form-message alert alert-success';
                    formMessage.textContent = data.message;
                    formMessage.style.display = 'block';
                    form.reset();
                    
                    // Close modal after 2 seconds
                    setTimeout(() => {
                        if (modal) {
                            modal.hide();
                        } else if (modalElement) {
                            const bsModal = bootstrap.Modal.getInstance(modalElement);
                            if (bsModal) {
                                bsModal.hide();
                            }
                        }
                        formMessage.style.display = 'none';
                    }, 2000);
                } else {
                    formMessage.className = 'form-message alert alert-danger';
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
                formMessage.className = 'form-message alert alert-danger';
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
                if (contactNumberError) {
                    contactNumberError.style.display = 'none';
                    contactNumberInput.classList.remove('is-invalid');
                }
            });
        }
    });
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initBookTestForms);
} else {
    initBookTestForms();
}
</script>

@endsection

