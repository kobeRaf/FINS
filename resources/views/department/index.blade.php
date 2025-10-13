@extends('layouts.app')

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Departments</span>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#fundModal">
                    <i class="bi bi-plus-lg me-1"></i> <strong>Add Department</strong>
                </button>
                {{-- <a href="{{ route('department.report', $template->id) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-printer me-1"></i> <strong>Fund Report</strong>
                </a> --}}
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
                            <th>Department Name</th>
                            <th>Department Head</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($department as $item)
                            <tr>
                                <td>{{ $item->department_acronym}} - {{ $item->department_name}}</td>
                                <td>{{ $item->department_head }}</td>
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
            <form class="modal-content" method="POST" action="{{ route('department.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="fundModalLabel">Add Deparment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Department Acronym</label>
                        <input type="text" class="form-control" name="department_acronym" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department Name</label>
                        <input type="text" class="form-control" name="department_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department Head</label>
                        <input type="text" class="form-control" name="department_head" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection
