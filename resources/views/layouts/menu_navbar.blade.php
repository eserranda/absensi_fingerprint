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

                    <li class="nav-item ">
                        <a class="nav-link" href="/absensi">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-fingerprint-scan" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 11a3 3 0 0 1 6 0c0 1.657 .612 3.082 1 4" />
                                    <path d="M12 11v1.75c-.001 1.11 .661 2.206 1 3.25" />
                                    <path d="M9 14.25c.068 .58 .358 1.186 .5 1.75" />
                                    <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                                    <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                                    <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Absensi
                            </span>
                        </a>
                    </li>

                    <li class="nav-item ">
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

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                                        Data Guru Dan Pegawai
                                    </a>
                                    <a class="dropdown-item" href="/data_siswa">
                                        Data Peserta Didik
                                    </a>

                                </div>
                            </div>
                        </div>
                    </li>

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Extra
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./empty.html">
                                        Empty page
                                    </a>
                                    <a class="dropdown-item" href="./cookie-banner.html">
                                        Cookie banner
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./chat.html">
                                        Chat
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./activity.html">
                                        Activity
                                    </a>
                                    <a class="dropdown-item" href="./gallery.html">
                                        Gallery
                                    </a>
                                    <a class="dropdown-item" href="./invoice.html">
                                        Invoice
                                    </a>
                                    <a class="dropdown-item" href="./search-results.html">
                                        Search results
                                    </a>
                                    <a class="dropdown-item" href="./pricing.html">
                                        Pricing cards
                                    </a>
                                    <a class="dropdown-item" href="./pricing-table.html">
                                        Pricing table
                                    </a>
                                    <a class="dropdown-item" href="./faq.html">
                                        FAQ
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./users.html">
                                        Users
                                    </a>
                                    <a class="dropdown-item" href="./license.html">
                                        License
                                    </a>
                                </div>
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./logs.html">
                                        Logs
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./music.html">
                                        Music
                                    </a>
                                    <a class="dropdown-item" href="./photogrid.html">
                                        Photogrid
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./tasks.html">
                                        Tasks
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./uptime.html">
                                        Uptime monitor
                                    </a>
                                    <a class="dropdown-item" href="./widgets.html">
                                        Widgets
                                    </a>
                                    <a class="dropdown-item" href="./wizard.html">
                                        Wizard
                                    </a>
                                    <a class="dropdown-item" href="./settings.html">
                                        Settings
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./trial-ended.html">
                                        Trial ended
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./job-listing.html">
                                        Job listing
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./page-loader.html">
                                        Page loader
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path
                                        d="M4 13m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path
                                        d="M14 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path
                                        d="M14 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Layout
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./layout-horizontal.html">
                                        Horizontal
                                    </a>
                                    <a class="dropdown-item" href="./layout-boxed.html">
                                        Boxed
                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                    </a>
                                    <a class="dropdown-item" href="./layout-vertical.html">
                                        Vertical
                                    </a>
                                    <a class="dropdown-item" href="./layout-vertical-transparent.html">
                                        Vertical transparent
                                    </a>
                                    <a class="dropdown-item" href="./layout-vertical-right.html">
                                        Right vertical
                                    </a>
                                    <a class="dropdown-item" href="./layout-condensed.html">
                                        Condensed
                                    </a>
                                    <a class="dropdown-item" href="./layout-combo.html">
                                        Combined
                                    </a>
                                </div>
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./layout-navbar-dark.html">
                                        Navbar dark
                                    </a>
                                    <a class="dropdown-item" href="./layout-navbar-sticky.html">
                                        Navbar sticky
                                    </a>
                                    <a class="dropdown-item" href="./layout-navbar-overlap.html">
                                        Navbar overlap
                                    </a>
                                    <a class="dropdown-item" href="./layout-rtl.html">
                                        RTL mode
                                    </a>
                                    <a class="dropdown-item" href="./layout-fluid.html">
                                        Fluid
                                    </a>
                                    <a class="dropdown-item" href="./layout-fluid-vertical.html">
                                        Fluid vertical
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./icons.html">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" />
                                    <path d="M10 10l.01 0" />
                                    <path d="M14 10l.01 0" />
                                    <path d="M10 14a3.5 3.5 0 0 0 4 0" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                4637 icons
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./emails.html">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/mail-opened -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 9l9 6l9 -6l-9 -6l-9 6" />
                                    <path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" />
                                    <path d="M3 19l6 -6" />
                                    <path d="M15 13l6 6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Email templates
                            </span>
                        </a>
                    </li> --}}
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
                            <a class="dropdown-item" href="https://tabler.io/docs" target="_blank" rel="noopener">
                                Documentation
                            </a>
                            <a class="dropdown-item" href="./changelog.html">
                                Changelog
                            </a>
                            <a class="dropdown-item" href="https://github.com/tabler/tabler" target="_blank"
                                rel="noopener">
                                Source code
                            </a>
                            <a class="dropdown-item text-pink" href="https://github.com/sponsors/codecalm"
                                target="_blank" rel="noopener">
                                <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                </svg>
                                Sponsor project!
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
