@extends('layouts.app')

    <title>{{ $latest->system_name ?? 'APP' }} | Treasury</title>

@section('content')
    <div class="row mb-4"><h3><strong>Treasury</strong></h3></div>
    <div class="card mb-4">
        <div class="card-header">Card 1</div>
        <div class="card-body">
            <p>Sample Text</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Card 2</div>
                <div class="card-body">
                    <p>Sample Text</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Card 3</div>
                <div class="card-body">
                    <p>Sample Text</p>
                </div>
            </div>
        </div>
    </div>

@endsection