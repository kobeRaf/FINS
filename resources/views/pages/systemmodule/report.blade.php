@extends('layouts.app')

    @php
    $sample = "GAGO KA EH"
    @endphp
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>System Report Template</span>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#templateModal">
                Create Template
            </button>
        </div>

    </div>

    {{-- Modal --}}
    <div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form class="modal-content" action="{{ route('report.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="templateModalLabel">Report Template Layout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 py-3">
                    {{-- HEADER --}}
                    <div class="d-flex justify-content-between align-items-center mb-4 text-center">
                        {{-- Left Logos --}}
                        <div class="d-flex">
                            @foreach (['1a', '1b'] as $suffix)
                                <div class="mx-2">
                                    <select name="header_logo_{{ $suffix }}" class="form-select mb-1" onchange="previewLogo(this, 'header-preview-{{ $suffix }}')">
                                        <option value="">Logo {{ strtoupper($suffix) }}</option>
                                        @foreach ($logo as $item)
                                            <option value="{{ $item->path }}" data-img="{{ asset('reportlogo/' . $item->path) }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <img id="header-preview-{{ $suffix }}" src="#" style="max-height: 60px; display: none;" class="img-fluid rounded shadow-sm">
                                </div>
                            @endforeach
                        </div>

                        {{-- Title + Subtitle --}}
                        <div>
                            <input type="text" name="report_title" class="form-control mb-1 text-center fw-bold" placeholder="Main Title">
                            <input type="text" name="report_subtitle" class="form-control text-center" placeholder="Subtitle">
                        </div>

                        {{-- Right Logos --}}
                        <div class="d-flex">
                            @foreach (['1c', '1d'] as $suffix)
                                <div class="mx-2">
                                    <select name="header_logo_{{ $suffix }}" class="form-select mb-1" onchange="previewLogo(this, 'header-preview-{{ $suffix }}')">
                                        <option value="">Logo {{ strtoupper($suffix) }}</option>
                                        @foreach ($logo as $item)
                                            <option value="{{ $item->path }}" data-img="{{ asset('reportlogo/' . $item->path) }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <img id="header-preview-{{ $suffix }}" src="#" style="max-height: 60px; display: none;" class="img-fluid rounded shadow-sm">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Body Placeholder --}}
                    <div class="text-center my-4 text-muted" style="min-height: 150px;">
                        <em>Report body content goes here...</em>
                    </div>

                    {{-- FOOTER --}}
                    <div class="d-flex justify-content-between align-items-center mt-4 text-center border-top pt-3">
                        {{-- Left Logos --}}
                        <div class="d-flex">
                            @foreach (['2a', '2b'] as $suffix)
                                <div class="mx-2">
                                    <select name="footer_logo_{{ $suffix }}" class="form-select mb-1" onchange="previewLogo(this, 'footer-preview-{{ $suffix }}')">
                                        <option value="">Logo {{ strtoupper($suffix) }}</option>
                                        @foreach ($logo as $item)
                                            <option value="{{ $item->path }}" data-img="{{ asset('reportlogo/' . $item->path) }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <img id="footer-preview-{{ $suffix }}" src="#" style="max-height: 50px; display: none;" class="img-fluid rounded shadow-sm">
                                </div>
                            @endforeach
                        </div>

                        {{-- Footer Title --}}
                        <div>
                            <input type="text" name="footer_title" class="form-control text-center fw-semibold" placeholder="Footer Title">
                        </div>

                        {{-- Right Logos --}}
                        <div class="d-flex">
                            @foreach (['2c', '2d'] as $suffix)
                                <div class="mx-2">
                                    <select name="footer_logo_{{ $suffix }}" class="form-select mb-1" onchange="previewLogo(this, 'footer-preview-{{ $suffix }}')">
                                        <option value="">Logo {{ strtoupper($suffix) }}</option>
                                        @foreach ($logo as $item)
                                            <option value="{{ $item->path }}" data-img="{{ asset('reportlogo/' . $item->path) }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <img id="footer-preview-{{ $suffix }}" src="#" style="max-height: 50px; display: none;" class="img-fluid rounded shadow-sm">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Template</button>
                </div>
            </form>
        </div>
    </div>

    @if($template->count())

    {{--Preview--}}
    <div class="row mt-4">
        @foreach($template as $template)
            
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Template Preview #{{ $loop->iteration }}</span>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTemplateModal{{ $template->id }}">
                            Edit
                        </button>
                    </div>
                    <div class="card-body">
                        {{-- HEADER --}}
                        <div class="d-flex justify-content-between align-items-center text-center mb-4">
                            <div class="d-flex">
                                @foreach (['1a', '1b'] as $suffix)
                                    @php $logoPath = $template["header_logo_$suffix"] ?? null; @endphp
                                    @if($logoPath)
                                        <img src="{{ asset('reportlogo/' . $logoPath) }}"
                                            class="img-fluid mx-2 rounded shadow-sm align-self-center"
                                            style="height: 60px; width: 60px;">
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">{{ $template->report_title }}</h5>
                                <small class="text-muted">{{ $template->report_subtitle }}</small>
                            </div>
                            <div class="d-flex">
                                @foreach (['1c', '1d'] as $suffix)
                                    @php $logoPath = $template["header_logo_$suffix"] ?? null; @endphp
                                    @if($logoPath)
                                        <img src="{{ asset('reportlogo/' . $logoPath) }}"
                                            class="img-fluid mx-2 rounded shadow-sm align-self-center"
                                            style="height: 60px; width: 60px;">
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="my-4 text-center text-muted" style="min-height: 100px;">
                            <em>{{$sample}}</em>
                        </div>

                        {{-- FOOTER --}}
                        <div class="d-flex justify-content-between align-items-center text-center border-top pt-3">
                            <div class="d-flex">
                                @foreach (['2a', '2b'] as $suffix)
                                    @php $logoPath = $template["footer_logo_$suffix"] ?? null; @endphp
                                    @if($logoPath)
                                        <img src="{{ asset('reportlogo/' . $logoPath) }}"
                                            class="img-fluid mx-2 rounded shadow-sm align-self-center"
                                            style="height: 60px; width: auto;">
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <strong>{{ $template->footer_title }}</strong>
                            </div>
                            <div class="d-flex">
                                @foreach (['2c', '2d'] as $suffix)
                                    @php $logoPath = $template["footer_logo_$suffix"] ?? null; @endphp
                                    @if($logoPath)
                                        <img src="{{ asset('reportlogo/' . $logoPath) }}"
                                            class="img-fluid mx-2 rounded shadow-sm align-self-center"
                                            style="height: 60px; width: auto;">
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="editTemplateModal{{ $template->id }}" tabindex="-1" aria-labelledby="editTemplateModalLabel{{ $template->id }}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <form class="modal-content" action="{{ route('report.update', $template->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Template #{{ $loop->iteration }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body px-4 py-3">
                            {{-- Reuse same header, footer layout fields here with prefilled values --}}
                            {{-- HEADER --}}
                            <div class="d-flex justify-content-between align-items-center mb-4 text-center">
                                <div class="d-flex">
                                    @foreach (['1a', '1b'] as $suffix)
                                        <div class="mx-2">
                                            <select name="header_logo_{{ $suffix }}" class="form-select mb-1" onchange="previewLogo(this, 'edit-header-preview-{{ $template->id }}-{{ $suffix }}')">
                                                <option value="">Logo {{ strtoupper($suffix) }}</option>
                                                @foreach ($logo as $item)
                                                    <option value="{{ $item->path }}" data-img="{{ asset('reportlogo/' . $item->path) }}"
                                                        @if($template["header_logo_$suffix"] === $item->path) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <img id="edit-header-preview-{{ $template->id }}-{{ $suffix }}" src="{{ asset('reportlogo/' . $template["header_logo_$suffix"]) }}" style="max-height: 60px;" class="img-fluid rounded shadow-sm">
                                        </div>
                                    @endforeach
                                </div>

                                <div>
                                    <input type="text" name="report_title" class="form-control mb-1 text-center fw-bold" value="{{ $template->report_title }}">
                                    <input type="text" name="report_subtitle" class="form-control text-center" value="{{ $template->report_subtitle }}">
                                </div>

                                <div class="d-flex">
                                    @foreach (['1c', '1d'] as $suffix)
                                        <div class="mx-2">
                                            <select name="header_logo_{{ $suffix }}" class="form-select mb-1" onchange="previewLogo(this, 'edit-header-preview-{{ $template->id }}-{{ $suffix }}')">
                                                <option value="">Logo {{ strtoupper($suffix) }}</option>
                                                @foreach ($logo as $item)
                                                    <option value="{{ $item->path }}" data-img="{{ asset('reportlogo/' . $item->path) }}"
                                                        @if($template["header_logo_$suffix"] === $item->path) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <img id="edit-header-preview-{{ $template->id }}-{{ $suffix }}" src="{{ asset('reportlogo/' . $template["header_logo_$suffix"]) }}" style="max-height: 60px;" class="img-fluid rounded shadow-sm">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="my-4 text-center text-muted" style="min-height: 100px;">
                                <em>Report body content goes here...</em>
                            </div>
                            {{--FOOTER--}}
                            <div class="d-flex justify-content-between align-items-center text-center border-top pt-3">
                                <div class="d-flex">
                                    @foreach (['2a', '2b'] as $suffix)
                                        <div class="mx-2">
                                            <select name="footer_logo_{{ $suffix }}" class="form-select mb-1" onchange="previewLogo(this, 'edit-footer-preview-{{ $template->id }}-{{ $suffix }}')">
                                                <option value="">Logo {{ strtoupper($suffix) }}</option>
                                                @foreach ($logo as $item)
                                                    <option value="{{ $item->path }}" data-img="{{ asset('reportlogo/' . $item->path) }}"
                                                        @if($template["footer_logo_$suffix"] === $item->path) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <img id="edit-footer-preview-{{ $template->id }}-{{ $suffix }}" src="{{ asset('reportlogo/' . $template["footer_logo_$suffix"]) }}" style="max-height: 50px;" class="img-fluid rounded shadow-sm">
                                        </div>
                                    @endforeach
                                </div>

                                <div>
                                    <input type="text" name="footer_title" class="form-control text-center fw-bold" value="{{ $template->footer_title }}">
                                </div>

                                <div class="d-flex">
                                    @foreach (['2c', '2d'] as $suffix)
                                        <div class="mx-2">
                                            <select name="footer_logo_{{ $suffix }}" class="form-select mb-1" onchange="previewLogo(this, 'edit-footer-preview-{{ $template->id }}-{{ $suffix }}')">
                                                <option value="">Logo {{ strtoupper($suffix) }}</option>
                                                @foreach ($logo as $item)
                                                    <option value="{{ $item->path }}" data-img="{{ asset('reportlogo/' . $item->path) }}"
                                                        @if($template["footer_logo_$suffix"] === $item->path) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <img id="edit-footer-preview-{{ $template->id }}-{{ $suffix }}" src="{{ asset('reportlogo/' . $template["footer_logo_$suffix"]) }}" style="max-height: 50px;" class="img-fluid rounded shadow-sm">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Template</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    @else
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>No templates available</span>
            </div>
        </div>
    @endif




    <script>
        function previewLogo(select, previewId) {
            const selected = select.options[select.selectedIndex];
            const imgPath = selected.getAttribute('data-img');
            const preview = document.getElementById(previewId);
            if (imgPath) {
                preview.src = imgPath;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
