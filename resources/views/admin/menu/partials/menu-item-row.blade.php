<div class="menu-item-row d-flex align-items-center p-3" data-id="{{ $item->id }}">
    <div class="drag-handle me-3">
        <i class="bi bi-grip-vertical"></i>
    </div>
    <div class="flex-grow-1">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $item->title }}</strong>
                <span class="badge bg-secondary ms-2">{{ $item->type }}</span>
                @if($item->link)
                    <small class="text-muted d-block mt-1">{{ $item->link }}</small>
                @endif
                @if(!$item->is_active)
                    <span class="badge bg-warning ms-2">Inactive</span>
                @endif
            </div>
            <div class="btn-group btn-group-sm">
                <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this menu item?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@if($item->children && $item->children->count() > 0)
    <div class="menu-item-children">
        @foreach($item->children as $child)
            @include('admin.menu.partials.menu-item-row', ['item' => $child, 'level' => ($level + 1)])
        @endforeach
    </div>
@endif
