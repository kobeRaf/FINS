@extends('layouts.app')

    <title>{{ $latest->system_name ?? 'APP' }} | Budget -> Proposal List</title>

@section('content')
    <div class="row mb-4"><h3><strong>Budget -> Proposal List</strong></h3></div>
    <div class="card mb-4">
        <div class="card-header"></div>
        <div class="card-body">
            <p>Proposed budget will be listed here!</p>
        </div>
    </div>
@endsection
