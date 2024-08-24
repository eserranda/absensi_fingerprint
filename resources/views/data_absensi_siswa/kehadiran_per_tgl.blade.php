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
    <style>
        .bg-green {
            background-color: #d4edda;
            /* Warna hijau muda */
        }

        .bg-yellow {
            background-color: #fff3cd;
            /* Warna kuning muda */
        }

        .bg-red {
            background-color: #f8d7da;
            /* Warna merah muda */
        }
    </style>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kelas : {{ $data_kelas->nama_kelas ?? '' }}</h3>
            </div>
            {{-- <div class="card-header">
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
            </div> --}}

            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    {{-- <table class="table card-table table-vcenter text-nowrap "> --}}
                    <table class="table table-bordered border-primary  text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th width="300px">Nama </th>
                                @foreach ($dates as $date)
                                    <th>{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        @foreach ($absensi as $siswa_id => $records)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $records->first()->siswa->nisn }}</td>
                                <td>{{ $records->first()->siswa->nama }}</td>
                                @foreach ($dates as $date)
                                    @php
                                        $status = $records->firstWhere('tanggal_absen', $date)->keterangan ?? '';
                                        $style = '';
                                        // Menyesuaikan output berdasarkan nilai keterangan
                                        if ($status === 'Hadir') {
                                            $status = 'H';
                                            $style = 'background-color: #4ed389;';
                                        } elseif ($status === 'Izin') {
                                            $status = 'I';
                                            $style = 'background-color: #ef9255;';
                                        } elseif ($status === 'Sakit') {
                                            $status = 'S';
                                            $style = 'background-color: #3e57dc;';
                                        } elseif ($status === 'Terlambat') {
                                            $status = 'T';
                                            $style = 'background-color: #f3f741;';
                                        } elseif ($status === 'Tanpa Keterangan') {
                                            $status = 'A';
                                            $style = 'background-color: #e96d6d;';
                                        }
                                    @endphp
                                    <td class="text-center fw-bold align-middle" style="{{ $style }}">
                                        {{ $status }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
