@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => ''])

    {{-- Header Bar --}}
    <div class="card shadow-lg mx-4">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-lg d-flex gap-2">
                    {{-- Download PDF --}}
                    <div class="nav-wrapper position-relative end-0">
                        <button class="btn btn-danger mb-0">
                            <i class="fas fa-file-pdf me-1"></i>
                            <span class="font-weight-bold">Download PDF</span>
                        </button>
                    </div>
                    {{-- Export Excel --}}
                    <div class="nav-wrapper position-relative end-0">
                        <button class="btn btn-success mb-0">
                            <i class="fas fa-file-excel me-1"></i>
                            <span class="font-weight-bold">Export Excel</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">

        {{-- Row 1: Tahun Lalu --}}
        <div class="row mb-4">
            {{-- Tabel Tahun Lalu --}}
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="mb-3">Tahun Lalu (2024) &ndash; Temuan Audit</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered align-middle">
                                <thead>
                                    <tr style="background-color:#1a7a7d; color:#fff;">
                                        <th>Departemen</th>
                                        <th class="text-center">Minor</th>
                                        <th class="text-center">Rekom</th>
                                        <th class="text-center">ISO 9001</th>
                                        <th class="text-center">ISO 45001</th>
                                        <th class="text-center">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <tr>
                                        <td>QMR</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center fw-bold">1</td>
                                    </tr>
                                    <tr>
                                        <td>Marketing H</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">2</td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">1</td>
                                        <td class="text-center fw-bold">2</td>
                                    </tr>
                                    <tr>
                                        <td>Production B</td>
                                        <td class="text-center">5</td>
                                        <td class="text-center">5</td>
                                        <td class="text-center">3</td>
                                        <td class="text-center">7</td>
                                        <td class="text-center fw-bold">10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grafik Tahun Lalu --}}
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="mb-3">Grafik Temuan Audit 2024</h6>
                        <canvas id="chartLalu" height="200"></canvas>
                        <div class="d-flex justify-content-center gap-3 mt-2">
                            <small><span style="color:#f4a261;">&#9658;</span> ISO 45001</small>
                            <small><span style="color:#2a9d8f;">&#9658;</span> ISO 9001</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- end Row 1 --}}

        {{-- Row 2: Tahun Ini --}}
        <div class="row mb-4">
            {{-- Tabel Tahun Ini --}}
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="mb-3">Tahun Ini (2025) &ndash; Temuan Audit</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered align-middle">
                                <thead>
                                    <tr style="background-color:#1a7a7d; color:#fff;">
                                        <th>Departemen</th>
                                        <th class="text-center">Minor</th>
                                        <th class="text-center">Rekom</th>
                                        <th class="text-center">ISO 9001</th>
                                        <th class="text-center">ISO 45001</th>
                                        <th class="text-center">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <tr>
                                        <td>QMR</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center fw-bold">0</td>
                                    </tr>
                                    <tr>
                                        <td>Production A</td>
                                        <td class="text-center">2</td>
                                        <td class="text-center">2</td>
                                        <td class="text-center">4</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center fw-bold">4</td>
                                    </tr>
                                    <tr>
                                        <td>Jisuken</td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">5</td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">5</td>
                                        <td class="text-center fw-bold">6</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grafik Tahun Ini --}}
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="mb-3">Grafik Temuan Audit 2025</h6>
                        <canvas id="chartIni" height="200"></canvas>
                        <div class="d-flex justify-content-center gap-3 mt-2">
                            <small><span style="color:#f4a261;">&#9658;</span> ISO 45001</small>
                            <small><span style="color:#2a9d8f;">&#9658;</span> ISO 9001</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="row">
            <div class="col-12">
                <a href="{{ URL::to($url_menu) }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = ['QMR', 'Marketing H', 'Procurement', 'Production B', 'Production C', 'PPIC', 'Jisuken'];

        new Chart(document.getElementById('chartLalu'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'ISO 45001',
                        data: [0, 1, 2, 7, 3, 1, 11],
                        fill: true,
                        backgroundColor: 'rgba(244,162,97,0.4)',
                        borderColor: '#f4a261',
                        tension: 0.4,
                        pointRadius: 3,
                    },
                    {
                        label: 'ISO 9001',
                        data: [1, 1, 2, 3, 3, 2, 2],
                        fill: true,
                        backgroundColor: 'rgba(42,157,143,0.35)',
                        borderColor: '#2a9d8f',
                        tension: 0.4,
                        pointRadius: 3,
                    }
                ]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 3 } },
                    x: { grid: { display: false } }
                }
            }
        });

        new Chart(document.getElementById('chartIni'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'ISO 45001',
                        data: [0, 0, 3, 3, 0, 5, 5],
                        fill: true,
                        backgroundColor: 'rgba(244,162,97,0.4)',
                        borderColor: '#f4a261',
                        tension: 0.4,
                        pointRadius: 3,
                    },
                    {
                        label: 'ISO 9001',
                        data: [0, 2, 3, 1, 3, 1, 1],
                        fill: true,
                        backgroundColor: 'rgba(42,157,143,0.35)',
                        borderColor: '#2a9d8f',
                        tension: 0.4,
                        pointRadius: 3,
                    }
                ]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 2 } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
@endpush
