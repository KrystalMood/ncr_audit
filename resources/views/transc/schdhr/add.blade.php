@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => ''])

    <style>
        .lead-radio {
            width: 18px;
            height: 18px;
            border: 2px solid #ced4da;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            border-radius: 50%;
            outline: none;
            transition: all 0.15s ease-in-out;
        }

        .lead-radio:checked {
            border-color: #2dce89;
            background-color: #2dce89;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e");
        }

        .lead-radio:hover {
            border-color: #2dce89;
        }

        /* Animasi Ikon Collapse (Minimize) */
        .toggle-icon {
            transition: transform 0.3s ease;
        }

        .collapsed .toggle-icon {
            transform: rotate(-90deg);
        }

        /* Drag handle styling */
        .drag-handle {
            cursor: grab;
            color: #adb5bd;
            padding: 4px;
            transition: color 0.15s ease;
        }

        .drag-handle:hover {
            color: #6c757d;
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        .sortable-ghost {
            opacity: 0.4;
            background: #e9ecef !important;
        }

        .sortable-chosen {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
    </style>

    <div class="card shadow-lg mx-4">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-lg">
                    <div class="nav-wrapper">
                        <button class="btn btn-secondary mb-0" onclick="window.location='{{ URL::to('schdhr') }}'">
                            <i class="fas fa-circle-left me-1"></i>
                            <span class="font-weight-bold">Kembali</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">

                {{-- Info Header --}}
                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Informasi Jadwal Audit</p>
                        <hr class="horizontal dark mt-0">
                        <div class="row">
                            {{-- Kiri --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Judul Jadwal</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Contoh: Audit Internal Periode I 2026">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Tahun</label>
                                    <input type="text" class="form-control" id="year" placeholder="2026" maxlength="4">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Tipe Audit</label>
                                    <select class="form-select select2-header" id="type">
                                        <option value="internal">Internal</option>
                                        <option value="external">External</option>
                                    </select>
                                </div>
                            </div>
                            {{-- Kanan --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="start_date">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="end_date">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Deadline NCR (Opsional)</label>
                                    <input type="date" class="form-control" id="ncr_deadline">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Catatan (Opsional)</label>
                                    <textarea class="form-control" id="notes" rows="2"
                                        placeholder="Catatan tambahan untuk jadwal ini..."></textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">

                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-success mb-0" id="btn-generate">
                                <i class="fas fa-calendar-plus me-1"></i> Generate Sesi
                            </button>
                            <p class="text-secondary text-xs mb-0 ms-3">Klik untuk membuat card sesi per tanggal berdasarkan
                                rentang di atas.</p>
                        </div>
                    </div>
                </div>

                {{-- Container tanggal hasil generate --}}
                <div id="dates-container" class="mt-4"></div>

                {{-- Button aksi bawah --}}
                <div class="row mt-3 mb-4" id="action-buttons-container" style="display: none;">
                    <div class="col-12 d-flex">
                        <button type="button" class="btn btn-info me-2"><i class="fas fa-paper-plane me-1"></i>
                            Posting</button>
                        <button type="button" class="btn btn-primary me-2"><i class="fas fa-save me-1"></i> Simpan
                            Draft</button>
                        <button type="button" class="btn btn-secondary"
                            onclick="window.location='{{ URL::to('schdhr') }}'"><i class="fas fa-arrow-left me-1"></i>
                            Kembali</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- TEMPLATE --}}

    {{-- Template: Card Tanggal --}}
    <template id="tpl-date-card">
        <div class="card mb-4 date-card shadow-sm" data-date="{RAW_DATE}">
            <div class="card-header pb-0 pt-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-success mb-0"><i class="fas fa-calendar-day me-2"></i>{FORMATTED_DATE}</h6>
                    <span class="badge bg-light text-dark session-count-badge">0 sesi</span>
                </div>
            </div>
            <hr class="horizontal dark mt-2 mb-0">
            <div class="card-body pt-2 pb-3">
                <div class="sessions-container"></div>
                <button type="button" class="btn btn-sm btn-outline-primary mt-3 mb-0 btn-add-session">
                    <i class="fas fa-plus me-1"></i> Tambah Session
                </button>
            </div>
        </div>
    </template>

    {{-- Template: Sesi --}}
    <template id="tpl-session">
        <div class="session-block border rounded mb-3 bg-white shadow-sm">
            {{-- Header Sesi --}}
            <div class="p-3 d-flex justify-content-between align-items-center"
                style="background-color: #f8f9fa; border-radius: 6px 6px 0 0; border-bottom: 1px solid #e9ecef;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-grip-vertical me-3 drag-handle" title="Drag untuk pindahkan urutan"></i>
                    <p class="text-sm font-weight-bold text-dark mb-0" style="cursor: pointer;" data-bs-toggle="collapse"
                        data-bs-target="#collapse{SESSION_ID}" aria-expanded="true">
                        <i class="fas fa-chevron-down me-2 toggle-icon"></i> Sesi #{SESSION_NO}
                    </p>
                </div>
                <button type="button" class="btn btn-link text-danger p-0 mb-0 btn-remove-session" title="Hapus Sesi">
                    <i class="fas fa-times fa-lg"></i>
                </button>
            </div>

            {{-- Body Sesi --}}
            <div class="collapse show" id="collapse{SESSION_ID}">
                <div class="p-3">
                    {{-- Baris 1: Tipe Sesi, Waktu, Departemen --}}
                    <div class="row g-2 mb-2">
                        <div class="col-md-3">
                            <label class="form-control-label text-xs">Tipe Sesi</label>
                            <select class="form-select form-select-sm select2-dynamic">
                                <option value="audit">Audit</option>
                                <option value="opening_meeting">Opening Meeting</option>
                                <option value="closing_meeting">Closing Meeting</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-control-label text-xs">Waktu</label>
                            <div class="d-flex align-items-center">
                                <input type="time" class="form-control form-control-sm" value="09:00"
                                    style="min-height:36px;">
                                <span class="mx-2 text-muted fw-bold">—</span>
                                <input type="time" class="form-control form-control-sm" value="11:00"
                                    style="min-height:36px;">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="form-control-label text-xs">Departemen</label>
                            <select class="form-select form-select-sm select2-dynamic">
                                <option value="">-- Pilih Departemen --</option>
                                <option>QMR</option>
                                <option>HRD</option>
                                <option>IT</option>
                            </select>
                        </div>
                    </div>

                    {{-- Baris 2: PIC/MR, Keterangan --}}
                    <div class="row g-2 mb-3">
                        <div class="col-md-3">
                            <label class="form-control-label text-xs">PIC / MR</label>
                            <select class="form-select form-select-sm select2-dynamic">
                                <option value="">-- Pilih --</option>
                                <option>Amy</option>
                                <option>Budi</option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <label class="form-control-label text-xs">Keterangan</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Opsional"
                                style="min-height:36px;">
                        </div>
                    </div>

                    {{-- Daftar Auditor --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <button type="button" class="btn btn-sm btn-light border btn-add-auditor text-dark">
                                <i class="fas fa-user-plus me-1"></i> Tambah Auditor
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0 auditor-table w-100"
                                style="background-color: #f8f9fa; border-radius: 6px;">
                                <thead class="border-bottom" style="background-color: #f1f2f5;">
                                    <tr>
                                        <th class="py-2 px-3 text-secondary text-xs">Auditor</th>
                                        <th class="text-center py-2 px-3 text-secondary text-xs" width="100">Lead</th>
                                        <th class="text-center py-2 px-3 text-secondary text-xs" width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Klausul ISO yang Diaudit --}}
                    <div class="iso-sections rounded border" style="background-color: #fff;">
                        <div class="px-3 py-2 font-weight-bold text-xs text-uppercase border-bottom"
                            style="background-color: #f1f2f5; border-radius: 6px 6px 0 0;">
                            Klausul yang Diaudit
                        </div>
                        <div class="p-3">
                            <div class="mb-2">
                                <span class="badge bg-primary mb-1">ISO 9001</span>
                                <div class="ms-3 mt-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label text-sm">4.1 - Context Organization</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label text-sm">4.2 - Needs & Expectations</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label text-sm">5.1 - Leadership</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <span class="badge bg-warning mb-1">ISO 45001</span>
                                <div class="ms-3 mt-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label text-sm">6.1 - Risk Action</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label text-sm">6.2 - Hazard Identification</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <span class="badge bg-success mb-1">ISO 14001</span>
                                <div class="ms-3 mt-1 text-muted text-sm">Tidak ada klausul yang tersedia.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    {{-- Template: Baris Auditor --}}
    <template id="tpl-auditor-row">
        <tr class="auditor-row border-bottom">
            <td class="align-middle px-3">
                <select class="form-select form-select-sm select2-dynamic px-0 text-sm">
                    <option value="">-- Pilih Auditor --</option>
                    <option>Taufik K</option>
                    <option>Wibowo</option>
                    <option>Amy</option>
                </select>
            </td>
            <td class="text-center align-middle px-3">
                <input class="lead-radio" type="radio" name="lead_auditor_{SESSION_ID}">
            </td>
            <td class="text-center align-middle px-3">
                <button type="button" class="btn btn-sm btn-outline-danger mb-0 px-2 py-1 btn-remove-auditor"
                    style="box-shadow: none;">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
    </template>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        $(document).ready(function () {

            $('.select2-header').select2({ width: '100%' });

            var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            function generateId() {
                return Math.random().toString(36).substr(2, 9);
            }

            function formatTanggal(dateStr) {
                var d = new Date(dateStr);
                return namaHari[d.getDay()] + ', ' + d.getDate() + ' ' + namaBulan[d.getMonth()] + ' ' + d.getFullYear();
            }

            var sessionCounter = {};

            $('#btn-generate').click(function () {
                let startDate = $('#start_date').val();
                let endDate = $('#end_date').val();

                if (!startDate || !endDate) {
                    Swal.fire('Peringatan', 'Harap isi tanggal mulai dan selesai.', 'warning');
                    return;
                }
                if (new Date(startDate) > new Date(endDate)) {
                    Swal.fire('Peringatan', 'Tanggal selesai harus sama atau lebih dari tanggal mulai.', 'warning');
                    return;
                }

                if ($('#dates-container').children().length > 0) {
                    Swal.fire({
                        title: 'Generate Ulang?',
                        text: 'Data sesi yang sudah diisi akan hilang. Lanjutkan?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, generate ulang',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) doGenerate(startDate, endDate);
                    });
                } else {
                    doGenerate(startDate, endDate);
                }
            });

            function doGenerate(startDate, endDate) {
                $('#dates-container').empty();
                sessionCounter = {};

                let current = new Date(startDate);
                let last = new Date(endDate);

                while (current <= last) {
                    let yyyy = current.getFullYear();
                    let mm = String(current.getMonth() + 1).padStart(2, '0');
                    let dd = String(current.getDate()).padStart(2, '0');
                    let rawDate = `${yyyy}-${mm}-${dd}`;
                    let formatted = formatTanggal(rawDate);

                    sessionCounter[rawDate] = 0;

                    let cardHtml = $('#tpl-date-card').html()
                        .replace(/{RAW_DATE}/g, rawDate)
                        .replace(/{FORMATTED_DATE}/g, formatted);

                    let $card = $(cardHtml);

                    addSessionBlock($card.find('.sessions-container'), rawDate);
                    updateSessionCount($card, rawDate);

                    $('#dates-container').append($card);

                    initSortable($card.find('.sessions-container')[0]);

                    current.setDate(current.getDate() + 1);
                }

                $('#action-buttons-container').fadeIn();
                $('html, body').animate({
                    scrollTop: $('#dates-container').offset().top - 80
                }, 500);
            }

            function addSessionBlock($container, rawDate) {
                let sessionId = generateId();
                sessionCounter[rawDate] = (sessionCounter[rawDate] || 0) + 1;
                let sessionNo = sessionCounter[rawDate];

                let sessionHtml = $('#tpl-session').html()
                    .replace(/{SESSION_ID}/g, sessionId)
                    .replace(/{SESSION_NO}/g, sessionNo);

                let $session = $(sessionHtml);

                $session.find('.btn-remove-session').click(function (e) {
                    e.stopPropagation();
                    let $dateCard = $session.closest('.date-card');
                    $session.slideUp('fast', function () {
                        $(this).remove();
                        updateSessionCount($dateCard, rawDate);
                    });
                });

                addAuditorRow($session.find('tbody'), sessionId);
                $container.append($session);

                $session.find('.select2-dynamic').select2({ width: '100%' });

                $session.find('.btn-add-auditor').click(function () {
                    addAuditorRow($session.find('tbody'), sessionId);
                });
            }

            function addAuditorRow($tbody, sessionId) {
                let html = $('#tpl-auditor-row').html().replace(/{SESSION_ID}/g, sessionId);
                let $row = $(html);

                $row.find('.btn-remove-auditor').click(function () {
                    $row.find('.select2-dynamic').select2('destroy');
                    $row.fadeOut('fast', function () { $(this).remove(); });
                });

                $tbody.append($row);

                $row.find('.select2-dynamic').select2({ width: '100%' });
            }

            function updateSessionCount($card, rawDate) {
                let count = $card.find('.session-block').length;
                $card.find('.session-count-badge').text(count + ' sesi');
            }

            function initSortable(container) {
                new Sortable(container, {
                    handle: '.drag-handle',
                    animation: 200,
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-chosen',
                    onEnd: function () {
                        $(container).find('.session-block').each(function (i) {
                            $(this).find('.toggle-icon').parent().contents().last()[0].textContent = ' Sesi #' + (i + 1);
                        });
                    }
                });
            }

            $(document).on('click', '.btn-add-session', function () {
                let $card = $(this).closest('.date-card');
                let rawDate = $card.data('date');
                let $container = $card.find('.sessions-container');
                addSessionBlock($container, rawDate);
                updateSessionCount($card, rawDate);
            });
        });
    </script>
@endpush