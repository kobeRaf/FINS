@extends('layouts.app')

    <title>{{ $latest->system_name ?? 'APP' }} | Treasury</title>

@section('content')
    <div class="row mb-4"><h3><strong>For Out Page</strong></h3></div>
        <div class="card mb-4">
            <div class="card-header">Card 1</div>
            <div class="card-body">
                <p>Sample Text</p>
            </div>
        </div>
    </div>

@endsection