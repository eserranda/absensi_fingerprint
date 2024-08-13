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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-list">
                    <div class="btn-actions col-12">
                        <div class="col-3">
                            <select class="form-select" id="filterKelas">
                                <option value="" selected disabled>Pilih Kelas</option>
                                @foreach ($matpel as $data)
                                    <option value="{{ $data->kelas }}">{{ $data->kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 mx-2">
                            <select class="form-select" id="filterSemester">
                                <option value="" selected disabled>Pilih Semester</option>
                                @foreach (App\Models\TahunAjaran::get() as $data)
                                    <option value="{{ $data->semester }}">{{ $data->semester }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-7">
                            <select class="form-select" id="filterTahunAjaran">
                                <option value="" selected disabled>Pilih Tahun Ajaran</option>
                                @foreach (App\Models\TahunAjaran::get() as $data)
                                    <option value="{{ $data->tahun_ajaran }}">{{ $data->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>

                        <a class="btn btn-icon mx-2" aria-label="Button" id="search">
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
                    <button class="btn   btn-icon mx-2" id="reload">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="card-body border-bottom py-3 ">
                {{-- <h3> Rekap Absensi Siswa kelas {{ $matpel->data_matpel->nama_matpel }} Per Semester </h3> --}}

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Matpel</th>
                                <th>Guru/Pengajar</th>
                                <th>Hadir</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Tanpa Keterangan</th>
                                <th>Total Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @push('script')
        <script>
            $(document).ready(function() {
                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/rekap-absensi/getWithFilterMatpel/",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '#',
                            searchable: false
                        },
                        {
                            data: 'id_siswa',
                            name: 'id_siswa',
                        },
                        {
                            data: 'kelas',
                            name: 'kelas',
                        },
                        {
                            data: 'semester',
                            name: 'semester',
                        },
                        {
                            data: 'id_matpel',
                            name: 'id_matpel',
                        },
                        {
                            data: 'id_guru',
                            name: 'id_guru',
                        },
                        {
                            data: 'hadir',
                            name: 'hadir'
                        },
                        {
                            data: 'sakit',
                            name: 'sakit'
                        },
                        {
                            data: 'izin',
                            name: 'izin'
                        },
                        {
                            data: 'tanpa_keterangan',
                            name: 'tanpa_keterangan'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },

                    ],
                    dom: "<'row'<'col-lg-3'l> <'col-lg-4 mt-2'B> <'col-lg-5'f>>" +
                        "<'row'<'col-sm-12 py-lg-2'tr>>" +
                        "<'row'<'col-sm-12 col-lg-5'i><'col-sm-12 col-lg-7'p>>",
                    "buttons": [{
                            extend: 'excel',
                            className: 'btn btn-secondary',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-secondary',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        }
                    ]
                });

                $('#search').on('click', function() {
                    var selectedKelas = $('#filterKelas').val();
                    var selectedSemester = $('#filterSemester').val();
                    var selectedTahunAjaran = $('#filterTahunAjaran').val();

                    // Jika keduanya kosong, tampilkan peringatan
                    if (!selectedSemester && !selectedTahunAjaran && !selectedKelas) {
                        alert('Pilih Semester atau Tahun Ajaran terlebih dahulu');
                        return;
                    }

                    // Membuat URL dengan parameter yang valid
                    let url = '/rekap-absensi/getWithFilterKelas?';

                    if (selectedSemester) {
                        url += 'semester=' + encodeURIComponent(selectedSemester);
                    }

                    if (selectedTahunAjaran) {
                        // Tambahkan & jika ada semester di URL
                        if (selectedSemester) {
                            url += '&';
                        }
                        url += 'tahun_ajaran=' + encodeURIComponent(selectedTahunAjaran);
                    }

                    if (selectedKelas) {
                        // Tambahkan & jika ada semester atau tahun ajaran di URL
                        if (selectedSemester || selectedTahunAjaran) {
                            url += '&';
                        }
                        url += 'kelas=' + encodeURIComponent(selectedKelas);
                    }

                    // Memuat ulang dataTable dengan URL baru
                    myDataTable.ajax.url(url).load();
                });


                $('#reload').on('click', function() {
                    $('#filterSemester').val('');
                    $('#filterTahunAjaran').val('');
                    myDataTable.ajax.url('/rekap-absensi/getWithFilterKelas').load();
                });
            });
        </script>
    @endpush
@endsection
