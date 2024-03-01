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
                <div class="btn-actions">
                    <select class="form-select" id="filterRoles">
                        <option value="guru">Guru</option>
                        <option value="wali_kelas">Wali Kelas</option>
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
                    <a class="btn btn-primary" id="add_data">
                        Tambah Data
                    </a>
                </div>
            </div>

            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NUPTK</th>
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
                    <h5 class="modal-title">Tambah Users Guru</h5>
                    <button type="button" class="btn-close" onclick="closeModalAdd()"></button>
                </div>
                <form action="" method="POST" id="form_add_user_guru">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <select class="form-select" id="id_guru" name="id_guru">

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">NUPTK</label>
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
                        <div id="roles-container"></div>
                        {{-- <div class="row">
                            <div class="form-label">Role</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="guru" id="guru"
                                        value="guru" checked>
                                    <span class="form-check-label">Guru</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="wali_kelas" id="wali_kelas"
                                        value="wali_kelas">
                                    <span class="form-check-label">Wali Kelas</span>
                                </label>
                            </div>
                        </div> --}}

                        <div class="modal-footer">
                            <button href="" class="btn btn-primary ms-auto" type="submit">
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

                    <h5 class="modal-title">Edit Data </h5>
                    <button type="button" class="btn-close" onclick="closeModalEdit()"></button>

                </div>
                <form action="" method="POST" id="form_edit_data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                                    <select class="form-select" id="edit_id_guru" name="edit_id_guru">

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">NUPTK</label>
                                    <input type="text" class="form-control" id="edit_username" name="edit_username"
                                        readonly>
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

                            {{-- <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">

                                    <div class="invalid-feedback"></div>
                                </div>
                            </div> --}}
                        </div>
                        <div id="roles-container"></div>


                        <div class="modal-footer">
                            <button href="" class="btn btn-primary ms-auto" type="submit">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





    @push('script')
        <script type="text/javascript">
            function edit(id) {
                fetch('/akun/show/' + id, {
                        method: 'GET',
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengambil data siswa');
                        }
                        return response.json();
                    })

                    .then(data => {
                        const form = document.getElementById('form_edit_data');
                        form.elements['edit_id'].value = data.data.id;

                        $('#modal_edit_data').modal('show');
                    })

                $("#edit_id_guru").select2({
                    theme: "bootstrap-5",
                    placeholder: "Pilih guru",
                    minimumInputLength: 1,
                    dropdownParent: $("#modal_edit_data"),
                    ajax: {
                        url: '/get_data_guru',
                        dataType: 'json',
                        processResults: function(data) {
                            if (data && data.length > 0) {
                                var results = $.map(data, function(item) {
                                    return {
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
            }



            // document.getElementById('form_edit_data').addEventListener('submit', async function(event) {
            //     event.preventDefault();

            //     try {
            //         const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            //         const response = await fetch('/akun/update_data_matpel', {
            //             method: 'POST',
            //             body: new FormData(this),
            //             headers: {
            //                 'X-CSRF-TOKEN': csrfToken,
            //             },
            //         }).then(response => response.json());
            //         if (response.errors) {

            //             Object.keys(response.errors).forEach(fieldName => {
            //                 const inputField = document.getElementById(fieldName);
            //                 inputField.classList.add('is-invalid');
            //                 inputField.nextElementSibling.textContent = response.errors[fieldName][0];
            //             });

            //             const validFields = document.querySelectorAll('.is-invalid');
            //             validFields.forEach(validField => {
            //                 const fieldName = validField.id;
            //                 if (!response.errors[fieldName]) {
            //                     validField.classList.remove('is-invalid');
            //                     validField.nextElementSibling.textContent = '';
            //                 }
            //             });
            //         } else {
            //             console.log(response);
            //             const invalidInputs = document.querySelectorAll('.is-invalid');
            //             invalidInputs.forEach(invalidInput => {
            //                 invalidInput.value = '';
            //                 invalidInput.classList.remove('is-invalid');
            //                 const errorNextSibling = invalidInput.nextElementSibling;
            //                 if (errorNextSibling && errorNextSibling.classList.contains(
            //                         'invalid-feedback')) {
            //                     errorNextSibling.textContent = '';
            //                 }
            //             });
            //             const form = document.getElementById('form_edit_data');

            //             const rolesContainer = document.getElementById('roles-container');
            //             rolesContainer.innerHTML = '';

            //             form.reset();
            //             $('#modal_edit_data').modal('hide');
            //             Swal.fire(
            //                 'Tersimpan!',
            //                 'Data mata pelajaran berhasil diupdate.',
            //                 'success'
            //             )
            //             $('.datatable').DataTable().ajax.reload();
            //         }
            //     } catch (error) {
            //         console.error('Terjadi kesalahan:', error);
            //         throw error;
            //     }
            // });

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
                const form = document.getElementById('form_edit_data_matpel');
                const rolesContainer = document.getElementById('roles-container');
                rolesContainer.innerHTML = '';
                form.reset();
                $('#modal_edit_data').modal('hide');
            }

            function handleValidationErrors(errors) {
                if (errors && typeof errors === 'object') {
                    Object.keys(errors).forEach(fieldName => {
                        const inputField = document.getElementById(fieldName);
                        inputField.classList.add('is-invalid');
                        inputField.nextElementSibling.textContent = errors[fieldName][0];
                    });

                    // Hapus kelas 'is-invalid' dari elemen formulir yang telah diperbaiki
                    const validFields = document.querySelectorAll('.is-invalid');
                    validFields.forEach(validField => {
                        const fieldName = validField.id;
                        if (!errors[fieldName]) {
                            validField.classList.remove('is-invalid');
                            validField.nextElementSibling.textContent = '';
                        }
                    });
                }
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
                const form = document.getElementById('form_add_user_guru');
                form.reset();
                const rolesContainer = document.getElementById('roles-container');
                rolesContainer.innerHTML = '';
                $('#modal_add_data').modal('hide');
            }

            $(document).ready(function() {
                $('#modal_add_data').on('shown.bs.modal', function() {
                    fetch('/akun/get_roles', {
                            method: 'GET',
                        })
                        .then(response => response.json())
                        .then(responseData => {
                            if (responseData.status === true) {
                                console.log(responseData);
                                const rolesContainer = document.getElementById('roles-container');
                                // Buat dan tambahkan formLabel ke rolesContainer
                                const formLabel = document.createElement('div');
                                formLabel.className = 'form-label';
                                formLabel.textContent = 'Role';
                                rolesContainer.appendChild(formLabel);
                                responseData.data.forEach(role => {
                                    const htmlString =
                                        ` <label class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="${role.id}" name="role_id[]" id="${role.name}">
                                          <span class="form-check-label">${role.name}</span>
                                          </label> 
                                        `;
                                    const label = document.createElement('label');
                                    label.innerHTML = htmlString;
                                    rolesContainer.appendChild(label);
                                });
                            } else {
                                throw new Error('Gagal mendapatkan data Roles');
                            }


                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                        });
                    $("#id_guru").select2({
                        theme: "bootstrap-5",
                        placeholder: "Pilih guru",
                        minimumInputLength: 1,
                        dropdownParent: $("#modal_add_data"),
                        ajax: {
                            url: '/get_data_guru',
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

                    $("#id_guru").on("change", async function() {
                        var id = $(this).val();
                        try {
                            const response = await fetch('/get_nuptk_guru/' + id, {
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


                // Add Data 
                const form = document.getElementById('form_add_user_guru');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(form);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    fetch('/akun/store_user_guru', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data.message);
                            if (data.errors) {
                                Object.keys(data.errors).forEach(fieldName => {
                                    const inputField = document.getElementById(fieldName);
                                    if (fieldName === 'id_guru') {
                                        inputField.classList.add('is-invalid');
                                    } else {
                                        inputField.classList.add('is-invalid');
                                        inputField.nextElementSibling.textContent = data.errors[
                                            fieldName][0];
                                    }
                                });

                                // Hapus kelas 'is-invalid' dari elemen formulir yang telah diperbaiki
                                const validFields = form.querySelectorAll('.is-invalid');
                                validFields.forEach(validField => {
                                    const fieldName = validField.id;
                                    if (!data.errors[fieldName]) {
                                        if (fieldName === 'id_guru') {
                                            validField.classList.remove('is-invalid');
                                        } else {
                                            validField.classList.remove('is-invalid');
                                            validField.nextElementSibling.textContent = '';
                                        }
                                    }
                                });
                            } else {
                                console.log(data.message);
                                const validFields = form.querySelectorAll('.is-invalid');
                                validFields.forEach(validField => {
                                    validField.classList.remove('is-invalid');
                                    validField.nextElementSibling.textContent = '';
                                });

                                const rolesContainer = document.getElementById('roles-container');
                                rolesContainer.innerHTML = '';
                                form.reset();
                                $('#modal_add_data').modal('hide');
                                Swal.fire(
                                    'Tersimpan!',
                                    'Data berhasil ditambahkan.',
                                    'success'
                                );
                                $('.datatable').DataTable().ajax.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menambahkan  data.',
                                'error'
                            );
                        });
                });
            });

            document.getElementById('add_data').addEventListener('click', function() {
                $('#modal_add_data').modal('show');
            });




            $(document).ready(function() {
                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('data_user.guru') }}",
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
                    myDataTable.ajax.url('{{ route('data_user.guru') }}?role=' + selectedRole)
                        .load();
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
        </script>
    @endpush
@endsection
