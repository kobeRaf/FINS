@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <h3><strong>Accounts</strong></h3>
</div>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Account List</span>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#accountModal">
            <i class="bi bi-plus-lg me-1"></i> <strong>Add Account</strong>
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
                        <th>Account Code</th>
                        <th>Account Name</th>
                        <th>Classification</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accounts as $item)
                        <tr>
                            <td>{{ $item->reference_no }}</td>
                            <td>{{ $item->account_code }}</td>
                            <td>{{ $item->account_name }}</td>
                            <td>{{ $item->account_classification }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No accounts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('account.store') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="accountModalLabel">Add Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Account Code</label>
                    <input type="text" class="form-control" name="account_code" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Account Name</label>
                    <input type="text" class="form-control" name="account_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Account Classification</label>
                    <select name="account_classification" class="form-select" required>
                        <option value="Assets">Assets</option>
                        <option value="Liabilities">Liabilities</option>
                        <option value="Equity">Equity</option>
                        <option value="Revenue">Revenue</option>
                        <option value="Expenses">Expenses</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
