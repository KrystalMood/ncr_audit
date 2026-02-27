@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

@include('layouts.navbars.auth.topnav', ['title' => 'Form Tambah Temuan NCR'])

<div class="container-fluid py-4">

    <form method="POST" action="{{ url($url_menu.'/store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">

                {{-- ================= FORM AUDITOR ================= --}}
                <div class="card shadow-lg border-0 mb-4" style="border-radius:18px;">
                    <div class="card-body p-5">

                        <h4 class="mb-1">Form Tambah Temuan</h4>
                        <p class="text-sm text-muted mb-4">
                            Diisi oleh auditor berdasarkan hasil audit di lapangan
                        </p>

                        <div class="row">

                            {{-- ISO --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Jenis ISO</label>
                                <div class="position-relative">
                                    <select name="iso" id="isoSelect"
                                        class="form-control form-control-lg custom-select-icon">
                                        <option value="">-- PILIH ISO --</option>
                                        <option value="9001">ISO 9001</option>
                                        <option value="14001">ISO 14001</option>
                                        <option value="45001">ISO 45001</option>
                                    </select>
                                </div>
                            </div>

                            {{-- KLAUSUL --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Klausul</label>
                                <div class="position-relative">
                                    <select name="klausul" id="klausulSelect"
                                        class="form-control form-control-lg custom-select-icon">
                                        <option value="">-- PILIH ISO TERLEBIH DAHULU --</option>
                                    </select>
                                </div>
                            </div>

                            {{-- KATEGORI --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Kategori</label>
                                <div class="position-relative">
                                    <select name="kategori"
                                        class="form-control form-control-lg custom-select-icon">
                                        <option>Major</option>
                                        <option>Minor</option>
                                        <option>Observasi</option>
                                    </select>
                                </div>
                            </div>

                            {{-- FISHBONE --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Fishbone (4M + 1E)</label>
                                <div class="position-relative">
                                    <select name="fishbone"
                                        class="form-control form-control-lg custom-select-icon">
                                        <option value="">-- PILIH ROOT CAUSE --</option>
                                        <option value="Man">Man</option>
                                        <option value="Machine">Machine</option>
                                        <option value="Method">Method</option>
                                        <option value="Material">Material</option>
                                        <option value="Environment">Environment</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Uraian Ketidaksesuaian (PLOR)</h5>

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Problem (P)</label>
                                <textarea name="problem" rows="4" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Location (L)</label>
                                <textarea name="location" rows="4" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Objective Evidence (O)</label>
                                <textarea name="evidence" rows="4" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Reference (R)</label>
                                <textarea name="reference" rows="4" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">No Laporan Ketidaksesuaian</label>
                                <input type="text" name="no_ncr" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ================= TINDAK LANJUT AUDITEE ================= --}}
                <div class="card shadow-lg border-0 mb-4" style="border-radius:18px;">
                    <div class="card-body p-5">

                        <h4 class="text-success mb-1">Tindak Lanjut Auditee</h4>
                        <p class="text-sm text-muted mb-4">
                            Diisi oleh auditee untuk menindaklanjuti temuan auditor
                        </p>

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Analisa Penyebab</label>
                                <textarea name="analisa" rows="4" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Corrective Action</label>
                                <textarea name="corrective_action" rows="4"
                                    class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label">Corrections</label>
                                <textarea name="correction" rows="4"
                                    class="form-control"></textarea>
                            </div>

                            {{-- Upload --}}
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Upload Bukti</label>

                                <input type="file" name="bukti[]" id="bukti" multiple hidden>

                                <label for="bukti" class="upload-box">
                                    <div class="text-center">
                                        <i class="fas fa-images fa-2x text-secondary mb-2"></i>
                                        <p class="text-sm text-muted mb-0">
                                            Klik untuk upload bukti
                                        </p>
                                    </div>
                                    <div class="upload-plus">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </label>

                                <div id="file-list" class="mt-3"></div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ================= STATUS ================= --}}
                <div class="card shadow-sm border-0 mb-4" style="border-radius:15px;">
                    <div class="card-body">

                        <div class="row align-items-center">

                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <div class="position-relative">
                                    <select name="status" class="form-control custom-select-icon">
                                        <option>OPEN</option>
                                        <option selected>ON PROGRESS</option>
                                        <option>CLOSED</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-8 text-end mt-3 mt-md-0">
                                <button type="submit" class="btn btn-success px-4 me-2">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>

                                <a href="{{ url($url_menu) }}" class="btn btn-secondary px-4">
                                    Kembali
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>
</div>

{{-- ================= CSS ================= --}}
<style>
    .custom-select-icon {
        appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg fill='%236c757d' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 18px;
        padding-right: 40px;
    }

    .upload-box {
        border: 2px dashed #d2d6da;
        border-radius: 15px;
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        cursor: pointer;
        background: #f8f9fa;
        transition: 0.3s;
    }

    .upload-box:hover {
        border-color: #2dce89;
        background: #eefcf6;
    }

    .upload-plus {
        position: absolute;
        bottom: -12px;
        right: -12px;
        width: 35px;
        height: 35px;
        background: #2dce89;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .file-item {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 8px 12px;
        margin-bottom: 6px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
    }

    .file-remove {
        cursor: pointer;
        color: #f5365c;
    }
</style>

{{-- ================= SCRIPT ================= --}}
<script>
    const isoSelect = document.getElementById('isoSelect');
    const klausulSelect = document.getElementById('klausulSelect');

    const klausulData = {
        9001: ["4 Context", "5 Leadership", "6 Planning", "7 Support", "8 Operation", "9 Evaluation", "10 Improvement"],
        14001: ["4 Context", "5 Leadership", "6 Planning", "7 Support", "8 Operation", "9 Evaluation", "10 Improvement"],
        45001: ["4 Context", "5 Leadership & Participation", "6 Planning", "7 Support", "8 Operation", "9 Evaluation", "10 Improvement"]
    };

    isoSelect.addEventListener('change', function () {
        const iso = this.value;
        klausulSelect.innerHTML = '';

        if (!iso || !klausulData[iso]) {
            klausulSelect.innerHTML = '<option value="">-- PILIH ISO TERLEBIH DAHULU --</option>';
            return;
        }

        klausulSelect.innerHTML = '<option value="">-- PILIH KLAUSUL --</option>';

        klausulData[iso].forEach(function (klausul) {
            const option = document.createElement('option');
            option.value = klausul;
            option.textContent = klausul;
            klausulSelect.appendChild(option);
        });
    });

    const input = document.getElementById('bukti');
    const fileList = document.getElementById('file-list');
    let selectedFiles = [];

    input.addEventListener('change', function () {
        selectedFiles = Array.from(input.files);
        renderFileList();
    });

    function renderFileList() {
        fileList.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const div = document.createElement('div');
            div.classList.add('file-item');
            div.innerHTML = `
                <span><i class="fas fa-file me-2 text-primary"></i>${file.name}</span>
                <span class="file-remove" onclick="removeFile(${index})">
                    <i class="fas fa-times"></i>
                </span>
            `;
            fileList.appendChild(div);
        });
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);

        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));

        input.files = dt.files;
        renderFileList();
    }
</script>

@endsection