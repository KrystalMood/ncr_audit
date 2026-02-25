@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

@include('layouts.navbars.auth.topnav', ['title' => $title_menu])

<div class="container-fluid py-4">

    <div class="row">
        <div class="col-12">

            <div class="card mb-4">

                {{-- ================= HEADER ================= --}}
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">List {{ $title_menu }}</h6>
                        <p class="text-sm mb-0 text-muted">
                            Monitoring dan pengelolaan NCR internal & external
                        </p>
                    </div>

                    <div>
                        @if ($authorize->add == '1')
                            <a href="{{ url($url_menu.'/add') }}" class="btn btn-primary btn-sm mb-0">
                                <i class="fas fa-plus me-1"></i> Tambah
                            </a>
                        @endif
                    </div>
                </div>

                {{-- ================= FILTER ================= --}}
                <div class="card-body pt-3">

                    <form method="GET" action="{{ url($url_menu) }}">
                        <div class="row mb-3">

                            <div class="col-md-4">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       placeholder="Cari NCR..."
                                       value="{{ request('search') }}">
                            </div>

                            <div class="col-md-3">
                                <select name="iso" class="form-control">
                                    <option value="">Semua ISO</option>
                                    <option value="ISO 9001">ISO 9001</option>
                                    <option value="ISO 14001">ISO 14001</option>
                                    <option value="ISO 45001">ISO 45001</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="department" class="form-control">
                                    <option value="">Semua Departemen</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Procurement">Procurement</option>
                                    <option value="Produksi">Produksi</option>
                                    <option value="HSE">HSE</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info w-100">
                                    <i class="fas fa-search me-1"></i> Filter
                                </button>
                            </div>

                        </div>
                    </form>

                    {{-- ================= TABLE ================= --}}
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 table-bordered table-striped">

                            <thead class="thead-light">
                                <tr>
                                    <th width="5%" class="text-center text-uppercase text-xs font-weight-bolder">No</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">ISO</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Klausul</th>
                                    <th class="text-uppercase text-xs font-weight-bolder">Departemen</th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder">Tanggal</th>
                                    <th class="text-center text-uppercase text-xs font-weight-bolder">Status</th>
                                    <th width="15%" class="text-center text-uppercase text-xs font-weight-bolder">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                {{-- Dummy Data --}}
                                @php
                                    $rows = [
                                        ['ISO 9001','4.2','Marketing','11/09/2025','CLOSED'],
                                        ['ISO 14001','7.4.3','Procurement','07/07/2025','IN_PROGRESS'],
                                        ['ISO 45001','6.2','Produksi','25/11/2025','ON_REVIEW'],
                                    ];
                                @endphp

                                @foreach($rows as $index => $row)
                                    <tr>
                                        <td class="text-center text-sm">{{ $index+1 }}</td>
                                        <td class="text-sm">{{ $row[0] }}</td>
                                        <td class="text-sm">{{ $row[1] }}</td>
                                        <td class="text-sm">{{ $row[2] }}</td>
                                        <td class="text-center text-sm">{{ $row[3] }}</td>
                                        <td class="text-center text-sm">
                                            @php
                                                $badge = match($row[4]) {
                                                    'CLOSED' => 'success',
                                                    'IN_PROGRESS' => 'warning',
                                                    'ON_REVIEW' => 'info',
                                                    default => 'secondary'
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $badge }}">
                                                {{ $row[4] }}
                                            </span>
                                        </td>
                                        <td class="text-center">

                                            <a href="#" class="btn btn-sm btn-info mb-0">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if ($authorize->edit == '1')
                                                <a href="#" class="btn btn-sm btn-warning mb-0">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif

                                            @if ($authorize->delete == '1')
                                                <button class="btn btn-sm btn-danger mb-0">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection