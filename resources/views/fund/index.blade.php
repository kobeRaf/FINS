@extends('layouts.app')

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Fund Management</span>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#fundModal">
                    <i class="bi bi-plus-lg me-1"></i> <strong>Add Fund</strong>
                </button>
                <a href="{{ route('fund.report', $template->id) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-printer me-1"></i> <strong>Fund Report</strong>
                </a>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success m-4" id="success-alert">{{ session('success') }}</div>
        @endif

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table text-center">
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Fund Type</th>
                            <th>Fund Title</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($funds as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->fund_type }}</td>
                                <td>{{ $item->fund_title }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No fund records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- Modal --}}
    <div class="modal fade" id="fundModal" tabindex="-1" aria-labelledby="fundModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('fund.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="fundModalLabel">Add Fund</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <input type="text" class="form-control" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fund Type</label>
                        <input type="text" class="form-control" name="fund_type" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fund Title</label>
                        <input type="text" class="form-control" name="fund_title" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection
