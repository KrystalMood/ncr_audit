@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => ''])

    {{-- Header bar --}}
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
                            <div class="text-uppercase text-sm">Filter {{ $title_menu }}</div>
                            <hr class="horizontal dark mt-0">

                            @php
                                $years = DB::table('mst_schedule_header')->where('isactive', '1')->distinct()->orderBy('year')->pluck('year');
                            @endphp

                            <div class="row">
                                {{-- Field 1: Tahun Lalu --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-control-label">Tahun Lalu</div>
                                        <select name="year_lalu" class="form-select">
                                            <option value="">
                                                -- PILIH TAHUN --
                                            </option>
                                            @foreach ($years as $y)
                                                <option value="{{ $y }}" {{ old('year_lalu') == $y ? 'selected' : '' }}>
                                                    {{ $y }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('year_lalu')
                                            <div class="text-danger text-xs pt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Field 2: Tahun Ini --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Tahun Ini</label>
                                        <select name="year_ini" class="form-select">
                                            <option value="">-- PILIH TAHUN --</option>
                                            @foreach ($years as $y)
                                                <option value="{{ $y }}" {{ old('year_ini') == $y ? 'selected' : '' }}>
                                                    {{ $y }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('year_ini')
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
        $(document).ready(function () { });
    </script>
@endpush