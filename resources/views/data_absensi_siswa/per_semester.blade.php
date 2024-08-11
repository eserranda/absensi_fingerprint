@extends('layouts.master')

@push('headcss')
    <link href="{{ asset('assets') }}/dist/css/dataTables-bootstrap5.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-list">
                    <div class="btn-actions col-12">
                        <div class="col-6">
                            <select class="form-select" id="filterSemester">
                                <option value="" selected disabled>Pilih Semester</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>

                        <div class="col-7 mx-2">
                            <select class="form-select" id="filterTahunAjaran">
                                <option value="" selected disabled>Tahun Ajaran</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                            </select>
                        </div>

                        <a class="btn btn-icon" aria-label="Button" id="search">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </a>
                    </div>
                </div>


                <div class="card-actions">
                    <a href="/rekap-absensi-siswa" class="btn btn-warning">
                        Back
                    </a>
                </div>
            </div>

            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>ID Finger</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', async function() {
        const id = {{ $data->id }};
        const myDataTable = $('.datatable').DataTable({
            processing: true,
            serverSide: true,

            ajax: "/rekap-absensi-siswa/rekap-per-semester/" + id,
            columns: [{
                    data: 'DT_RowIndex',
                    name: '#',
                    searchable: false
                },
                {
                    data: 'id_siswa',
                    name: 'id_siswa'
                },
                {
                    data: 'id_fingerprint',
                    name: 'id_fingerprint'
                },
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'hari',
                    name: 'hari'
                },
                {
                    data: 'tanggal_absen',
                    name: 'tanggal_absen'
                },
                {
                    data: 'jam_masuk',
                    name: 'jam_masuk'
                },
                {
                    data: 'jam_keluar',
                    name: 'jam_keluar'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },

            ],
            dom: "<'row'<'col-lg-3'l> <'col-lg-4 mt-2'B> <'col-lg-5'f>>" +
                "<'row'<'col-sm-12 py-lg-2'tr>>" +
                "<'row'<'col-sm-12 col-lg-5'i><'col-sm-12 col-lg-7'p>>",
            "buttons": [{
                    extend: 'excel',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }
            ]
        });
        $('#search').on('click', function() {
            var selectedSemester = $('#filterSemester').val();
            var selectedTahunAjaran = $('#filterTahunAjaran').val();
            if (!selectedSemester && !selectedTahunAjaran) {
                alert('Pilih semester atau tahun ajaran terlebih dahulu');
                return;
            }
            const url =
                `/rekap-absensi-siswa/rekap-per-semester/${id}?semester=${selectedSemester}&tahun_ajaran=${selectedTahunAjaran}`;
            myDataTable.ajax.url(url).load();
        });

        $('#reload').on('click', function() {
            myDataTable.ajax.url('{{ route('data_absensi_guru.data') }}').load();
        });

    });
</script>
