@extends('layouts.master')
@push('headcss')
    <link href="{{ asset('assets') }}/dist/css/dataTables-bootstrap5.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
@endpush
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-actions ">
                    <div class="input-icon">
                        <input class="form-control" type="date" id="tanggal" />

                    </div>
                </div>

                <button class="btn   btn-icon mx-2" id="reload">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                    </svg>

                </button>

                {{-- <div class="card-actions">
                    <a href="#" class="btn btn-success">
                        Exel
                    </a>
                    <a href="#" class="btn btn-primary" id="add_data">
                        Tambah Data
                    </a>
                </div> --}}
            </div>

            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>ID Finger</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Ket</th>
                                <th class="w-1">Lihat Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $d)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $d->siswa->nama }}</td>
                                    <td> {{ $d->id_fingerprint }}</td>
                                    <td> {{ $d->siswa->kelas }}</td>
                                    <td>
                                        <a href="{{ route('daftar_absensi.show', $d->siswa->id) }}">
                                            <span class="badge bg-blue text-bg-danger">Data Absensi</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach --}}
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

                    ajax: "{{ route('data_absensi_siswa.data') }}",
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
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
                $('#tanggal').on('change', function() {
                    const selectedKelas = $(this).val();
                    myDataTable.ajax.url('{{ route('data_absensi_siswa.data') }}?tanggal=' +
                        selectedKelas).load();
                });


                $('#reload').on('click', function() {
                    myDataTable.ajax.url('{{ route('data_absensi_siswa.data') }}').load();
                });
            });
        </script>
    @endpush
@endsection
