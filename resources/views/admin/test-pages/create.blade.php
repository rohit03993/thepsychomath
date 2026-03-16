@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Create Test Page</h2>
    <a href="{{ route('admin.test-pages.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<form action="{{ route('admin.test-pages.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
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
                           value="{{ old('title') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug" 
                           value="{{ old('slug') }}" required>
                    <small class="text-muted">URL-friendly version (e.g., new-psychological-test)</small>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <p class="form-control-plaintext mb-0"><span class="badge bg-primary">Psychological</span></p>
                <input type="hidden" name="category" value="psychological">
                <small class="text-muted">All tests are created as Psychological tests.</small>
            </div>
            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea class="form-control" id="short_description" name="short_description" rows="2">{{ old('short_description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="8">{{ old('content') }}</textarea>
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
                    <input type="file" class="form-control" id="hero_image" name="hero_image" accept="image/*">
                    <small class="text-muted">Recommended size: 1920x600px</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="featured_image" class="form-label">Featured Image</label>
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
                @foreach(old('features', []) as $feature)
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
                @if(old('test_details_key'))
                    @foreach(old('test_details_key', []) as $index => $key)
                        <div class="mb-2 test-detail-row">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="test_details_key[]" 
                                           value="{{ $key }}" placeholder="Label (e.g., Duration)">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="test_details_value[]" 
                                           value="{{ old('test_details_value.' . $index) }}" placeholder="Value (e.g., 90-120 minutes)">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger remove-test-detail">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
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
                <textarea class="form-control" id="who_can_take" name="who_can_take" rows="4">{{ old('who_can_take') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="what_you_get" class="form-label">What You'll Get</label>
                <textarea class="form-control" id="what_you_get" name="what_you_get" rows="4">{{ old('what_you_get') }}</textarea>
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
                           value="{{ old('meta_title') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="order" class="form-label">Order</label>
                    <input type="number" class="form-control" id="order" name="order" 
                           value="{{ old('order') }}" min="0">
                    <small class="text-muted">Lower numbers appear first in lists. Leave empty to place at the end.</small>
                </div>
            </div>
            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                       value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active (Show on website)
                </label>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle"></i> Create Test Page
        </button>
        <a href="{{ route('admin.test-pages.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </div>
</form>

<script>
// Auto-generate slug from title (ignoring common stop words)
document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    if (!titleInput || !slugInput) return;

    const stopWords = [
        'a','an','the','and','or','but','for','nor','so','yet',
        'of','in','on','at','to','from','by','with','about','into',
        'through','during','before','after','above','below','up','down',
        'over','under'
    ];

    let slugManuallyChanged = false;

    slugInput.addEventListener('input', function () {
        // If user types in slug, stop auto-syncing
        slugManuallyChanged = slugInput.value.trim().length > 0;
    });

    titleInput.addEventListener('input', function () {
        if (slugManuallyChanged) {
            return;
        }

        const raw = titleInput.value.toLowerCase();

        // Replace non-alphanumeric characters with spaces
        const cleaned = raw.replace(/[^a-z0-9]+/g, ' ');

        const slug = cleaned
            .split(' ')
            .filter(Boolean)
            .filter(word => !stopWords.includes(word))
            .join('-')
            .replace(/-+/g, '-')      // collapse multiple dashes
            .replace(/^-|-$/g, '');   // trim leading/trailing dashes

        slugInput.value = slug;
    });
});

// Features management
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
</script>
@endsection

