<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Dashborad
                            </span>
                        </a>
                    </li>

                    @if (Auth::user()->roles->contains('name', 'admin') || Auth::user()->roles->contains('name', 'guru'))
                        <li class="nav-item ">
                            <a class="nav-link" href="/absensi-matpel">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-checklist" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" />
                                        <path d="M14 19l2 2l4 -4" />
                                        <path d="M9 8h4" />
                                        <path d="M9 12h2" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Absensi Matpel
                                </span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->roles->contains('name', 'admin'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
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
                                <span class="nav-link-title">
                                    Fingerprint
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="/fingerprint_guru">
                                            Fingerprint Pegawai/Guru
                                        </a>
                                        <a class="dropdown-item" href="/fingerprint_siswa">
                                            Fingerprint Peserta Didik
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="/jadwal_pelajaran">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-align-justified" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 6l16 0" />
                                    <path d="M4 12l16 0" />
                                    <path d="M4 18l12 0" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Jadwal
                            </span>
                        </a>
                    </li>

                    @if (Auth::check() &&
                            Auth::user()->roles->contains(function ($role) {
                                return $role->name === 'wali_kelas';
                            }))
                        {{-- @if (Auth::check() && Auth::user()->roles->contains(fn($role) => in_array($role->name, ['wali_kelas']))) --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-list-check">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                        <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                        <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                        <path d="M11 6l9 0" />
                                        <path d="M11 12l9 0" />
                                        <path d="M11 18l9 0" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Rekap Absensi Siswa
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="/rekap-absensi/kehadiran">
                                            Rekap Absensi Kehadiran
                                        </a>
                                        <a class="dropdown-item" href="/rekap-absensi/matpel">
                                            Rekap Absensi Mata Pelajaran
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if (Auth::user()->roles->contains('name', 'admin'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-list-details" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M13 5h8" />
                                        <path d="M13 9h5" />
                                        <path d="M13 15h8" />
                                        <path d="M13 19h5" />
                                        <path
                                            d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path
                                            d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Rekap Absensi
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="/rekap-absensi-guru">
                                            Pegawai/Guru
                                        </a>
                                        <a class="dropdown-item" href="/rekap-absensi-siswa">
                                            Peserta Didik
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif


                    @if (Auth::user()->roles->contains('name', 'admin'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                        <path d="M12 12l8 -4.5" />
                                        <path d="M12 12l0 9" />
                                        <path d="M12 12l-8 -4.5" />
                                        <path d="M16 5.25l-8 4.5" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Data Administrasi
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="/data_guru">
                                            Data Pegawai/Guru
                                        </a>
                                        <a class="dropdown-item" href="/data_siswa">
                                            Data Peserta Didik
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if (Auth::user()->roles->contains('name', 'admin'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-user-heart" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h.5" />
                                        <path
                                            d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Akun
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="/akun/guru">
                                            Akun Pegawai/Guru
                                        </a>
                                        <a class="dropdown-item" href="/akun/siswa">
                                            Akun Peserta Didik
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M15 15l3.35 3.35" />
                                    <path d="M9 15l-3.35 3.35" />
                                    <path d="M5.65 5.65l3.35 3.35" />
                                    <path d="M18.35 5.65l-3.35 3.35" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Pengaturan
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/tahun-ajaran">
                                Semester & Thn Ajaran
                            </a>
                            @if (Auth::user()->roles->contains('name', 'admin'))
                                <a class="dropdown-item" href="/matpel">
                                    Mata Pelajaran
                                </a>
                                <a class="dropdown-item" href="/jam_absensi">
                                    Jam Absensi
                                </a>
                                <a class="dropdown-item" href="/kelas" rel="noopener">
                                    Kelas
                                </a>
                                <a class="dropdown-item" href="/fingerprint">
                                    Modul Fingerprint
                                </a>
                                <a class="dropdown-item" href="/role">
                                    Role
                                </a>
                            @endif
                        </div>
                    </li>
                    {{-- <li class="nav-item ">
                        <a class="nav-link" href="/matpel">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
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
                            <span class="nav-link-title">
                                Mata Pelajaran
                            </span>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</header>
</div>
