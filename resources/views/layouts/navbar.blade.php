        <!-- Navbar -->
        <div class="sticky-top">
            <header class="navbar navbar-expand-md sticky-top d-print-none">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                        aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href=".">
                            <img src="{{ asset('assets') }}/static/logo1.png" width="110" height="32"
                                alt="Tabler" class="navbar-brand-image">
                        </a>
                    </h1>
                    <div class="navbar-nav flex-row order-md-last">

                        <div class="d-none d-md-flex  mx-2 ">
                            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                                data-bs-toggle="tooltip" data-bs-placement="bottom">
                                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                                </svg>
                            </a>
                            <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                                data-bs-toggle="tooltip" data-bs-placement="bottom">
                                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path
                                        d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                                </svg>
                            </a>

                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                aria-label="Open user menu">
                                <span class="avatar avatar-sm"
                                    style="background-image: url(./static/avatars/000m.jpg)"></span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>
                                        @if (Auth::user()->roles->contains('name', 'admin') ||
                                                Auth::user()->roles->contains('name', 'guru_bk') ||
                                                Auth::user()->roles->contains('name', 'wali_kelas') ||
                                                Auth::user()->roles->contains('name', 'guru'))
                                            <div>{{ Auth::user()->guru->nama }}</div>
                                        @endif
                                    </div>
                                    <div class="mt-1 small text-secondary">
                                        {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <p class="dropdown-item fw-bold"> {{ Auth::user()->email }}</p>
                                <p class="dropdown-item"> {{ Auth::user()->username }}</p>
                                {{-- <a href="#" class="dropdown-item">Status</a>
                            <a href="./profile.html" class="dropdown-item">Profile</a>
                            <a href="#" class="dropdown-item">Feedback</a> --}}
                                <div class="dropdown-divider"></div>
                                {{-- <a href="./settings.html" class="dropdown-item">Settings</a> --}}
                                {{-- <a href="/fingerprint-modul/reset-all-modul" class="dropdown-item">Reset Modul</a> --}}
                                <a href="#" id="resetModulLink" class="dropdown-item">Reset Modul</a>
                                <a href="/logout" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>


            <script>
                $(document).ready(function() {
                    $('#resetModulLink').click(function(e) {
                        e.preventDefault(); // Mencegah tautan mengarahkan ke URL

                        $.ajax({
                            url: '/fingerprint-modul/reset-all-modul',
                            type: 'GET',
                            success: function(response) {
                                alert(response.message); // Menampilkan pesan respons dari server
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText); // Menampilkan pesan error jika ada
                                alert('Terjadi kesalahan saat memperbarui modul.');
                            }
                        });
                    });
                });
            </script>
