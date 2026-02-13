@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2>Menu Management</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Menu Item
        </a>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-info">
            <i class="bi bi-eye"></i> View Site
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Menu Items</h5>
        <small class="text-muted">Drag items to reorder, or use the order field to set position</small>
    </div>
    <div class="card-body">
        @if($menuItems->count() > 0)
            <div id="menu-items-list" class="list-group">
                @foreach($menuItems as $item)
                    @include('admin.menu.partials.menu-item-row', ['item' => $item, 'level' => 0])
                @endforeach
            </div>
        @else
            <p class="text-muted mb-0">No menu items yet. <a href="{{ route('admin.menu.create') }}">Create your first menu item</a></p>
        @endif
    </div>
</div>

<!-- Reorder Form (hidden, submitted via JS) -->
<form id="reorder-form" method="POST" action="{{ route('admin.menu.reorder') }}" style="display: none;">
    @csrf
    <input type="hidden" name="items" id="reorder-items">
</form>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const list = document.getElementById('menu-items-list');
    if (!list) return;

    const sortable = Sortable.create(list, {
        handle: '.drag-handle',
        animation: 150,
        onEnd: function(evt) {
            updateOrder();
        }
    });

    function updateOrder() {
        const items = [];
        const rows = list.querySelectorAll('.menu-item-row');
        rows.forEach((row, index) => {
            const id = row.dataset.id;
            if (id) {
                items.push({ id: id, order: index });
            }
        });

        document.getElementById('reorder-items').value = JSON.stringify(items);
        document.getElementById('reorder-form').submit();
    }
});
</script>

<style>
.menu-item-row {
    cursor: move;
    border: 1px solid #dee2e6;
    margin-bottom: 8px;
    border-radius: 4px;
    background: #fff;
}
.menu-item-row:hover {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.drag-handle {
    cursor: grab;
    color: #6c757d;
    font-size: 1.2rem;
    padding: 8px;
}
.drag-handle:active {
    cursor: grabbing;
}
.menu-item-children {
    margin-left: 30px;
    margin-top: 8px;
    border-left: 2px solid #e9ecef;
    padding-left: 15px;
}
</style>
@endsection
