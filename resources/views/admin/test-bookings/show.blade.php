@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Test Booking Details</h2>
    <div>
        <a href="{{ route('admin.test-bookings.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        <form action="{{ route('admin.test-bookings.destroy', $booking->id) }}" method="POST" 
              onsubmit="return confirm('Are you sure you want to delete this booking?');" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash"></i> Delete
            </button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Booking Information</h5>
                @if($booking->is_read)
                    <span class="badge bg-success">Read</span>
                @else
                    <span class="badge bg-warning">Unread</span>
                @endif
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-muted">Name</label>
                    <p class="form-control-plaintext fs-5"><strong>{{ $booking->name }}</strong></p>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Contact Number</label>
                    <p class="form-control-plaintext fs-5">
                        <a href="tel:{{ $booking->contact_number }}" class="text-decoration-none">
                            <i class="bi bi-telephone-fill me-2"></i>{{ $booking->contact_number }}
                        </a>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Email Address</label>
                    <p class="form-control-plaintext fs-5">
                        <a href="mailto:{{ $booking->email }}" class="text-decoration-none">
                            <i class="bi bi-envelope-fill me-2"></i>{{ $booking->email }}
                        </a>
                    </p>
                </div>

                @if($booking->testPage)
                    <div class="mb-3">
                        <label class="form-label text-muted">Test Booked</label>
                        <p class="form-control-plaintext fs-5">
                            <span class="badge bg-info fs-6">{{ $booking->testPage->title }}</span>
                        </p>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label text-muted">Message</label>
                    <div class="border rounded p-3 bg-light">
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $booking->message }}</p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Submitted On</label>
                    <p class="form-control-plaintext">
                        <i class="bi bi-calendar3 me-2"></i>{{ $booking->created_at->format('F d, Y') }}
                        <i class="bi bi-clock me-2 ms-3"></i>{{ $booking->created_at->format('h:i A') }}
                    </p>
                </div>

                @if($booking->read_at)
                    <div class="mb-3">
                        <label class="form-label text-muted">Read On</label>
                        <p class="form-control-plaintext">
                            <i class="bi bi-calendar-check me-2"></i>{{ $booking->read_at->format('F d, Y h:i A') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="tel:{{ $booking->contact_number }}" class="btn btn-primary">
                        <i class="bi bi-telephone-fill me-2"></i>Call {{ $booking->name }}
                    </a>
                    <a href="mailto:{{ $booking->email }}?subject=Re: Test Booking - {{ $booking->testPage ? $booking->testPage->title : 'The Psycho Math' }}" class="btn btn-info">
                        <i class="bi bi-envelope-fill me-2"></i>Send Email
                    </a>
                    <a href="https://wa.me/{{ str_replace(['+', ' '], '', $booking->contact_number) }}" target="_blank" class="btn btn-success">
                        <i class="bi bi-whatsapp me-2"></i>WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

