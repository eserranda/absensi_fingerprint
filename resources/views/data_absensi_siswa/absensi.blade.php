@extends('layouts.master')
@push('headcss')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- <link href="{{ asset('assets') }}/dist/css/dataTables-bootstrap5.min.css" rel="stylesheet" /> --}}
    {{-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 icon-tabler icon-tabler-gender-bigender"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M11 11m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M19 3l-5 5" />
                        <path d="M15 3h4v4" />
                        <path d="M11 16v6" />
                        <path d="M8 19h6" />
                    </svg>
                    {{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                </div>
            </div>
        </div>

        <div class="col-auto d-none d-md-flex">
            <a href="/rekap-absensi-siswa" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                </svg>
                Kembali
            </a>
        </div>

    </div>

    <div class="row row-deck row-cards mt-3">
        <div class="col-sm-6 col-lg-6">
            <div class="card bg-gray-300" style="height: 16rem">
                <div class="card-body">
                    <div class="col-lg-8 mx-4">
                        <select type="text" class="form-select" id="select-users" name="bulan">
                            <option value="" selected disabled>Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="divide-y m-4">
                        <div class="row ">
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary mb-2">Hadir</div>
                                    <strong id="total_absen"></strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary mb-2">Terlambat</div>
                                    <strong id="terlambat"></strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary mb-2">Tanpa Keterangan</div>
                                    <strong id="tanpa_keterangan"></strong>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary mb-2">Izin</div>
                                    <strong id="izin"></strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary mb-2">Sakit</div>
                                    <strong id="sakit"></strong>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="text-secondary mb-2"></div>
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
                                Gender : <strong>{{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</strong>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 icon-tabler icon-tabler-map"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13" />
                                    <path d="M9 4v13" />
                                    <path d="M15 7v13" />
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
            <div class="card" style="height: 35rem">
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
                        <div class="divide-y" id="absensi">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-6">
            <div class="card" style="height: 35rem">
                <canvas class="mb-5" id="myPieChart"></canvas>


            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', async function() {
                const id = {{ $data->id }};

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    const formData = new FormData();
                    formData.append('id', id);
                    const response = await fetch('{{ route('rekap-absensi-siswa.filter-bulan') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    });

                    if (response.ok) {
                        const responseData = await response.json();
                        const dataAbsensi = responseData.dataAbsensi;
                        const countData = responseData.countData;

                        document.getElementById('total_absen').textContent = countData.total_absen;
                        document.getElementById('terlambat').textContent = countData.terlambat;
                        document.getElementById('tanpa_keterangan').textContent = countData
                            .tanpa_keterangan;
                        document.getElementById('izin').textContent = countData.izin;
                        document.getElementById('sakit').textContent = countData.sakit;

                        createPieChart(countData);

                        const absensi = document.getElementById('absensi');
                        absensi.innerHTML = '';
                        dataAbsensi.forEach(absensiData => {
                            const htmlString =
                                `
                                <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong class="${absensiData.hari === 'Minggu' || absensiData.keterangan === 'Tanpa Keterangan'  ? 'text-red'  : absensiData.keterangan === 'Terlambat' ? 'text-yellow' : ''}">${absensiData.tanggal_absen }</strong>
                                    <div class="text-secondary ${absensiData.hari === 'Minggu' || absensiData.keterangan === 'Tanpa Keterangan' ? 'text-red' : absensiData.keterangan === 'Terlambat' ? 'text-yellow' : ''}">
                                    ${absensiData.hari}
                                </div>
                            </div>

                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong class="${absensiData.keterangan === 'Terlambat' ? 'text-yellow' : ''}"> ${absensiData.jam_masuk != null ? absensiData.jam_masuk.slice(0, -3) :  '<div class="text-red ">-</div>'}</strong>
                                    <div class="text-secondary" style="display: ${absensiData.hari === 'Minggu' || absensiData.keterangan === 'Tanpa Keterangan' ? 'none'  : 'block'};">Jam Masuk</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>${absensiData.jam_keluar != null ? absensiData.jam_keluar.slice(0, -3) : '<div class="text-red ">-</div>'}</strong>
                                    <div class="text-secondary" style="display: ${absensiData.hari === 'Minggu' || absensiData.keterangan === 'Tanpa Keterangan' ? 'none'  : 'block'};">Jam Pulang</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                 <div class="text-secondary ${absensiData.keterangan === 'Tanpa Keterangan' ? 'text-red' : absensiData.keterangan === 'Terlambat' ? 'text-yellow' : ''} my-2"><strong>${absensiData.keterangan != null ? absensiData.keterangan : '<div class="text-red">-</div>'}</strong></div>
                                </div>
                            </div>
                        </div>
                             `;

                            absensi.innerHTML += htmlString;
                            console.log(responseData);
                        });
                        console.log(responseData);
                    } else {
                        console.error('Error:', response.statusText);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
                // });

                // document.addEventListener("DOMContentLoaded", function() {
                var el;
                window.TomSelect && (new TomSelect(el = document.getElementById('select-users'), {
                    copyClassesToDropdown: false,
                    dropdownParent: 'body',
                    controlInput: '<input>',
                    render: {
                        item: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data
                                    .customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                        option: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data
                                    .customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                    },
                }));

                // const id = {{ $data->id }};

                document.getElementById('select-users').addEventListener('change', async function() {
                    var selectedMonth = this.value;
                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        const formData = new FormData();
                        formData.append('selectedMonth', selectedMonth);
                        formData.append('id', id);
                        absensi.innerHTML = '';
                        const response = await fetch(
                            '{{ route('rekap-absensi-siswa.filter-bulan') }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                            });

                        if (response.ok) {
                            const responseData = await response.json();
                            const dataAbsensi = responseData.dataAbsensi;
                            const countData = responseData.countData;

                            await createPieChart(countData);

                            document.getElementById('total_absen').textContent = countData.total_absen;
                            document.getElementById('terlambat').textContent = countData.terlambat;
                            document.getElementById('tanpa_keterangan').textContent = countData
                                .tanpa_keterangan;
                            document.getElementById('izin').textContent = countData.izin;
                            document.getElementById('sakit').textContent = countData.sakit;

                            const absensi = document.getElementById('absensi');
                            absensi.innerHTML = '';
                            dataAbsensi.forEach(absensiData => {
                                const htmlString =
                                    `
                                    <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong class="${absensiData.hari === 'Minggu' || absensiData.keterangan === 'Tanpa Keterangan'  ? 'text-red'  : absensiData.keterangan === 'Terlambat' ? 'text-yellow' : ''}">${absensiData.tanggal_absen }</strong>
                                    <div class="text-secondary ${absensiData.hari === 'Minggu' || absensiData.keterangan === 'Tanpa Keterangan' ? 'text-red' : absensiData.keterangan === 'Terlambat' ? 'text-yellow' : ''}">
                                    ${absensiData.hari}
                                </div>
                            </div>

                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong class="${absensiData.keterangan === 'Terlambat' ? 'text-yellow' : ''}"> ${absensiData.jam_masuk != null ? absensiData.jam_masuk.slice(0, -3) :  '<div class="text-red ">-</div>'}</strong>
                                    <div class="text-secondary" style="display: ${absensiData.hari === 'Minggu' || absensiData.keterangan === 'Tanpa Keterangan' ? 'none'  : 'block'};">Jam Masuk</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>${absensiData.jam_keluar != null ? absensiData.jam_keluar.slice(0, -3) : '<div class="text-red ">-</div>'}</strong>
                                    <div class="text-secondary" style="display: ${absensiData.hari === 'Minggu' || absensiData.keterangan === 'Tanpa Keterangan' ? 'none'  : 'block'};">Jam Pulang</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                 <div class="text-secondary ${absensiData.keterangan === 'Tanpa Keterangan' ? 'text-red' : absensiData.keterangan === 'Terlambat' ? 'text-yellow' : ''} my-2"><strong>${absensiData.keterangan != null ? absensiData.keterangan : '<div class="text-red">-</div>'}</strong></div>
                                </div>
                            </div>
                        </div>
                                     `;

                                absensi.innerHTML += htmlString;
                                console.log(responseData);
                            });
                        } else {
                            // Tangani kesalahan jika permintaan tidak berhasil
                            console.error('Error:', response.statusText);
                        }
                    } catch (error) {
                        // Tangani kesalahan jika ada
                        console.error('Error:', error);
                    }
                });


                async function createPieChart(countData) {
                    var myPieChart = Chart.getChart("myPieChart");

                    if (myPieChart) {
                        myPieChart.destroy();
                    }
                    var ctx = document.getElementById('myPieChart').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Hadir', 'Terlambat', 'Sakit', 'Izin', 'Tanpa keterangan'],
                            datasets: [{
                                label: 'Total',
                                data: [
                                    countData.total_absen,
                                    countData.terlambat,
                                    countData.sakit,
                                    countData.izin,
                                    countData.tanpa_keterangan
                                ],
                                backgroundColor: [
                                    'rgba(27, 158, 44, 0.6)',
                                    'rgba(230, 230, 60, 0.6)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(60, 100, 230, 0.6)',
                                    'rgba(235, 57, 28, 0.6)'
                                ],
                                borderWidth: 0,
                                hoverOffset: 20
                            }]
                        },
                        options: {
                            responsive: true,
                            layout: {
                                autoPadding: false,
                                padding: {
                                    top: 10,
                                    left: 30,
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Chart Total Absensi Siswa',
                                    padding: {
                                        top: 10,
                                        bottom: 10
                                    },
                                    font: {
                                        size: 20,
                                    }
                                },
                                labels: {
                                    render: (context) => {
                                        return context.value
                                    },
                                    fontColor: '#000000',
                                },
                                legend: {
                                    display: true,
                                    position: "right",
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20,
                                    },
                                }
                            },

                        }
                    });

                    return myPieChart;
                }
            });
        </script>
    @endpush
@endsection

{{-- <div class="row">
            <div class="col">
                <div class="text-truncate">
                    <strong>${absensi.tanggal_absen}</strong>
                    <div class="text-secondary">${absensi.hari}</div>
                </div>
            </div>
            <div class="col">
                <div class="text-truncate">
                    <strong>${absensi.jam_masuk}</strong>
                    <div class="text-secondary">Jam Masuk</div>
                </div>
            </div>
            <div class="col">
                <div class="text-truncate">
                    <strong>${absensi.jam_keluar}</strong>
                    <div class="text-secondary">Jam Pulang</div>
                </div>
            </div>
            <div class="col">
                <div class="text-truncate">
                    <div class="text-secondary my-2"> <strong>${absensi.keterangan}</strong>
                    </div>

                </div>
            </div>
        </div>

    </div> --}}
