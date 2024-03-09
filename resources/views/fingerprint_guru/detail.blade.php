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
            <h3 class="card-title">Base info Guru</h3>
        </div>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">Nama</div>
                    <div class="datagrid-content">{{ $data->guru->nama }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">NISN</div>
                    <div class="datagrid-content">{{ $data->guru->nuptk }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Status Pegawai</div>
                    <div class="datagrid-content">{{ $data->guru->status_pegawai }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Jenis PTK</div>
                    <div class="datagrid-content">{{ $data->guru->jenis_ptk }}</div>
                </div>

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

        {{-- <div class="col-auto p-3">
            <a href="#" class="btn btn-ghost-danger disabled" id ="delete_data"
                onclick="deleteData('{{ $data->id }}')">
                Delete Data
            </a>
        </div> --}}

        <div class="btn-list p-3">
            <a href="#" class="btn btn-ghost-danger disabled" id ="delete_data"
                onclick="deleteData('{{ $data->id }}')">
                Delete Data
            </a>
            <a class="btn btn-ghost-yellow" onclick="goBack()">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                </svg>
                Kembali</a>
        </div>
    </div>

    <div class="card">
        <div class="col-12 col-md-9 d-flex flex-column">
            <div class="card-body">
                <h2 class="mb-4">Delete ID Fingerprint</h2>
                <h3 class="card-title  mb-1">ID Finger
                    <span class="form-help mx-2" data-bs-toggle="popover" data-bs-placement="top" data-bs-html="true"
                        data-bs-content="<p>ID Finger yang terdaftar pada modul Fingerprint Guru dan Pegawai, jika tombol hapus di tekan maka akan  menghapus ID Finger yang ada pada modul</p>">?</span>
                </h3>
                <div>
                    <div class="row g-2">

                        <div class="col-auto">
                            <input type="text" class="form-control bg-azure-lt" value=" {{ $data->id_fingerprint }}"
                                readonly id="value_id_fingerprint">
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
            </div>
        </div>
    </div>

    @push('script')
        <script>
            function goBack() {
                window.history.back();
            }

            document.addEventListener("DOMContentLoaded", function() {
                const idFingerprintElement = document.getElementById('id_fingerprint');
                const idFingerprint = idFingerprintElement.textContent.trim();

                if (idFingerprint === '' || idFingerprint === '-') {
                    idFingerprintElement.textContent = '-';
                    document.getElementById('delete_data').classList.remove('disabled');
                    document.getElementById('button_delete').classList.add('disabled');
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
                            url: '/fingerprint_guru/delete/' + id,
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
                                            window.location.href = '/fingerprint_guru';
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

            const button_delete = document.getElementById('button_delete');

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
                        // add class 'btn-loading' to the button        
                        button_delete.classList.add('btn-loading');
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        var data = {
                            modul_fingerprint: modul,
                            id_finger: id_finger
                        };

                        fetch('/fingerprint_guru/deleted_id', {
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
                    fetch('/fingerprint_guru/status_deleted/' + modul + '/' + id_finger, {
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
                            // const button_delete = document.getElementById('button_delete');
                            if (data.deleted_id == 1) {
                                console.log("Data deleted, stopping fetch.");
                                value_id_fingerprint.value = '';
                                idFingerprint = '-';
                                idFingerprintElement.textContent = idFingerprint; // Mengupdate teks pada elemen
                                delete_data.classList.remove('disabled');
                                button_delete.classList.remove('btn-loading');
                                button_delete.classList.add('disabled');
                                clearInterval(intervalId);
                            }

                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }

                intervalId = setInterval(() => getStatusDeleted(modul, id_finger), 3000);
            }
        </script>
    @endpush
@endsection
