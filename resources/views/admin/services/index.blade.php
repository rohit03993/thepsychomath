@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Services Section</h2>
    @if($service)
        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit Content
        </a>
    @else
        <p class="text-muted">No content found. Please create initial content.</p>
    @endif
</div>

@if($service)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $service->title }}</h5>
            @if($service->subtitle)
                <p class="text-muted">{{ $service->subtitle }}</p>
            @endif
            
            <div class="mt-3">
                <h6>Service Items:</h6>
                <div class="row">
                    @foreach($service->items ?? [] as $item)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="{{ $item['icon'] ?? '' }}" style="font-size: 2rem; color: #14b8a6;"></i>
                                    <h6 class="mt-2">{{ $item['title'] ?? '' }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="mt-3">
                <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-secondary' }}">
                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info">
        <p>No Services content found. Please create initial content by running the seeder or manually adding content.</p>
    </div>
@endif
@endsection
