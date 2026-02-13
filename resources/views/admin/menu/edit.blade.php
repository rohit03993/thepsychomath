@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Menu Item</h2>
    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Back to Menu</a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Menu Item Details</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $menuItem->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                <select class="form-select" id="type" name="type" required>
                    <option value="link" {{ old('type', $menuItem->type) == 'link' ? 'selected' : '' }}>Link</option>
                    <option value="scroll" {{ old('type', $menuItem->type) == 'scroll' ? 'selected' : '' }}>Scroll</option>
                    <option value="dropdown" {{ old('type', $menuItem->type) == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
                </select>
            </div>

            <div class="mb-3" id="link-field">
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control" id="link" name="link" value="{{ old('link', $menuItem->link) }}" placeholder="e.g., /careers or #contact">
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">Parent Menu (Optional)</label>
                <select class="form-select" id="parent_id" name="parent_id">
                    <option value="">None (Top Level)</option>
                    @foreach($parentMenus as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $menuItem->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="order" class="form-label">Order <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $menuItem->order) }}" min="0" required>
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icon (Optional)</label>
                <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $menuItem->icon) }}" placeholder="e.g., bi bi-home">
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $menuItem->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Update Menu Item</button>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>

<script>
document.getElementById('type').addEventListener('change', function() {
    const linkField = document.getElementById('link-field');
    if (this.value === 'dropdown') {
        linkField.style.display = 'none';
    } else {
        linkField.style.display = 'block';
    }
});
document.getElementById('type').dispatchEvent(new Event('change'));
</script>
@endsection
