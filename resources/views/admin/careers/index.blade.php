@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2>Career Library</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.careers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Career
        </a>
        <a href="{{ route('careers.index') }}" target="_blank" class="btn btn-info">
            <i class="bi bi-eye"></i> View on Site
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($careers->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($careers as $career)
                            <tr>
                                <td>{{ $career->order }}</td>
                                <td><strong>{{ $career->title }}</strong></td>
                                <td><code>{{ $career->slug }}</code></td>
                                <td>
                                    <span class="badge {{ $career->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $career->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.careers.edit', $career->id) }}" class="btn btn-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="{{ route('careers.show', $career->slug) }}" target="_blank" class="btn btn-info">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <form action="{{ route('admin.careers.destroy', $career->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete {{ $career->title }}? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info">
        <p>No careers found. Run <code>php artisan db:seed --class=CareerSeeder</code> to create career library pages.</p>
    </div>
@endif
@endsection
