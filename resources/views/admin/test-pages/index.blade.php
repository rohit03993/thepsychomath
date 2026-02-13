@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Test Pages</h2>
</div>

@if($testPages->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testPages as $testPage)
                            <tr>
                                <td>{{ $testPage->order }}</td>
                                <td><strong>{{ $testPage->title }}</strong></td>
                                <td>
                                    <span class="badge {{ $testPage->category == 'psychological' ? 'bg-primary' : 'bg-info' }}">
                                        {{ ucfirst($testPage->category ?? 'psychological') }}
                                    </span>
                                </td>
                                <td><code>{{ $testPage->slug }}</code></td>
                                <td>
                                    <span class="badge {{ $testPage->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $testPage->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.test-pages.edit', $testPage->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="{{ route('test-pages.show', $testPage->slug) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> View
                                    </a>
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
        <p>No test pages found. Please run the seeder to create test pages.</p>
    </div>
@endif
@endsection

