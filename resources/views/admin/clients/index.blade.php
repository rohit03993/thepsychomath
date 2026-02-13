@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Clients / Collaborators</h2>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Client
    </a>
</div>

@if($clients->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Initials</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->order }}</td>
                                <td>
                                    @if($client->logo)
                                        <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" 
                                             class="img-thumbnail" style="max-width: 60px; max-height: 60px; object-fit: contain;">
                                    @elseif($client->initials)
                                        <div class="logo-circle-small">{{ $client->initials }}</div>
                                    @else
                                        <span class="text-muted">No logo</span>
                                    @endif
                                </td>
                                <td><strong>{{ $client->name }}</strong></td>
                                <td>{{ $client->initials ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $client->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $client->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this client?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
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
        <p>No clients found. <a href="{{ route('admin.clients.create') }}">Add your first client</a></p>
    </div>
@endif

<style>
.logo-circle-small {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
    color: #212529;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
}
</style>
@endsection
