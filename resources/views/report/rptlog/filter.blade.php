@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => ''])

    {{-- Header Bar --}}
    <div class="card shadow-lg mx-4">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-lg">
                    <div class="nav-wrapper position-relative end-0">
                        <button class="btn btn-primary mb-0"
                            onclick="event.preventDefault(); document.getElementById('{{ $dmenu }}-form').submit();">
                            <i class="fas fa-bolt me-1"></i>
                            <span class="font-weight-bold">Execute</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Filter --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <form role="form" method="POST" action="{{ URL::to($url_menu) }}" id="{{ $dmenu }}-form">
                        @csrf
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Filter {{ $title_menu }}</p>
                            <hr class="horizontal dark mt-0">
                            <div class="row">
                                {{-- Field 1: ISO --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">ISO</label>
                                        <select name="idstandards" class="form-select">
                                            <option value="">-- PILIH ISO --</option>
                                            @php
                                                $isos = DB::table('mst_iso_standards')
                                                    ->where('isactive', '1')
                                                    ->orderBy('name')
                                                    ->get();
                                            @endphp
                                            @foreach ($isos as $iso)
                                                <option value="{{ $iso->idstandards }}" {{ old('idstandards') == $iso->idstandards ? 'selected' : '' }}>
                                                    {{ $iso->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('idstandards')
                                            <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Field 2: Departemen --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Departemen</label>
                                        <select name="iddepartments" class="form-select">
                                            <option value="">-- PILIH DEPARTEMEN --</option>
                                            @php
                                                $depts = DB::table('mst_departments')
                                                    ->where('isactive', '1')
                                                    ->orderBy('name')
                                                    ->get();
                                            @endphp
                                            @foreach ($depts as $d)
                                                <option value="{{ $d->iddepartments }}" {{ old('iddepartments') == $d->iddepartments ? 'selected' : '' }}>
                                                    {{ $d->prefix }} - {{ $d->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('iddepartments')
                                            <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Field 3: Tahun --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Tahun</label>
                                        <select name="year" class="form-select">
                                            <option value="">-- PILIH TAHUN --</option>
                                            @php
                                                $years = DB::table('mst_schedule_header')
                                                    ->where('isactive', '1')
                                                    ->distinct()
                                                    ->orderBy('year')
                                                    ->pluck('year');
                                            @endphp
                                            @foreach ($years as $y)
                                                <option value="{{ $y }}" {{ old('year') == $y ? 'selected' : '' }}>
                                                    {{ $y }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('year')
                                            <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                        </div>
                        <div class="card-footer pt-0 pb-2"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
