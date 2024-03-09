@extends('layouts.master')
@push('headcss')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endpush
@section('content')
    <div class="card mb-3 ">
        <div class="card-header">
            <h3 class="card-title">Base info siswa</h3>
        </div>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">Nama</div>
                    <div class="datagrid-content">{{ $data->siswa->nama }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">NISN</div>
                    <div class="datagrid-content">{{ $data->siswa->nisn }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Kelas</div>
                    <div class="datagrid-content">{{ $data->siswa->kelas }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Gender</div>
                    <div class="datagrid-content">{{ $data->siswa->jenis_kelamin }}</div>
                </div>
                {{-- <br> --}}
                <div class="datagrid-item">
                    <div class="datagrid-title">ID Fingerprint</div>
                    <div class="datagrid-content">
                        <span class="badge badge-pill bg-cyan text-white" id="id_fingerprint">{{ $data->id_fingerprint }}
                        </span>
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">Modul Finger Terdaftar</div>
                    <div class="datagrid-content">{{ $data->modul_fingerprint->modul_fingerprint }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Api Key Modul</div>
                    <div class="datagrid-content">{{ $data->modul_fingerprint->apiKey }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Status Modul</div>
                    <div class="datagrid-content"><span class="badge bg-teal text-white">Connected</span></div>
                </div>
            </div>
        </div>

        <div class="col-auto p-3">
            <a href="#" class="btn btn-ghost-danger disabled" id ="delete_data"
                onclick="deleteData('{{ $data->id }}')">
                Delete Data
            </a>
        </div>
    </div>

    <div class="card">
        <div class="col-12 col-md-9 d-flex flex-column">
            <div class="card-body">
                <h2 class="mb-4">Delete Data</h2>
                <h3 class="card-title  mb-1">ID Finger</h3>
                <div>
                    <div class="row g-2">

                        <div class="col-auto">
                            <input type="text" class="form-control" value=" {{ $data->id_fingerprint }}" readonly
                                id="value_id_fingerprint">
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-danger btn-icon" aria-label="Button"
                                onclick="deleteIDFinger('{{ $data->modul_fingerprint->modul_fingerprint }}', '{{ $data->id_fingerprint }}')"
                                id="button_delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <h3 class="card-title mt-4">Password</h3>
                <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.
                </p>
                <div>
                    <a href="#" class="btn">
                        Set new password
                    </a>
                </div> --}}
                {{-- <h3 class="card-title mt-4">Public profile</h3>
                <p class="card-subtitle">Making your profile public means that anyone on the Dashkit network will be able
                    to
                    find
                    you.</p>
                <div>
                    <label class="form-check form-switch form-switch-lg">
                        <input class="form-check-input" type="checkbox">
                        <span class="form-check-label form-check-label-on">You're currently visible</span>
                        <span class="form-check-label form-check-label-off">You're
                            currently invisible</span>
                    </label>
                </div> --}}
            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const idFingerprintElement = document.getElementById('id_fingerprint');
                const idFingerprint = idFingerprintElement.textContent.trim();

                if (idFingerprint === '' || idFingerprint === '-') {
                    idFingerprintElement.textContent = '-';
                    document.getElementById('delete_data').classList.remove('disabled');
                }
            });


            function deleteData(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '/fingerprint_siswa/delete/' + id,
                            type: 'DELETE',
                            data: {
                                _token: csrfToken
                            },
                            success: function(response) {
                                console.log('Response:', response);
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: 'Data berhasil dihapus.',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = '/fingerprint_siswa';
                                        }
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan saat menghapus data.',
                                        'error'
                                    );
                                }
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

            function deleteIDFinger(modul, id_finger) {
                let intervalId;
                Swal.fire({
                    title: 'Hapus ID Finger!',
                    text: 'Data fingerprint akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        var data = {
                            modul_fingerprint: modul,
                            id_finger: id_finger
                        };

                        fetch('/fingerprint_moduls/deleted_id', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify(data)
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Gagal menghapus data');
                                }
                                return response.json();
                            })
                            .then(responseData => {
                                // Panggil getStatusDeleted hanya setelah deleteData berhasil
                                getStatusDeleted(modul, id_finger);
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }
                });


                function getStatusDeleted(modul, id_finger) {
                    fetch('/fingerprint_moduls/status_deleted/' + modul + '/' + id_finger, {
                            method: 'GET',
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal mendapatkan status data.');
                            }
                            return response.json(); // Mengambil data JSON setelah memastikan respons sukses
                        })
                        .then(data => {
                            console.log(data);
                            const delete_data = document.getElementById('delete_data');

                            const idFingerprintElement = document.getElementById('id_fingerprint');
                            let idFingerprint = idFingerprintElement.textContent.trim();

                            const value_id_fingerprint = document.getElementById('value_id_fingerprint');
                            const button_delete = document.getElementById('button_delete');
                            if (data.deleted_id == 1) {
                                console.log("Data deleted, stopping fetch.");
                                value_id_fingerprint.value = '';
                                idFingerprint = '-';
                                idFingerprintElement.textContent = idFingerprint; // Mengupdate teks pada elemen
                                delete_data.classList.remove('disabled');
                                button_delete.classList.add('disabled');
                                clearInterval(intervalId);
                            }

                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }

                // const modul = '{{ $data->modul_fingerprint->modul_fingerprint }}';
                // const id_finger = '{{ $data->id_fingerprint }}';

                intervalId = setInterval(() => getStatusDeleted(modul, id_finger), 3000);
            }
        </script>
    @endpush
@endsection
