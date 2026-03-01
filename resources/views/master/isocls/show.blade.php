@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $title_menu ?? 'Detail ISO Clause'])

    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-header pb-0">
                        <h6>Detail ISO Clause</h6>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label text-sm text-muted">
                                    Standar ISO
                                </label>

                                <div class="fw-bold">
                                    {{ $row->code }} - {{ $row->name }}
                                </div>

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label text-sm text-muted">
                                    Versi Tahun
                                </label>

                                <div class="fw-bold">
                                    {{ $row->version_year }}
                                </div>

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label text-sm text-muted">
                                    Level
                                </label>

                                <div>
                                    <span class="badge bg-secondary">
                                        {{ $row->level }}
                                    </span>
                                </div>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label text-sm text-muted">
                                    Nomor Klausul
                                </label>

                                <div class="fw-bold">
                                    {{ $row->clause_number }}
                                </div>

                            </div>


                            <div class="col-md-8 mb-3">

                                <label class="form-label text-sm text-muted">
                                    Nama Klausul
                                </label>

                                <div class="fw-bold">
                                    {{ $row->clause_name }}
                                </div>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-12 mb-3">

                                <label class="form-label text-sm text-muted">
                                    Deskripsi
                                </label>

                                <div class="border rounded p-3 bg-light">

                                    {{ $row->description ?? '-' }}

                                </div>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label text-sm text-muted">
                                    Status
                                </label>

                                <div>

                                    @if ($row->isactive == '1')
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>


                        <div class="mt-4">

                            <a href="{{ url($url_menu) }}" class="btn btn-secondary">

                                <i class="fas fa-arrow-left me-1"></i>
                                Kembali

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
