@extends('layouts.app')


@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>System Theme Settings</span>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#themeModal">
            {{ $latest ? 'Edit Theme' : 'Add Theme' }}
        </button>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
        @endif

        @if($latest)
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-4">
                        <h5 class="mb-2">System Logo</h5>
                        @if($latest->logo)
                            <div class="border rounded shadow-sm p-2 d-inline-block bg-light">
                                <img src="{{ asset('systemlogo/' . $latest->logo) }}" alt="Current Logo"
                                     style="max-height: 150px; max-width: 100%; display: block;">
                            </div>
                        @else
                            <div class="text-muted">No logo set</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="mb-3">
                        <h6 class="mb-1">Theme Color:</h6>
                        <div class="d-flex gap-2">
                            <div class="border rounded" style="width: 50px; height: 30px; background-color: {{ $latest->theme_color ?? '#000' }};"></div>
                            <div class="border rounded" style="width: 50px; height: 30px; background-color: {{ $latest->bg_color ?? '#000' }};"></div>
                            <div class="border rounded" style="width: 50px; height: 30px; background-color: {{ $latest->text_color ?? '#000' }};"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h6 class="mb-1">System Name:</h6>
                        <div class="text-dark">{{ $latest->system_name ?? 'N/A' }}</div>
                    </div>

                    <div class="mb-2">
                        <h6 class="mb-1">Sub-system Name:</h6>
                        <div class="text-dark">{{ $latest->sub_system_name ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="mb-3">
                        <div class="mb-2">
                            <h6 class="mb-1">Created Date:</h6>
                            <div class="text-dark">{{ $latest->created_at ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h6 class="mb-1">Updated Date:</h6>
                        <div class="text-dark">{{ $latest->updated_at ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center text-muted py-4">
                <h5>No system theme is set yet.</h5>
                <p>Click the <strong>"Add Theme"</strong> button to create one.</p>
            </div>
        @endif
    </div>
</div>

{{-- Modal for Edit Form --}}
<div class="modal fade" id="themeModal" tabindex="-1" aria-labelledby="themeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('system.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="themeModalLabel">{{ $latest ? 'Edit Theme Settings' : 'Add Theme Settings' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- Logo --}}
                <div class="form-group">
                    <label for="logo">System Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*" onchange="previewImage(event)">
                    
                    <div class="mt-2 text-center">
                        @if(isset($latest->logo))
                            <img id="logo-preview" src="{{ asset('systemlogo/' . $latest->logo) }}" alt="Logo Preview" style="max-height: 150px;">
                        @else
                            <img id="logo-preview" src="#" alt="Logo Preview" style="display: none; max-height: 150px;">
                        @endif
                    </div>
                </div>
                @php
                $themePresets = [
                    ['name' => 'Default', 'theme_color' => '#007bff', 'bg_color' => '#f8f9fa', 'text_color' => '#212529'],
                    ['name' => 'Dark Mode', 'theme_color' => '#343a40', 'bg_color' => '#212529', 'text_color' => '#ffffff'],
                    ['name' => 'Sunset', 'theme_color' => '#ff6f61', 'bg_color' => '#ffe5b4', 'text_color' => '#4b2e2e'],
                    ['name' => 'Forest', 'theme_color' => '#228B22', 'bg_color' => '#e6ffe6', 'text_color' => '#003300'],
                ];
                @endphp
                <!-- Preset Theme Picker -->
                <div class="form-group">
                    <label>Select a Preset Theme</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($themePresets as $preset)
                            <div class="border rounded p-2 text-center" style="cursor: pointer; width: 100px;"
                                onclick="applyPreset('{{ $preset['theme_color'] }}', '{{ $preset['bg_color'] }}', '{{ $preset['text_color'] }}')">
                                <div style="height: 20px; background-color: {{ $preset['theme_color'] }}"></div>
                                <div style="height: 20px; background-color: {{ $preset['bg_color'] }}"></div>
                                <div style="height: 20px; background-color: {{ $preset['text_color'] }}"></div>
                                <small class="d-block mt-1">{{ $preset['name'] }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Manual Custom Input -->
                <hr>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="theme_color">Theme Color</label>
                        <input type="color" class="form-control form-control-color" name="theme_color" value="{{ $latest->theme_color ?? '#007bff' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bg_color">Background Color</label>
                        <input type="color" class="form-control form-control-color" name="bg_color" value="{{ $latest->bg_color ?? '#ffffff' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="text_color">Text Color</label>
                        <input type="color" class="form-control form-control-color" name="text_color" value="{{ $latest->text_color ?? '#000000' }}">
                    </div>
                </div>


                {{-- System Name --}}
                <div class="form-group mt-2">
                    <label for="system_name">System Name</label>
                    <input type="text" name="system_name" class="form-control"
                        value="{{ old('system_name', $latest->system_name ?? '') }}">
                </div>

                {{-- Sub-system Name --}}
                <div class="form-group mt-2">
                    <label for="sub_system_name">Sub-system Name</label>
                    <input type="text" name="sub_system_name" class="form-control"
                        value="{{ old('sub_system_name', $latest->sub_system_name ?? '') }}">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    {{ $latest ? 'Edit Theme' : 'Add Theme' }}
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Image Preview JS --}}
<script>
function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function(){
        const preview = document.getElementById('logo-preview');
        preview.src = reader.result;
        preview.style.display = 'block';
    }
    if (input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}

function applyPreset(theme, bg, text) {
    document.querySelector('input[name="theme_color"]').value = theme;
    document.querySelector('input[name="bg_color"]').value = bg;
    document.querySelector('input[name="text_color"]').value = text;
}
</script>
@endsection
