@extends('layouts.app')

<title>{{ $latest->system_name ?? 'APP' }} | Budget → Proposal -> Create</title>

@section('content')
    <div class="row mb-4"><h3><strong>Create</strong></h3></div>

    <div class="card">
        <div class="card-header">Submit Budget Proposal</div>
        <div class="card-body">
            <form action="{{ route('budget.budgetproposal.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" class="form-control" id="department" name="department" required>
                </div>

                <div class="mb-3">
                    <label for="purpose" class="form-label">Purpose</label>
                    <input type="text" class="form-control" id="purpose" name="purpose" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount (₱)</label>
                    <input type="number" class="form-control" id="amount" name="amount" min="0" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Proposal</button>
            </form>
        </div>
    </div>
@endsection
