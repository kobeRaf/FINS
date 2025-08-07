@extends('layouts.app')
<style>
    .logo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.2);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
    }

    .logo-container:hover .logo-overlay {
        opacity: 1;
    }

    .logo-overlay .btn {
        min-width: 75px;
    }

    .logo-overlay form {
        margin: 0;  /* prevent spacing */
        padding: 0;
        display: inline-block; /* align inline like the button */
    }
</style>
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>System Logo Uploaded</span>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#logoModal">
            <i class="bi bi-upload me-2"></i>Upload Logo
        </button>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
        @endif

        @if($logo->count())
            <div class="text-center">
                <div class="row justify-content-center">
                    @foreach($logo as $item)
                        <div class="col-md-3 col-sm-4 col-6 mb-4 text-center position-relative">
                            <div class="logo-container position-relative">
                                <img src="{{ asset('reportlogo/' . $item->path) }}"
                                    alt="{{ $item->name }}"
                                    class="img-fluid rounded shadow-lg mb-2"
                                    style="max-height: 150px; object-fit: contain; background: white;">

                                <div class="logo-overlay d-flex justify-content-center align-items-center">
                                    <div class="d-flex gap-2 align-items-center">
                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                            Edit
                                        </button>

                                        <!-- Delete Button inside form -->
                                        <form action="{{ route('logo.destroy', $item->id) }}" method="POST" class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0 text-muted small">{{ $item->name }}</p>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" action="{{ route('logo.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Logo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="name{{ $item->id }}">Logo Name</label>
                                            <input type="text" name="name" id="name{{ $item->id }}" class="form-control" value="{{ $item->name }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="logo{{ $item->id }}">Replace Image (optional)</label>
                                            <input type="file" name="logo" id="logo{{ $item->id }}" class="form-control" accept="image/*" onchange="previewEditImage(event, 'edit-preview-{{ $item->id }}')">
                                            <div class="mt-3 text-center">
                                                <img id="edit-preview-{{ $item->id }}" src="{{ asset('reportlogo/' . $item->path) }}" alt="Preview" class="img-fluid rounded shadow" style="max-height: 150px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update Logo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @else
            <div class="text-center text-muted py-4">
                <h5>No logos uploaded yet.</h5>
            </div>
        @endif
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="logoModal" tabindex="-1" aria-labelledby="logoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('logo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="logoModalLabel">Upload Logo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="name">Logo Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="logo">Upload Image</label>
                    <input type="file" name="logo" id="logo" class="form-control" accept="image/*" required onchange="previewImage(event)">
                    <div class="mt-3 text-center">
                        <img id="logo-preview" src="#" alt="Logo Preview" class="img-fluid rounded shadow-lg d-none" style="max-height: 150px;">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    Upload Logo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('logo-preview');
            preview.src = reader.result;
            preview.classList.remove('d-none');
        }
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
    function previewEditImage(event, previewId) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById(previewId);
            preview.src = reader.result;
        }
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
