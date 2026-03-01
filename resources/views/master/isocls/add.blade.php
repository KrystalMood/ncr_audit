@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah ISO Clauses'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">

                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <form action="{{ url($url_menu) }}" method="POST">
                            @csrf

                            {{-- ================= ISO HEADER ================= --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Standar ISO</label>
                                    <select name="idstandards" class="form-select" required>
                                        <option value="">-- PILIH ISO --</option>
                                        @foreach ($isoStandards as $iso)
                                            <option value="{{ $iso->idstandards }}">
                                                {{ $iso->code }} - {{ $iso->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>

                            {{-- ================= KLAUSUL TABLE ================= --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0">Daftar Klausul</h6>
                                <button type="button" id="addRow" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus me-1"></i> Tambah Klausul
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle" id="klausulTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%" class="text-center">No</th>
                                            <th width="20%">Nomor Klausul</th>
                                            <th width="25%">Nama Klausul</th>
                                            <th>Deskripsi</th>
                                            <th width="5%" class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="row-number text-center">1</td>

                                            <td>
                                                <input type="text" name="clause_number[]" class="form-control"
                                                    placeholder="Contoh: 6.1" required>
                                            </td>

                                            <td>
                                                <input type="text" name="clause_name[]" class="form-control"
                                                    placeholder="Nama Klausul" required>
                                            </td>

                                            <td>
                                                <input type="text" name="description[]" class="form-control"
                                                    placeholder="Deskripsi Klausul">
                                            </td>

                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger removeRow">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>

                                <a href="{{ url($url_menu) }}" class="btn btn-secondary">
                                    Kembali
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        function updateRowNumber() {
            $('#klausulTable tbody tr').each(function(index) {
                $(this).find('.row-number').text(index + 1);
            });
        }

        $('#addRow').click(function() {

            let newRow = `
    <tr>
        <td class="row-number text-center"></td>
        <td>
            <input type="text" name="clause_number[]" class="form-control" required>
        </td>
        <td>
            <input type="text" name="clause_name[]" class="form-control" required>
        </td>
        <td>
            <input type="text" name="description[]" class="form-control">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-danger removeRow">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>`;

            $('#klausulTable tbody').append(newRow);
            updateRowNumber();
        });

        $(document).on('click', '.removeRow', function() {
            if ($('#klausulTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
                updateRowNumber();
            }
        });

        updateRowNumber();
    </script>
@endpush
