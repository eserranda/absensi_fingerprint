@extends('layouts.master')
@push('headcss')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- <link href="{{ asset('assets') }}/dist/css/dataTables-bootstrap5.min.css" rel="stylesheet" /> --}}
    {{-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> --}}
@endpush
@section('content')
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="avatar avatar-xl rounded"
                style="background-image: url({{ asset('assets') }}/images/profile.png)"></span>
        </div>
        <div class="col">
            <h1 class="fw-bold mb-0">{{ $data->nama }}</h1>
            <div class="my-2 fw-bold"> NISN : {{ $data->nisn }} </div>
            <div class="list-inline list-inline-dots text-secondary">
                <div class="list-inline-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d=" M0 0h24v24H0z" fill="none" />
                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6l0 13" />
                        <path d="M12 6l0 13" />
                        <path d="M21 6l0 13" />
                    </svg>
                    {{ $data->kelas }}
                </div>
                <div class="list-inline-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13" />
                        <path d="M9 4v13" />
                        <path d="M15 7v13" />
                    </svg>
                    {{ $data->alamat }}
                </div>

                <div class="list-inline-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 20h18v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8z" />
                        <path
                            d="M3 14.803c.312 .135 .654 .204 1 .197a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1c.35 .007 .692 -.062 1 -.197" />
                        <path d="M12 4l1.465 1.638a2 2 0 1 1 -3.015 .099l1.55 -1.737z" />
                    </svg>
                    {{ $data->tanggal_lahir->format('d-m-Y') }}
                </div>
            </div>
        </div>

    </div>
    <div class="row row-deck row-cards mt-3">
        <div class="col-sm-6 col-lg-6">
            <div class="card bg-gray-300" style="height: 14rem">
                <div class="card-body">
                    <h2 class="card-title mx-4">Data Absensi</h2>
                    <div class="divide-y m-4">

                        <div class="row ">
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary">Total Absen</div>
                                    <strong>8</strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary">Terlambat</div>
                                    <strong>1</strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary">Tanpa Keterangan</div>
                                    <strong>0</strong>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary">Izin</div>
                                    <strong>0</strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary">Sakit</div>
                                    <strong>1</strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary"></div>
                                    <strong></strong>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Data Siswa</div>
                    <div class="row row-deck row-cards mt-3">
                        <div class="col-sm-6 col-lg-6">
                            <div class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 icon-tabler icon-tabler-user"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                </svg>
                                Nama : <strong>{{ $data->nama }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 icon-tabler icon-tabler-id"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                    <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M15 8l2 0" />
                                    <path d="M15 12l2 0" />
                                    <path d="M7 16l10 0" />
                                </svg>
                                NISN : <strong>{{ $data->nisn }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon me-2 icon-tabler icon-tabler-gender-bigender" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M11 11m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M19 3l-5 5" />
                                    <path d="M15 3h4v4" />
                                    <path d="M11 16v6" />
                                    <path d="M8 19h6" />
                                </svg>
                                Gender: <strong>{{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fisll="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d=" M0 0h24v24H0z" fill="none" />
                                    <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                    <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                    <path d="M3 6l0 13" />
                                    <path d="M12 6l0 13" />
                                    <path d="M21 6l0 13" />
                                </svg>
                                Kelas : <strong>{{ $data->kelas }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-6">
                            <div class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                    <path d="M16 3v4" />
                                    <path d="M8 3v4" />
                                    <path d="M4 11h16" />
                                    <path d="M11 15h1" />
                                    <path d="M12 15v3" />
                                </svg>
                                TTL : <strong>{{ $data->tempat_lahir }},
                                    {{ $data->tanggal_lahir->format('d-m-Y') }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-6">
                            <div class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon me-2 icon-tabler icon-tabler-home-star" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M19.258 10.258l-7.258 -7.258l-9 9h2v7a2 2 0 0 0 2 2h4" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h1.5" />
                                    <path
                                        d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                                </svg>
                                Agama : <strong>{{ $data->agama }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-6">
                            <div class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                                Alamat : <strong>{{ $data->alamat }}</strong>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row row-deck row-cards my-3">
        <div class="col-sm-6 col-lg-6">
            <div class="card" style="height: 28rem">
                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                    <div class="divide-y">
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>Tanggal</strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>Jam Masuk</strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>Jam Pulang</strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>Keterangan</strong>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>16 February</strong>
                                    <div class="text-secondary">Rabu</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>07.00</strong>
                                    <div class="text-secondary">Jam Masuk</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>13.00</strong>
                                    <div class="text-secondary">Jam Pulang</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary my-2"> <strong>Hadir</strong>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>16 February</strong>
                                    <div class="text-secondary">Rabu</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>07.00</strong>
                                    <div class="text-secondary">Jam Masuk</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>13.00</strong>
                                    <div class="text-secondary">Jam Pulang</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary my-2"> <strong>Hadir</strong>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>16 February</strong>
                                    <div class="text-secondary">Rabu</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>07.00</strong>
                                    <div class="text-secondary">Jam Masuk</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>13.00</strong>
                                    <div class="text-secondary">Jam Pulang</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary my-2"> <strong>Hadir</strong>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>16 February</strong>
                                    <div class="text-secondary">Rabu</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>07.00</strong>
                                    <div class="text-secondary">Jam Masuk</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>13.00</strong>
                                    <div class="text-secondary">Jam Pulang</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary my-2"> <strong>Hadir</strong>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>16 February</strong>
                                    <div class="text-secondary">Rabu</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>07.00</strong>
                                    <div class="text-secondary">Jam Masuk</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>13.00</strong>
                                    <div class="text-secondary">Jam Pulang</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary my-2"> <strong>Hadir</strong>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>16 February</strong>
                                    <div class="text-secondary">Rabu</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>07.00</strong>
                                    <div class="text-secondary">Jam Masuk</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>13.00</strong>
                                    <div class="text-secondary">Jam Pulang</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary my-2"> <strong>Hadir</strong>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-6">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    <ul id="absensi-list"></ul>
    @push('script')
        <script>
            $(document).ready(function() {

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                var id = {{ $data->id }}
                fetch('/daftar-absensi/detail', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    .then(response => response.json())
                    .then(data => {})
                    .catch(error => {
                        console.error('Error:', error);
                    });

                // const absensiList = document.getElementById('absensi-list');
                // const siswaId = {{ $data->id }};

                // async function fetchAbsensiBySiswaId(id) {
                //     try {
                //         const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                //         const response = await fetch('/daftar-absensi/detail', {
                //             method: 'POST',
                //             headers: {
                //                 'X-CSRF-TOKEN': csrfToken,
                //                 'Content-Type': 'application/json'
                //             },
                //             body: JSON.stringify({
                //                 id: id
                //             })
                //         });
                //         const data = await response.json();

                //         // Menampilkan daftar absensi dalam elemen ul
                //         data.forEach(absensi => {
                //             const listItem = document.createElement('li');
                //             listItem.textContent =
                //                 `Tanggal: ${absensi.tanggal_absen}, Jam Masuk: ${absensi.jam_masuk}, Jam Keluar: ${absensi.jam_keluar}`;
                //             absensiList.appendChild(listItem);
                //         });
                //     } catch (error) {
                //         console.error('Error fetching absensi data:', error);
                //     }
                // }
                // fetchAbsensiBySiswaId(siswaId);
            });
        </script>
    @endpush
@endsection
