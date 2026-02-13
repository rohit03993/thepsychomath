@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Test Page - {{ $testPage->title }}</h2>
    <a href="{{ route('admin.test-pages.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<form action="{{ route('admin.test-pages.update', $testPage->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <!-- Basic Information -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" 
                           value="{{ old('title', $testPage->title) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug" 
                           value="{{ old('slug', $testPage->slug) }}" required>
                    <small class="text-muted">URL-friendly version (e.g., aptitude-mappers)</small>
                </div>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                <select class="form-control" id="category" name="category" required>
                    <option value="psychological" {{ old('category', $testPage->category ?? 'psychological') == 'psychological' ? 'selected' : '' }}>Psychological</option>
                    <option value="aptitude" {{ old('category', $testPage->category ?? 'psychological') == 'aptitude' ? 'selected' : '' }}>Aptitude</option>
                    <option value="achievement" {{ old('category', $testPage->category ?? 'psychological') == 'achievement' ? 'selected' : '' }}>Achievement</option>
                    <option value="career" {{ old('category', $testPage->category ?? 'psychological') == 'career' ? 'selected' : '' }}>Career</option>
                    <option value="educational" {{ old('category', $testPage->category ?? 'psychological') == 'educational' ? 'selected' : '' }}>Educational</option>
                    <option value="social" {{ old('category', $testPage->category ?? 'psychological') == 'social' ? 'selected' : '' }}>Social</option>
                </select>
                <small class="text-muted">Select the test category. Only "Psychological" tests will appear on the /tests page.</small>
            </div>
            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea class="form-control" id="short_description" name="short_description" rows="2">{{ old('short_description', $testPage->short_description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="8">{{ old('content', $testPage->content) }}</textarea>
            </div>
        </div>
    </div>

    <!-- Images -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Images</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="hero_image" class="form-label">Hero Image</label>
                    @if($testPage->hero_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $testPage->hero_image) }}" alt="Hero Image" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" id="hero_image" name="hero_image" accept="image/*">
                    <small class="text-muted">Recommended size: 1920x600px</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="featured_image" class="form-label">Featured Image</label>
                    @if($testPage->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $testPage->featured_image) }}" alt="Featured Image" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                    <small class="text-muted">Recommended size: 800x800px</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Key Features</h5>
        </div>
        <div class="card-body">
            <div id="features-container">
                @foreach(old('features', $testPage->features ?? []) as $index => $feature)
                    <div class="mb-2 feature-row">
                        <div class="input-group">
                            <input type="text" class="form-control" name="features[]" 
                                   value="{{ $feature }}" placeholder="Enter feature">
                            <button type="button" class="btn btn-danger remove-feature">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-feature">
                <i class="bi bi-plus"></i> Add Feature
            </button>
        </div>
    </div>

    <!-- Test Details -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Test Details</h5>
        </div>
        <div class="card-body">
            <div id="test-details-container">
                @foreach(old('test_details', $testPage->test_details ?? []) as $key => $value)
                    <div class="mb-2 test-detail-row">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="test_details_key[]" 
                                       value="{{ $key }}" placeholder="Label (e.g., Duration)">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="test_details_value[]" 
                                       value="{{ $value }}" placeholder="Value (e.g., 90-120 minutes)">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger remove-test-detail">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-test-detail">
                <i class="bi bi-plus"></i> Add Test Detail
            </button>
        </div>
    </div>

    <!-- Who Can Take & What You Get -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Additional Information</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="who_can_take" class="form-label">Who Can Take This Test?</label>
                <textarea class="form-control" id="who_can_take" name="who_can_take" rows="4">{{ old('who_can_take', $testPage->who_can_take) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="what_you_get" class="form-label">What You'll Get</label>
                <textarea class="form-control" id="what_you_get" name="what_you_get" rows="4">{{ old('what_you_get', $testPage->what_you_get) }}</textarea>
            </div>
        </div>
    </div>

    <!-- SEO & Settings -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">SEO & Settings</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" 
                           value="{{ old('meta_title', $testPage->meta_title) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="order" class="form-label">Order <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="order" name="order" 
                           value="{{ old('order', $testPage->order) }}" min="0" required>
                    <small class="text-muted">Lower numbers appear first in menus</small>
                </div>
            </div>
            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $testPage->meta_description) }}</textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                       value="1" {{ old('is_active', $testPage->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active (Show on website)
                </label>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle"></i> Update Test Page
        </button>
        <a href="{{ route('admin.test-pages.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </div>
</form>

<script>
// Features management
let featureIndex = {{ count(old('features', $testPage->features ?? [])) }};
document.getElementById('add-feature').addEventListener('click', function() {
    const container = document.getElementById('features-container');
    const newFeature = document.createElement('div');
    newFeature.className = 'mb-2 feature-row';
    newFeature.innerHTML = `
        <div class="input-group">
            <input type="text" class="form-control" name="features[]" placeholder="Enter feature">
            <button type="button" class="btn btn-danger remove-feature">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(newFeature);
});

document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-feature')) {
        e.target.closest('.feature-row').remove();
    }
});

// Test Details management
document.getElementById('add-test-detail').addEventListener('click', function() {
    const container = document.getElementById('test-details-container');
    const newDetail = document.createElement('div');
    newDetail.className = 'mb-2 test-detail-row';
    newDetail.innerHTML = `
        <div class="row">
            <div class="col-md-5">
                <input type="text" class="form-control" name="test_details_key[]" placeholder="Label (e.g., Duration)">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="test_details_value[]" placeholder="Value (e.g., 90-120 minutes)">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-test-detail">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newDetail);
});

document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-test-detail')) {
        e.target.closest('.test-detail-row').remove();
    }
});

// Process test details before form submission
document.querySelector('form').addEventListener('submit', function(e) {
    const keys = document.querySelectorAll('input[name="test_details_key[]"]');
    const values = document.querySelectorAll('input[name="test_details_value[]"]');
    const testDetails = {};
    
    keys.forEach((keyInput, index) => {
        const key = keyInput.value.trim();
        const value = values[index].value.trim();
        if (key && value) {
            testDetails[key] = value;
        }
    });
    
    // Create hidden inputs for test_details
    Object.keys(testDetails).forEach(key => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `test_details[${key}]`;
        input.value = testDetails[key];
        this.appendChild(input);
    });
});
</script>
@endsection

