@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <h3><strong>Entities</strong></h3>
</div>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Entity List</span>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#entityModal">
            <i class="bi bi-plus-lg me-1"></i> <strong>Add Entity</strong>
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success m-3" id="success-alert">{{ session('success') }}</div>
    @endif

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table text-center">
                    <tr>
                        <th>Reference No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entities as $item)
                        <tr>
                            <td>{{ $item->reference_no }}</td>
                            <td>{{ $item->entity_name }}</td>
                            <td>{{ $item->entity_type ?? '-' }}</td>
                            <td>{{ $item->entity_address ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No entities found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="entityModal" tabindex="-1" aria-labelledby="entityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('entity.store') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="entityModalLabel">Add Entity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Entity Name</label>
                    <input type="text" class="form-control" name="entity_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Entity Type</label>
                    <select name="entity_type" class="form-select" required>
                        <option value="Supplier">Supplier</option>
                        <option value="Contractor">Contractor</option>
                        <option value="Employee">Employee</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="entity_address">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
