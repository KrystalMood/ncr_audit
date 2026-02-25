@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => ''])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    {{-- Card Header --}}
                    <div class="card-header pb-0 border-bottom-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Report Log</h6>
                    </div>
                    {{-- Card Body --}}
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="p-4 pt-2">
                            {{-- Button Download Excel --}}
                            <button class="btn btn-success btn-sm mb-4"
                                style="background-color: #218838; border-color: #1e7e34;">
                                <i class="fas fa-file-excel me-1"></i> Download Excel
                            </button>
                            {{-- Table --}}
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0 table-bordered">
                                    <thead class="text-white" style="background-color: #1a7a7d;">
                                        <tr>
                                            <th class="text-xs font-weight-bolder">Departemen</th>
                                            <th class="text-xs font-weight-bolder text-center">Kategori</th>
                                            <th class="text-xs font-weight-bolder">Uraian</th>
                                            <th class="text-xs font-weight-bolder">Analisa Penyebab</th>
                                            <th class="text-xs font-weight-bolder">Corrections</th>
                                            <th class="text-xs font-weight-bolder">Corrective Action</th>
                                            <th class="text-xs font-weight-bolder">Evaluasi Efektivitas</th>
                                            <th class="text-xs font-weight-bolder text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #f8f9fa;">
                                        {{-- Data Hardcode --}}
                                        @for($i = 0; $i < 3; $i++)
                                            <tr>
                                                <td class="text-wrap" style="width: 10%;">
                                                    <p class="text-sm mb-0">MK 1</p>
                                                    <p class="text-sm mb-0">Marketing</p>
                                                    <p class="text-sm mb-0">Hygiene</p>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <span class="text-sm font-weight-bold">Minor</span>
                                                </td>
                                                <td class="text-wrap align-middle" style="width: 15%;">
                                                    <p class="text-sm mb-0">Prosedur Penangan keluhan pelanggan I00.002.3.1
                                                        Point 6.2 tidak ada waktu penyelesaian handling feedback ke customer</p>
                                                </td>
                                                <td class="text-wrap align-middle" style="width: 15%;">
                                                    <p class="text-sm mb-0">Karena petugas terlambat menerbitkan form customer
                                                        complain</p>
                                                </td>
                                                <td class="text-wrap align-middle" style="width: 15%;">
                                                    <p class="text-sm mb-0">Point 6.1 ditambahkan batasan waktu penerbitan form
                                                        customer complain</p>
                                                </td>
                                                <td class="text-wrap align-middle" style="width: 15%;">
                                                    <p class="text-sm mb-0">Marketing langsung meminta admin untuk menerbitkan
                                                        Customer Complain</p>
                                                </td>
                                                <td class="text-wrap align-middle" style="width: 15%;">
                                                    <p class="text-sm mb-0">Prosedur penanganan keluhan pelanggan sudah direvisi
                                                        No 100.002.4.1</p>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <span class="text-sm font-weight-bold">CLOSED</span>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
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
