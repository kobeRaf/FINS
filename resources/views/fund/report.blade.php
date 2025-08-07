@extends('layouts.app')

<style>
    .logo-img {
        height: 100px;
        width: auto;
        object-fit: contain;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        body {
            padding: 0;
            margin: 0;
        }

        .card {
            border: none;
            box-shadow: none !important;
        }
    }
</style>

@section('content')
<div class="container my-3 no-print">
    <div class="d-flex justify-content-end gap-2">
        {{-- Print Button --}}
        <button onclick="printCard()" class="btn btn-md btn-primary">
            <i class="bi bi-printer me-1"></i> <strong>Print</strong>
        </button>
    </div>
</div>
<div class="container my-4">
    <div id="printableCard"> {{-- START of printable area --}}
        <div class="card print-page" style="padding: 20px;"> {{-- Ensure full page height for printing --}}
            <div class="print-body"> {{-- Expandable content pushes footer down --}}
                <div>
                    <div class="card-body">
                        {{-- Header --}}
                        <div class="mb-5 border-bottom pb-4">
                            <div class="d-flex justify-content-between align-items-center text-center flex-wrap">
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    @foreach (['1a', '1b'] as $suffix)
                                        @php $logo = $template["header_logo_$suffix"] ?? null; @endphp
                                        @if ($logo)
                                            <img src="{{ asset('reportlogo/' . $logo) }}" class="logo-img me-2">
                                        @endif
                                    @endforeach
                                </div>

                                <div class="flex-grow-1 text-center">
                                    <h4 class="fw-bold mb-0">{{ $template->report_title }}</h4>
                                    <small class="text-muted">{{ $template->report_subtitle }}</small>
                                </div>

                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    @foreach (['1c', '1d'] as $suffix)
                                        @php $logo = $template["header_logo_$suffix"] ?? null; @endphp
                                        @if ($logo)
                                            <img src="{{ asset('reportlogo/' . $logo) }}" class="logo-img ms-2">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Title --}}
                        <div class="text-center mt-3">
                            <h5 class="fw-bold">List of Funds</h5>
                        </div>

                        {{-- Table --}}
                        <div class="print-content mt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Fund Type</th>
                                        <th>Fund Title</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($funds as $fund)
                                        <tr>
                                            <td>{{ $fund->type }}</td>
                                            <td>{{ $fund->fund_type }}</td>
                                            <td>{{ $fund->fund_title }}</td>
                                            <td>{{ $fund->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No fund records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div> {{-- card-body --}}
                </div>
            </div>

            {{-- Footer always at the bottom --}}
            <div class="report-footer mt-5 ">
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        @foreach (['2a', '2b'] as $suffix)
                            @php $logo = $template["footer_logo_$suffix"] ?? null; @endphp
                            @if ($logo)
                                <img src="{{ asset('reportlogo/' . $logo) }}" class="logo-img me-2">
                            @endif
                        @endforeach
                    </div>
                    <div class="text-center">
                        <small class="text-muted">{{ $template->footer_title }}</small>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        @foreach (['2c', '2d'] as $suffix)
                            @php $logo = $template["footer_logo_$suffix"] ?? null; @endphp
                            @if ($logo)
                                <img src="{{ asset('reportlogo/' . $logo) }}" class="logo-img ms-2">
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- END of printable area --}}
</div>

{{-- JavaScript --}}
<script>
    function printCard() {
        const printContents = document.getElementById('printableCard').innerHTML;
        const printWindow = window.open('', '', 'width=800,height=800');

        printWindow.document.write(`
            <html>
            <head>
                <title>Print Report</title>
                <!-- Bootstrap CSS -->
                <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
                <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
                <link rel="stylesheet" href="{{ asset('bootstrap/css/navbar.css') }}">
                <style>
                    html, body {
                        height: 100%;
                        margin: 0;
                        padding: 0;
                    }

                    .print-page {
                        display: flex;
                        flex-direction: column;
                        min-height: 100vh;
                        padding: 20px;
                        font-family: Arial, sans-serif;
                    }

                    .print-body {
                        flex: 1;
                    }

                    .logo-img {
                        height: 60px;
                        width: auto;
                        object-fit: contain;
                    }

                    .card {
                        border: none;
                        box-shadow: none !important;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    th, td {
                        border: 1px solid #000;
                        padding: 8px;
                        text-align: left;
                    }

                    h4, h5 {
                        margin: 0;
                        padding: 0;
                    }

                    @media print {
                        .no-print {
                            display: none !important;
                        }

                        .card {
                            border: none;
                            box-shadow: none !important;
                        }

                        .print-page {
                            padding: 0;
                            margin: 0;
                        }
                    }
                </style>
            </head>
            <body onload="window.print(); window.close();">
                <div class="print-page">
                    <div class="print-body">
                        ${printContents}
                    </div>
                </div>
            </body>
            </html>
        `);

        printWindow.document.close();
    }
</script>
@endsection
