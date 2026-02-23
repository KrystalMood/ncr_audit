@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => ''])
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    <div class="card">
                        <div class="row">
                            <div class="card-header col-md-auto">
                                <h5 class="mb-0">List {{ $title_menu }}</h5>
                            </div>
                            <div class="col">
                                @include('components.alert')
                            </div>
                        </div>
                        <hr class="horizontal dark mt-0">
                        <div class="row px-4 py-2">
                            <div class="col-lg">
                                <div class="nav-wrapper d-flex justify-content-between mb-3">
                                    <div>
                                        @if ($authorize->add == '1')
                                            <button class="btn btn-primary mb-0"
                                                onclick="window.location='{{ URL::to('schdhr/add') }}'">
                                                <i class="fas fa-plus me-1"></i><span class="font-weight-bold">Tambah</span>
                                            </button>
                                        @endif
                                        <button class="btn btn-success mb-0" id="btnExport" title="Export to Excel">
                                            <i class="fas fa-file-excel me-1"></i><span class="font-weight-bold">Export
                                                Excel</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-4 py-2">
                            <div class="table-responsive">
                                <table id="list_header"
                                    class="table display table-bordered table-striped align-items-center mb-0"
                                    style="width: 100%;">
                                    <thead class="thead-light" style="background-color: #00b7bd4f;">
                                        <tr>
                                            <th class="text-center text-uppercase text-xs font-weight-bolder">No</th>
                                            <th class="text-center text-uppercase text-xs font-weight-bolder">Tahun Audit
                                            </th>
                                            <th class="text-center text-uppercase text-xs font-weight-bolder">Judul</th>
                                            <th class="text-center text-uppercase text-xs font-weight-bolder">Tipe</th>
                                            <th class="text-center text-uppercase text-xs font-weight-bolder">Mulai</th>
                                            <th class="text-center text-uppercase text-xs font-weight-bolder">Selesai</th>
                                            <th class="text-center text-uppercase text-xs font-weight-bolder">Status</th>
                                            <th class="text-center text-uppercase text-xs font-weight-bolder">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data dummy -->
                                        <tr>
                                            <td class="text-center align-middle text-sm">1</td>
                                            <td class="text-center align-middle text-sm">2026</td>
                                            <td class="align-middle text-sm font-weight-bold">Audit Internal Periode I 2026
                                            </td>
                                            <td class="text-center align-middle text-sm">
                                                <span class="badge bg-info">Internal</span>
                                            </td>
                                            <td class="text-center align-middle text-sm">01-03-2026</td>
                                            <td class="text-center align-middle text-sm">05-03-2026</td>
                                            <td class="text-center align-middle text-sm">
                                                <span class="badge bg-warning">Draft</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="{{ URL::to('schdhr/show/1') }}" class="btn btn-sm btn-info mb-0"
                                                    title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if ($authorize->edit == '1')
                                                    <a href="{{ URL::to('schdhr/edit/1') }}" class="btn btn-sm btn-warning mb-0"
                                                        title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if ($authorize->delete == '1')
                                                    <button class="btn btn-sm btn-danger mb-0 btn-delete" data-id="1"
                                                        title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            var table = $('#list_header').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<i class='fas fa-angle-left'></i>",
                        "next": "<i class='fas fa-angle-right'></i>"
                    }
                },
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $('.btn-delete').click(function () {
                var id = $(this).data("id");
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data jadwal audit akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#fe3333',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Dihapus!',
                            'Data jadwal audit berhasil dihapus.',
                            'success'
                        );
                    }
                })
            });
        });
    </script>
@endpush