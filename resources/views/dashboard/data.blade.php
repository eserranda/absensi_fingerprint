@extends('layouts.master')

@push('headcss')
    <link href="{{ asset('assets') }}/dist/css/dataTables-bootstrap5.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endpush
@section('content')
    <style>
        #clock {
            font-family: 'Verdana', sans-serif;
            font-size: 25px;
            /* font-weight: bold; */
            /* Membuat huruf tebal */
            text-align: center;
            color: #000000;
            /* Warna teks */
            background-color: rgb(105, 202, 194);
            /* Warna latar belakang */
            padding: 8px;
            /* Padding untuk menjaga jarak dari tepi */
            border-radius: 10px;
            /* Membuat sudut elemen lebih lembut */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* Menambahkan bayangan lembut */
            width: 250px;
            /* Lebar jam */
            margin-left: auto;
            margin-right: auto;
            letter-spacing: 2px;
            /* Menambahkan jarak antara karakter */
        }

        @media (max-width: 600px) {
            #clock {
                display: none;
            }
        }

        @media (min-width: 768px) {
            #desktop-card {
                height: 18rem;
            }
        }
    </style>

    <div class="col-12 mb-2">
        <div class="card">
            <div class="card-stamp card-stamp-lg">
                <div class="card-stamp-icon bg-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" />
                        <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" />
                        <path d="M12 11v2a14 14 0 0 0 2.5 8" />
                        <path d="M8 15a18 18 0 0 0 1.8 6" />
                        <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" />
                    </svg>
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title mb-1">
                            SISTEM MONITORING ABSENSI, SMAN 1 SUMARORONG
                        </h2>
                        <div class="markdown text-secondary ">
                            @if (Auth::user()->roles->contains('name', 'admin') ||
                                    Auth::user()->roles->contains('name', 'guru_bk') ||
                                    Auth::user()->roles->contains('name', 'wali_kelas') ||
                                    Auth::user()->roles->contains('name', 'guru'))
                                <p>Hallo <span class="fw-bold">{{ Auth::user()->guru->nama }}</span>,
                            @endif
                            Selamat datang anda login sebagai
                            {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-auto ms-auto">
                        <div id="clock"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @if (Auth::user()->roles->contains('name', 'admin') || Auth::user()->roles->contains('name', 'guru')) --}}
    @if (Auth::user()->roles->contains('name', 'admin'))
        <div class="card mt-2">
            <div class="card-body">
                <h3 class="card-title">Status Modul Fingerprint</h3>
                <div class="row row-deck row-cards" id="data-container">

                </div>

                <div class="row row-deck row-cards mt-1">

                    <div class="col-md-6 col-xl-3 ">
                        <div class="card card-sm">
                            <div class="card-body">
                                <label class="form-label">Mode Absen</label>
                                <div class="row g-2 mb-4">
                                    <div class="col-8">
                                        <select type="text" class="form-select mode_absen">
                                            <option value="0">Masuk</option>
                                            <option value="1">Pulang</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-indigo finger" data-finger="guru">
                                            OK
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 ">
                        <div class="card card-sm">
                            <div class="card-body">
                                <label class="form-label">Mode Absen</label>
                                <div class="row g-2 mb-4">
                                    <div class="col-8">
                                        <select type="text" class="form-select mode_absen">
                                            <option value="0">Masuk</option>
                                            <option value="1">Pulang</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-indigo finger" data-finger="finger1">
                                            OK
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 ">
                        <div class="card card-sm">
                            <div class="card-body">
                                <label class="form-label">Mode Absen</label>
                                <div class="row g-2 mb-4">
                                    <div class="col-8">
                                        <select type="text" class="form-select mode_absen">
                                            <option value="0">Masuk</option>
                                            <option value="1">Pulang</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-indigo finger" data-finger="finger2">
                                            OK
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 ">
                        <div class="card card-sm">
                            <div class="card-body">
                                <label class="form-label">Mode Absen</label>
                                <div class="row g-2 mb-4">
                                    <div class="col-8">
                                        <select type="text" class="form-select mode_absen">
                                            <option value="0">Masuk</option>
                                            <option value="1">Pulang</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-indigo finger" data-finger="finger3">
                                            OK
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row row-deck row-cards mt-2">
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <h3 class="card-title mb-1">
                                    <span id="totalUsers">0</span>
                                </h3>
                                <div class="text-secondary">
                                    Data Users
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="/akun/guru" class="btn btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <h3 class="card-title mb-1">
                                    <span id="totalGuru">0</span>
                                </h3>
                                <div class="text-secondary">
                                    Data Guru
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="/data_guru" class="btn btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-green text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                                        <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <h3 class="card-title mb-1">
                                    <span id="totalSiswa">0</span>
                                </h3>
                                <div class="text-secondary">
                                    Data Siswa
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="/data_siswa" class="btn btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-fingerprint" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" />
                                        <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" />
                                        <path d="M12 11v2a14 14 0 0 0 2.5 8" />
                                        <path d="M8 15a18 18 0 0 0 1.8 6" />
                                        <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <h3 class="card-title mb-1">
                                    <span id="totalFingerprintGuru">0</span>
                                </h3>
                                <div class="text-secondary">
                                    Fingerprint guru
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="/fingerprint_guru" class="btn btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-fingerprint" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" />
                                        <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" />
                                        <path d="M12 11v2a14 14 0 0 0 2.5 8" />
                                        <path d="M8 15a18 18 0 0 0 1.8 6" />
                                        <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <h3 class="card-title mb-1">
                                    <span id="totalFingerprintSiswa">0</span>
                                </h3>
                                <div class="text-secondary">
                                    Fingerprint siswa
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="/fingerprint_siswa" class="btn btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-list-letters" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M11 6h9" />
                                        <path d="M11 12h9" />
                                        <path d="M11 18h9" />
                                        <path d="M4 10v-4.5a1.5 1.5 0 0 1 3 0v4.5" />
                                        <path d="M4 8h3" />
                                        <path d="M4 20h1.5a1.5 1.5 0 0 0 0 -3h-1.5h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <h3 class="card-title mb-1">
                                    <span id="totalMatpel">0</span>
                                </h3>
                                <div class="text-secondary">
                                    Mata Pelajaran
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="/matpel" class="btn btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                        <path
                                            d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 12l.01 0" />
                                        <path d="M13 12l2 0" />
                                        <path d="M9 16l.01 0" />
                                        <path d="M13 16l2 0" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <h3 class="card-title mb-1">
                                    <span id="totalJadwal">0</span>
                                </h3>
                                <div class="text-secondary">
                                    Jadwal pelajaran
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="/jadwal_pelajaran" class="btn btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-edit"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.645 0 1.218 .305 1.584 .78" />
                                        <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4" />
                                        <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <h3 class="card-title mb-1">
                                    <span id="totalKelas">0</span>
                                </h3>
                                <div class="text-secondary">
                                    Kelas
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="/kelas" class="btn btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-clipboard-data" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                        <path
                                            d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 17v-4" />
                                        <path d="M12 17v-1" />
                                        <path d="M15 17v-2" />
                                        <path d="M12 17v-1" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <h3 class="card-title mb-1">
                                    <span id="totalAbsensiMatpel">0</span>
                                </h3>
                                <div class="text-secondary">
                                    Absensi Matpel
                                </div>
                            </div>
                            <div class="col-auto">
                                {{-- <a href="/kelas" class="btn btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    @endif

    @if (Auth::user()->roles->contains('name', 'guru'))
        <div class="row row-cards mt-2">
            <div class="col-md-6">
                <div class="card" id="desktop-card">
                    <div class="card-body">
                        <h3 class="card-title">Jadwal Mengajar Anda Hari ini</h3>
                        <p class="card-subtitle" id="date"></p>

                        <div class="hr-text  hr-text-left my-4">Detail</div>

                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Mata Pelajaran</div>
                                <div class="datagrid-content fw-bold">
                                    {{ $dataMatpel->data_matpel->nama_matpel ?? 'Tidak ada jadwal' }}
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Guru/Pengajar</div>
                                <div class="datagrid-content fw-bold">
                                    {{ $dataMatpel->data_guru->nama ?? 'Tidak ada jadwal' }} </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Kelas</div>
                                <div class="datagrid-content fw-bold">{{ $dataMatpel->kelas ?? 'Tidak ada jadwal' }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Waktu</div>
                                <div class="datagrid-content fw-bold">
                                    {{ $dataMatpel->jam_mulai ?? '  ' }} - {{ $dataMatpel->jam_selesai ?? ' ' }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" style="display: {{ $dataMatpel ? 'block' : 'none' }}">
                <div class="card" id="desktop-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Status Modul Fingerprint</h3>
                                <div class="row row-deck row-cards mb-1" id="status-modul">
                                </div>
                                {{-- <span class="text-danger text-sm">*Pastikan Modul dalam kondisi Online sebelum melakukan
                                    proses absensi
                                </span> --}}
                            </div>

                            <div class="col-md-6" id="status-absen">
                                <h3 class="card-title">Jumlah Absensi</h3>
                                <div class="card bg-gray-300" style="height: 7rem">
                                    <div class="card-body">
                                        <div class="col-auto">
                                            <div class="text-secondary">Telah Absen</div>
                                            {{-- <h3 class="card-title my-2" id="data-count">0
                                                <span class="text-muted small mx-2">Siswa</span>
                                            </h3> --}}
                                            <h3 class="card-title my-1">
                                                <span id="data-count">0</span>
                                                <span class="text-muted small mx-2">Siswa</span>
                                            </h3>

                                            <div class="progress progress-sm">
                                                <div class="progress-bar progress-bar-indeterminate" id="progress"
                                                    style="display: none"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="hr-text  hr-text-right my-4">Action</div>

                        <div class="row">
                            <span class="col fw-bold p-2">Klik Tombol Absen Untuk Memulai Proses Absen</span>
                            <div class="col-auto">
                                <div class="btn-list">
                                    <a class="btn btn-primary {{ $dataMatpel ? '' : 'disabled' }}" id="btn-absen"
                                        onclick="absen('{{ $dataMatpel ? $dataMatpel->kelas : '' }}', '{{ $dataMatpel ? $dataMatpel->data_matpel->nama_matpel : '' }}')">
                                        Absen
                                    </a>
                                    <a class="btn btn-success {{ !$dataMatpel ? 'disabled' : '' }}" id="btn-reset"
                                        onclick="reset_modul('{{ $dataMatpel ? $dataMatpel->kelas : '' }}')">Selesai
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                <h3 class="card-title">Data Absensi Mata Pelajaran {{ $dataMatpel->data_matpel->nama_matpel ?? '' }}</h3>

                <div class="card-actions">
                    {{-- <a href="#" class="btn btn-success">
                        Exel
                    </a> --}}
                    <a href="absensi-matpel" class="btn btn-primary">
                        Rekap absensi
                    </a>
                </div>
            </div>
            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table id="data-absensi" class="table card-table table-vcenter text-nowrap absensi-today">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Hari</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Nama Guru</th>
                                <th>Matpel</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @if (Auth::user()->roles->contains('name', 'guru_bk'))
        <div class="card mt-2">
            <div class="card-header">
                <h3 class="card-title">Data Siwa Terlambat, Bolos, Tanpa Keterangan</h3>
                {{-- <div class="btn-actions">
                <select class="form-select" id="filterRoles">
                    <option value="terlambat">Terlambat</option>
                    <option value="bolos">Bolos</option>
                    <option value="bolos">Tanpa Keterangan</option>
                </select>
            </div>

            <button class="btn btn-icon mx-2" id="reload"> <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                </svg>
            </button> --}}
            </div>

            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->siswa->nama }}</td>
                                    <td>{{ $d->siswa->nisn }}</td>
                                    <td>{{ $d->siswa->kelas }}</td>
                                    <td>{{ $d->tanggal_absen }}</td>
                                    <td>{{ $d->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @push('script')
        <script>
            function updateTime() {
                var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ];
                var currentTime = new Date();
                var hours = currentTime.getHours();
                var minutes = currentTime.getMinutes();
                var seconds = currentTime.getSeconds();
                var day = days[currentTime.getDay()];
                var date = currentTime.getDate();
                var month = months[currentTime.getMonth()];
                var year = currentTime.getFullYear();

                // Menambahkan angka 0 di depan angka tunggal
                hours = (hours < 10 ? "0" : "") + hours;
                minutes = (minutes < 10 ? "0" : "") + minutes;
                seconds = (seconds < 10 ? "0" : "") + seconds;

                // Format waktu
                var timeString = hours + ":" + minutes + ":" + seconds + " Wita" + "<br>" + day;

                // Memasukkan waktu ke dalam elemen dengan id "clock"
                document.getElementById("clock").innerHTML = timeString;

                // Menampilkan hari dan tanggal
                @if (Auth::user()->roles->contains('name', 'guru'))
                    var dateString = day + ", " + date + " " + month + " " + year;
                    document.getElementById("date").innerHTML = dateString;
                @endif
            }

            setInterval(updateTime, 1000);
            updateTime();

            function getFormattedDate(date) {
                const year = date.getFullYear().toString();
                let month = (date.getMonth() + 1).toString();
                let day = date.getDate().toString();

                // Tambahkan 0 di depan bulan dan tanggal jika nilainya kurang dari 10
                if (month.length < 2) {
                    month = '0' + month;
                }
                if (day.length < 2) {
                    day = '0' + day;
                }

                return year + month + day;
            }

            @if (Auth::user()->roles->contains('name', 'guru'))
                async function absen(kelas, matpel) {
                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        const response = await fetch('/fingerprint-modul/status-matpel', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                kelas: kelas,
                                matpel: matpel
                            })
                        });
                        const data = await response.json();
                        if (data.status) {
                            document.getElementById('btn-reset').classList.remove('disabled');
                            document.getElementById('progress').style.display = 'block';

                            // document.getElementById('status-absen').style.display = 'block';
                        }
                        console.log(data);
                    } catch (error) {
                        return error;
                    }
                }

                async function reset_modul(kelas) {
                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        const response = await fetch('/fingerprint-modul/reset-modul', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                kelas: kelas,
                            })
                        });
                        const data = await response.json();
                        if (data.status) {
                            document.getElementById('progress').style.display = 'none';
                        }
                        console.log(data);
                    } catch (error) {
                        return error;
                    }
                }

                async function getDataAbsensi() {
                    const id_matpel =
                        "{{ $dataMatpel ? ($dataMatpel->data_matpel ? $dataMatpel->data_matpel->id : '') : '' }}";
                    const id_guru = "{{ $dataMatpel ? ($dataMatpel->data_guru ? $dataMatpel->data_guru->id : '') : '' }}";

                    if (id_matpel && id_guru) {
                        try {
                            const response = await fetch('/fingerprint-modul/get-data-today' + '/' + id_matpel + '/' +
                                id_guru);
                            const responseData = await response.json();
                            if (responseData.message === "success") {
                                const data = responseData.data;
                                const table = document.getElementById('data-absensi');
                                const tableBody = table.querySelector('tbody');
                                tableBody.innerHTML = '';

                                data.forEach((item, index) => {
                                    const row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${new Date(item.tanggal).toLocaleDateString('en-GB')}</td>
                                    <td>${item.hari}</td>
                                    <td>${item.siswa.nama}</td>  
                                    <td>${item.kelas}</td>
                                    <td>${item.guru.nama}</td>  
                                    <td>${item.matpel.nama_matpel}</td>
                                    <td>${item.keterangan}</td>
                                </tr>
                            `;
                                    tableBody.innerHTML += row; // Tambahkan baris ke tabel
                                });

                                const countElement = document.getElementById('data-count');
                                countElement.innerText = responseData.count;

                            } else {
                                console.error('Data tidak berhasil diambil');
                            }

                        } catch (error) {
                            return error;
                        }
                    }
                }

                setInterval(getDataAbsensi, 5000);
                getDataAbsensi();

                const modul = "{{ $dataMatpel ? $dataMatpel->kelas : '' }}";
                async function cekOneStatusModul() {
                    if (modul) {
                        try {
                            const response = await fetch('/dashboard/cek-one-status-modul' + '/' + modul);
                            const data = await response.json();
                            const container = document.getElementById('status-modul');
                            container.innerHTML = '';

                            // Buat elemen baru untuk menampilkan status modul
                            const statusCard = document.createElement('div');
                            statusCard.className = 'card bg-gray-300 card-sm';
                            // statusCard.style.height = '6rem';

                            statusCard.innerHTML = `
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="status-indicator status-${data.active ? 'green' : 'red'} status-indicator-animated">
                                            <span class="status-indicator-circle"></span>
                                            <span class="status-indicator-circle"></span>
                                            <span class="status-indicator-circle"></span>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <h3 class="card-title mb-1">${data.modul_fingerprint} </h3>
                                        <span class="badge text-white bg-${data.active ? 'green' : 'red'}">${data.active ? 'Online/Terhubung' : 'Offline'}</span>  
                                        <p class="text-muted my-1">${data.status=== 'matpel' ? 'mode : Absen Matpel' : data.status === 'scan' ? 'mode : Absen Harian' : data.status === 'daftar' ? 'mode : Daftar Finger' : data.status === 'hapus' ? 'mode : Hapus Finger' : ''}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                            // Tambahkan elemen statusCard ke dalam container
                            container.appendChild(statusCard);
                        } catch (error) {
                            console.error('Error:', error);
                        }
                    }
                }
                cekOneStatusModul();
                setInterval(cekOneStatusModul, 5000);
            @endif



            @if (Auth::user()->roles->contains('name', 'admin'))
                document.addEventListener('DOMContentLoaded', function() {
                    async function getData() {
                        try {
                            const data = fetch('/dashboard/count_data')
                                .then(response => response.json())
                                .then(data => {
                                    document.getElementById('totalGuru').textContent = data.totalGuru;
                                    document.getElementById('totalSiswa').textContent = data.totalSiswa;
                                    document.getElementById('totalMatpel').textContent = data.totalMatpel;
                                    document.getElementById('totalJadwal').textContent = data.totalJadwal;
                                    document.getElementById('totalKelas').textContent = data.totalKelas;
                                    document.getElementById('totalFingerprintGuru').textContent = data
                                        .totalFingerprintGuru;
                                    document.getElementById('totalFingerprintSiswa').textContent = data
                                        .totalFingerprintSiswa;
                                    document.getElementById('totalAbsensiMatpel').textContent = data
                                        .totalAbsensiMatpel;
                                    document.getElementById('totalUsers').textContent = data
                                        .totalUsers;
                                })
                        } catch (error) {
                            return error
                        }
                    }
                    getData()
                    setInterval(getData, 5000);

                    async function cekStatusModul() {
                        try {
                            const response = await fetch('/dashboard/cek-status-modul');
                            const data = await response.json();
                            // Membuat elemen untuk setiap data dan menambahkannya ke dalam container
                            const container = document.getElementById('data-container');
                            container.innerHTML = ''; // Bersihkan kontainer sebelum menambahkan elemen baru
                            data.forEach(item => {
                                const card = document.createElement('div');
                                card.classList.add('col-md-6', 'col-xl-3');
                                card.innerHTML = `
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="status-indicator status-${item.active ? 'green' : 'red'} status-indicator-animated">
                                                    <span class="status-indicator-circle"></span>
                                                    <span class="status-indicator-circle"></span>
                                                    <span class="status-indicator-circle"></span>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <h3 class="card-title mb-1">${item.modul_fingerprint}</h3>
                                               <span class="badge text-white bg-${item.active ? 'green' : 'red'}">${item.active ? 'Online' : 'Offline'}</span>  
                                              <p class="text-muted mt-1 mb-0">${item.status=== 'matpel' ? 'mode : Absen Matpel' : (item.status === 'scan' && item.mode_absen === "1") ? 'mode : Absen Pulang': (item.status === 'scan' && item.mode_absen === "0") ? 'mode : Absen Masuk' :item.status === 'daftar' ? 'mode : Daftar Finger' : item.status === 'hapus' ? 'mode : Hapus Finger' : ''}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                                container.appendChild(card);
                            });
                        } catch (error) {
                            console.error('Error:', error);
                        }
                    }
                    cekStatusModul()
                    setInterval(cekStatusModul, 5000);
                });
            @endif

            $('.finger').click(function() {
                var modeAbsen = $(this).closest('.card-body').find('.mode_absen').val();


                var fingerType = $(this).data('finger');

                // Objek data yang akan dikirim ke server
                var dataToSend = {
                    _token: '{{ csrf_token() }}',
                    modul: fingerType,
                    mode_absen: modeAbsen,
                };

                console.log(dataToSend)

                $.ajax({
                    url: '/fingerprint-modul/mode-absen',
                    type: 'POST',
                    data: dataToSend,
                    success: function(response) {
                        Swal.fire(
                            'Updated!',
                            'Data berhasil diupdate!',
                            'success'
                        );
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

            });
        </script>
    @endpush
@endsection
