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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-actions col-md-2">
                    <select class="form-select" id="filterKelas">
                        <option value="X IPS 1">X IPS 1</option>
                        <option value="XI MIPA 1">XI MIPA 1</option>
                        <option value="XII IPS 1">XII IPS 1</option>
                    </select>
                </div>

                <button class="btn btn-icon mx-2" id="reload"> <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                    </svg>
                </button>

                <div class="card-actions">
                    <button class="btn btn-primary" id ="add_data"> Tambah Data</button>
                </div>
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
                                <th>Email</th>
                                <th>Role</th>
                                <th class="w-1">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Tambah data  --}}
    <div class="modal modal-blur fade" id="modal_add_data" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Users Siswa</h5>
                    <button type="button" class="btn-close" onclick="closeModalAdd()"></button>
                </div>
                <form action="" method="POST" id="form_add_user_siswa">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <select class="form-select" id="id_siswa" name="id_siswa">

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">NISN</label>
                                    <input type="text" class="form-control" id="username" name="username" readonly>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">

                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary ms-auto" type="submit">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit data  --}}
    <div class="modal modal-blur fade" id="modal_edit_data" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data User Siswa</h5>
                    <button type="button" class="btn-close" onclick="closeModalEdit()"></button>
                </div>
                <form action="" method="POST" id="form_edit_data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                                    {{-- <input type="hidden" class="form-control" id="data_id_siswa" name="data_id_siswa"> --}}
                                    <label class="form-label">Nama Lengkap</label>
                                    <select class="form-select  text-bg-cyan cursor-not-allowed" id="edit_id_siswa"
                                        name="edit_id_siswa">

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">NISN</label>
                                    <input type="text" class="form-control text-bg-cyan cursor-not-allowed"
                                        id="edit_username" name="edit_username" readonly>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="edit_email" name="edit_email">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" id="edit_password" name="edit_password">

                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary ms-auto" type="submit">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#modal_add_data').on('shown.bs.modal', function() {
                    $("#id_siswa").select2({
                        theme: "bootstrap-5",
                        placeholder: "Pilih Nama Siswa",
                        minimumInputLength: 1,
                        dropdownParent: $("#modal_add_data"),
                        ajax: {
                            url: '/get_data_siswa',
                            dataType: 'json',
                            processResults: function(data) {
                                if (data && data.length > 0) {
                                    var results = $.map(data, function(item) {
                                        return {
                                            // id: item.nama,
                                            id: item.id,
                                            text: item.nama
                                        };
                                    });
                                    return {
                                        results: results
                                    };
                                }

                            },
                        }
                    });

                    $("#id_siswa").on("change", async function() {
                        var id = $(this).val();
                        try {
                            const response = await fetch('/get_nisn_siswa/' + id, {
                                method: 'GET',
                            });
                            const responseData = await response.json();
                            if (responseData.status === true) {
                                var nuptk = responseData.data;
                                $('#username').val(nuptk);
                            } else {
                                throw new Error('Gagal mendapatkan data nuptk');
                            }
                        } catch (error) {
                            console.error('Terjadi kesalahan:', error);
                        }
                    });

                });
            });

            function hapus(id) {
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
                            url: '/akun/delete/' + id,
                            type: 'DELETE',
                            data: {
                                _token: csrfToken
                            },
                            success: function(response) {
                                console.log('Response:', response);
                                if (response.status) {
                                    Swal.fire(
                                        'Terhapus!',
                                        'Data mata pelajaran berhasil dihapus.',
                                        'success'
                                    );
                                    $('.datatable').DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan saat menghapus data mata pelajaran.',
                                        'error'
                                    );
                                }
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data mata pelajaran.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

            async function edit(id) {
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    const response = await fetch('/akun/show/' + id, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                        },
                    })
                    const responseData = await response.json();

                    if (!response.status) {
                        throw new Error('Gagal mengambil data');
                    }
                    console.log(response);
                    const form = document.getElementById('form_edit_data');
                    // form.elements['data_id_siswa'].value = responseData.data.id_siswa;
                    form.elements['edit_id'].value = responseData.data.id;
                    form.elements['edit_username'].value = responseData.data.username;
                    form.elements['edit_email'].value = responseData.data.email;

                    var editIdSiswaSelect = document.getElementById('edit_id_siswa');
                    fetch('/data_siswa/getid/' + responseData.data.id_siswa, {
                            method: 'GET',
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal mengambil data tambahan');
                            }
                            return response.json();
                        })
                        .then(data => {
                            updateOptionsAndSelect2Siswa(editIdSiswaSelect, data.data.id, data.data.nama);
                        });
                    $('#modal_edit_data').modal('show');

                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                    throw error;
                }

                // $("#edit_id_siswa").select2({
                //     theme: "bootstrap-5",
                //     placeholder: "Pilih Siswa",
                //     minimumInputLength: 1,
                //     dropdownParent: $("#modal_edit_data"),
                //     ajax: {
                //         url: '/get_data_siswa',
                //         dataType: 'json',
                //         processResults: function(data) {
                //             if (data && data.length > 0) {
                //                 var results = $.map(data, function(item) {
                //                     return {
                //                         id: item.id,
                //                         text: item.nama
                //                     };
                //                 });
                //                 return {
                //                     results: results
                //                 };
                //             }
                //         },
                //     }
                // });
            }

            function updateOptionsAndSelect2Siswa(selectElement, id, namaSiswa) {
                $(selectElement).empty();

                var option = new Option(namaSiswa, id, true, true);
                $(selectElement).append(option);

                $(selectElement).trigger('change');
            }

            document.getElementById('form_edit_data').addEventListener('submit', async function(event) {
                event.preventDefault();

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    const response = await fetch('/akun/update_akun_siswa', {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    }).then(response => response.json());
                    if (response.errors) {
                        Object.keys(response.errors).forEach(fieldName => {
                            const inputField = document.getElementById(fieldName);
                            inputField.classList.add('is-invalid');
                            inputField.nextElementSibling.textContent = response.errors[fieldName][0];
                        });

                        const validFields = document.querySelectorAll('.is-invalid');
                        validFields.forEach(validField => {
                            const fieldName = validField.id;
                            if (!response.errors[fieldName]) {
                                validField.classList.remove('is-invalid');
                                validField.nextElementSibling.textContent = '';
                            }
                        });
                    } else {
                        console.log(response);
                        const invalidInputs = document.querySelectorAll('.is-invalid');
                        invalidInputs.forEach(invalidInput => {
                            invalidInput.value = '';
                            invalidInput.classList.remove('is-invalid');
                            const errorNextSibling = invalidInput.nextElementSibling;
                            if (errorNextSibling && errorNextSibling.classList.contains(
                                    'invalid-feedback')) {
                                errorNextSibling.textContent = '';
                            }
                        });
                        const form = document.getElementById('form_edit_data');
                        form.reset();
                        $('#modal_edit_data').modal('hide');
                        Swal.fire(
                            'Tersimpan!',
                            'Data mata pelajaran berhasil diupdate.',
                            'success'
                        )
                        $('.datatable').DataTable().ajax.reload();
                    }
                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                    throw error;
                }
            });

            function closeModalEdit() {
                const invalidInputs = document.querySelectorAll('.is-invalid');
                invalidInputs.forEach(invalidInput => {
                    invalidInput.value = '';
                    invalidInput.classList.remove('is-invalid');
                    const errorNextSibling = invalidInput.nextElementSibling;
                    if (errorNextSibling && errorNextSibling.classList.contains(
                            'invalid-feedback')) {
                        errorNextSibling.textContent = '';
                    }
                });
                const form = document.getElementById('form_edit_data');
                form.reset();
                $('#modal_edit_data').modal('hide');
            }

            function closeModalAdd() {
                const invalidInputs = document.querySelectorAll('.is-invalid');
                invalidInputs.forEach(invalidInput => {
                    invalidInput.value = '';
                    invalidInput.classList.remove('is-invalid');
                    const errorNextSibling = invalidInput.nextElementSibling;
                    if (errorNextSibling && errorNextSibling.classList.contains(
                            'invalid-feedback')) {
                        errorNextSibling.textContent = '';
                    }
                });

                $('#modal_add_data').modal('hide');
                const form = document.getElementById('form_add_user_siswa');
                form.reset();
                $('#modal_add_data').modal('hide');
            }

            // document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add_data').addEventListener('click', function() {
                $('#modal_add_data').modal('show');
            });

            document.getElementById('form_add_user_siswa').addEventListener('submit', async function(event) {
                event.preventDefault();
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    const response = await fetch('/akun/store_user_siswa', {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                    }).then(response => response.json());

                    if (!response.status) {
                        handleValidationErrors(response.errors);
                    } else {
                        console.log(response);

                        const invalidInputs = document.querySelectorAll('.is-invalid');

                        // Iterasi melalui setiap elemen input
                        invalidInputs.forEach(invalidInput => {
                            // Kosongkan nilai elemen input
                            invalidInput.value = '';
                            // Hapus kelas "is-invalid" dari elemen input
                            invalidInput.classList.remove('is-invalid');
                            // Kosongkan pesan kesalahan di sebelah input (jika ada)
                            const errorNextSibling = invalidInput.nextElementSibling;
                            if (errorNextSibling && errorNextSibling.classList.contains(
                                    'invalid-feedback')) {
                                errorNextSibling.textContent = '';
                            }
                        });
                        // Close modal
                        $('#modal_add_data').modal('hide');
                        const form = document.getElementById('form_add_user_siswa');
                        form.reset();
                        $('#modal_add_data').modal('hide');
                        Swal.fire(
                            'Tersimpan!',
                            'Data berhasil diupdate.',
                            'success'
                        )
                        $('.datatable').DataTable().ajax.reload();
                    }
                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                    throw error;
                }
            });

            function handleValidationErrors(errors) {
                if (errors && typeof errors === 'object') {
                    Object.keys(errors).forEach(fieldName => {
                        const inputField = document.getElementById(fieldName);
                        if (fieldName === 'id_siswa') {
                            inputField.classList.add('is-invalid');
                        } else {
                            inputField.classList.add('is-invalid');
                            inputField.nextElementSibling.textContent = errors[fieldName][0];
                        }
                    });

                    // fix error pad a add user siswa
                    const validFields = document.querySelectorAll('.is-invalid');
                    validFields.forEach(validField => {
                        const fieldName = validField.id;
                        if (!errors[fieldName]) {
                            validField.classList.remove('is-invalid');
                            validField.nextElementSibling.textContent = '';
                        }
                        // if (fieldName === 'id_siswa') {
                        //     validField.classList.remove('is-invalid');
                        // } else {
                        //     validFields.classList.remove('is-invalid');
                        //     validFields.nextElementSibling.textContent = errors[fieldName][0];
                        // }
                    });
                }
            }
            // });

            $(document).ready(function() {
                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('data_user.siswa') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '#',
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'kelas',
                            name: 'kelas'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });


                $('#filterRoles').on('change', function() {
                    const selectedRole = $(this).val();
                    myDataTable.ajax.url('{{ route('data_user.guru') }}?role=' + selectedRole).load();
                });
            });
        </script>
    @endpush
@endsection
