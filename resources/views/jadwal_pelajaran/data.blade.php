@extends('layouts.master')
@push('headcss')
    <!-- data table -->
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-actions col-6">
                    <label class="col-form-label mx-4">KELAS</label>
                    <div class="col-3">
                        <select class="form-select" id="filterKelas">
                            <option value="X IPS 1">X IPS 1</option>
                            <option value="XI MIPA 1">XI MIPA 1</option>
                            <option value="XII IPS 1">XII IPS 1</option>
                        </select>
                    </div>
                </div>
                {{-- <button class="btn btn-success mx-2 " id="reload">Reload</button> --}}
                <div class="card-actions">
                    @if (Auth::user()->roles->contains('name', 'admin'))
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal_add_jadwal">
                            Tambah Jadwal
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body border-bottom py-3 ">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Matpel</th>
                                <th>Jam</th>
                                <th>Guru/Pengajar</th>
                                <th>Kelas</th>
                                <th>Ruangan</th>
                                @if (Auth::user()->roles->contains('name', 'admin'))
                                    <th class="w-1">Opsi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal add data --}}
    <div class="modal  modal-blur fade" id="modal_add_jadwal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                    <button type="button" class="btn-close" onclick="closeModalAdd()"></button>

                </div>
                <form action="" method="POST" id="form_add_jadwal">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Hari</label>
                                    <select class="form-select" id="hari" name="hari">
                                        <option value="">- Pilih Hari -</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Matpel</label>
                                    <select class="form-select" id="id_matpel" name="id_matpel">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Mulai</label>
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
                                    <div class="invalid-feedback"></div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pengajar</label>
                                    <select class="form-select" id="id_guru" name="id_guru">

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kelas</label>
                                    <select class="form-select" id="kelas" name="kelas">
                                        <option value="">- Pilih Kelas -</option>
                                        <option value="XI MIPA 1">XI MIPA 1</option>
                                        <option value="X IPS 1">X IPS 1</option>
                                        <option value="XII IPS 1">XII IPS 1</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Ruangan</label>
                                    <select class="form-select" id="ruangan" name="ruangan">
                                        <option value="">- Pilih Ruangan -</option>
                                        <option value="XI MIPA 1">XI MIPA 1</option>
                                        <option value="X IPS 1">X IPS 1</option>
                                        <option value="XII IPS 1">XII IPS 1</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary " type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit data  --}}
    <div class="modal  modal-blur fade" id="modal_edit_data" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                    <button type="button" class="btn-close" onclick="closeModalEdit()"></button>

                </div>
                <form action="" method="POST" id="form_edit_jadwal">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="edit_id">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Hari</label>
                                    <select class="form-select" id="edit_hari" name="edit_hari">
                                        {{-- <option value="">- Pilih Hari -</option> --}}
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Matpel</label>
                                    <select class="form-select" id="edit_id_matpel" name="edit_id_matpel">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Mulai</label>
                                    <input type="time" class="form-control" id="edit_jam_mulai"
                                        name="edit_jam_mulai">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control" id="edit_jam_selesai"
                                        name="edit_jam_selesai">
                                    <div class="invalid-feedback"></div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pengajar</label>
                                    <select class="form-select" id="edit_id_guru" name="edit_id_guru">

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kelas</label>
                                    <select class="form-select" id="edit_kelas" name="edit_kelas">
                                        <option value="">- Pilih Kelas -</option>
                                        <option value="XI MIPA 1">XI MIPA 1</option>
                                        <option value="X IPS 1">X IPS 1</option>
                                        <option value="XII IPS 1">XII IPS 1</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Ruangan</label>
                                    <select class="form-select" id="edit_ruangan" name="edit_ruangan">
                                        <option value="">- Pilih Ruangan -</option>
                                        <option value="XI MIPA 1">XI MIPA 1</option>
                                        <option value="X IPS 1">X IPS 1</option>
                                        <option value="XII IPS 1">XII IPS 1</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button class="btn btn-primary " type="submit">
                            Update
                        </button> --}}
                        <button type="button" tabindex="2" class="btn btn-primary"
                            onclick="updateData()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script type="text/javascript">
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

                $('#modal_add_jadwal').modal('hide');
                const form = document.getElementById('form_add_jadwal');
                form.reset();
                $('#modal_add_jadwal').modal('hide');
            }

            function hapus(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Jadwal pelajaran akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '/jadwal_pelajaran/delete/' + id,
                            type: 'DELETE',
                            data: {
                                _token: csrfToken
                            },
                            success: function(response) {
                                console.log('Response:', response);
                                if (response.status) {
                                    Swal.fire(
                                        'Terhapus!',
                                        'Jadwal pelajaran berhasil dihapus.',
                                        'success'
                                    );
                                    $('.datatable').DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan saat menghapus Jadwal pelajaran.',
                                        'error'
                                    );
                                }
                            },
                            error: function(error) {
                                console.log('Gagal menghapus Jadwal pelajaran: ' + error);
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus Jadwal pelajaran.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }
            // function addData() {
            //     $('#modal_add_jadwal').modal('show');
            // }

            $(document).ready(function() {
                $('#modal_add_jadwal').on('shown.bs.modal', function() {
                    $("#id_guru").select2({
                        theme: "bootstrap-5",
                        placeholder: "Pilih guru",
                        minimumInputLength: 1,
                        dropdownParent: $("#modal_add_jadwal"),
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
                                    // results.unshift({
                                    //     id: '',
                                    //     text: 'Pilih guru'
                                    // });
                                    return {
                                        results: results
                                    };
                                }
                            },
                        }
                    });

                    $("#id_matpel").select2({
                        theme: "bootstrap-5",
                        placeholder: "Pilih Matpel",
                        // minimumInputLength: 1,
                        dropdownParent: $("#modal_add_jadwal"),
                        ajax: {
                            url: '/get_data_matpel',
                            dataType: 'json',
                            processResults: function(data) {
                                if (data && data.length > 0) {
                                    var results = $.map(data, function(item) {
                                        return {
                                            id: item.id,
                                            text: item.nama_matpel
                                        };
                                    });
                                    // results.unshift({
                                    //     id: '',
                                    //     text: 'Pilih guru'
                                    // });
                                    return {
                                        results: results
                                    };
                                }
                            },
                        }
                    });
                });

                const form = document.getElementById('form_add_jadwal');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(form);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    fetch('/simpan_jadwal_pelajaran', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(errorData => {
                                    throw new Error(errorData.message);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data.message);
                            if (data.errors) {

                                Object.keys(data.errors).forEach(fieldName => {
                                    const inputField = document.getElementById(fieldName);
                                    inputField.classList.add('is-invalid');
                                    inputField.nextElementSibling.textContent = data.errors[
                                        fieldName][0];
                                });

                                // Hapus kelas 'is-invalid' dari elemen formulir yang telah diperbaiki
                                const validFields = form.querySelectorAll('.is-invalid');
                                validFields.forEach(validField => {
                                    const fieldName = validField.id;
                                    if (!data.errors[fieldName]) {
                                        validField.classList.remove('is-invalid');
                                        validField.nextElementSibling.textContent = '';
                                    }
                                });
                            } else {
                                console.log(data.message);
                                form.reset();
                                $('#modal_add_jadwal').modal('hide');
                                Swal.fire(
                                    'Tersimpan!',
                                    'Jadwal pelajaran berhasil ditambahkan.',
                                    'success'
                                );
                                $('.datatable').DataTable().ajax.reload();
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Gagal!',
                                error.message || 'Terjadi kesalahan saat menambahkan Jadwal pelajaran.',
                                'error'
                            );
                        });
                });

            });

            $(document).ready(function() {
                const selectedKelas = $('#filterKelas').val();
                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 50,
                    ajax: `{{ route('jadwal_pelajaran.data') }}?kelas=${selectedKelas}`,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '#',
                            searchable: false
                        },
                        {
                            data: 'hari',
                            name: 'hari'
                        },
                        {
                            data: 'id_matpel',
                            name: 'id_matpel'
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return row.jam_mulai + ' - ' + row.jam_selesai;
                            }
                        },
                        {
                            data: 'id_guru',
                            name: 'id_guru',
                            orderable: false,
                        },
                        {
                            data: 'kelas',
                            name: 'kelas'
                        },
                        {
                            data: 'ruangan',
                            name: 'ruangan'
                        },
                        @if (Auth::user()->roles->contains('name', 'admin'))
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        @endif
                    ],

                    dom: "<'row'<'col-lg-3'l> <'col-lg-4 mt-2'B> <'col-lg-5'f>>" +
                        "<'row'<'col-sm-12 py-lg-2'tr>>" +
                        "<'row'<'col-sm-12 col-lg-5'i><'col-sm-12 col-lg-7'p>>",
                    "buttons": [{
                            extend: 'csv',
                            className: 'btn btn-secondary',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-secondary',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-secondary',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        }
                    ]
                });

                $('#filterKelas').on('change', function() {
                    const selectedKelas = $(this).val();
                    myDataTable.ajax.url('{{ route('jadwal_pelajaran.data') }}?kelas=' + selectedKelas)
                        .load();
                });

                // $('#reload').on('click', function() {
                //     myDataTable.ajax.url('{{ route('jadwal_pelajaran.data') }}').load();
                // });

            });

            function edit(id) {
                fetch('/jadwal_pelajaran/getid/' + id, {
                        method: 'GET',
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengambil data siswa');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const form = document.getElementById('form_edit_jadwal');
                        form.elements['edit_id'].value = data.data.id;
                        form.elements['edit_hari'].value = data.data.hari;
                        form.elements['edit_id_matpel'].value = data.data.id_matpel;
                        form.elements['edit_jam_mulai'].value = data.data
                            .jam_mulai;
                        form.elements['edit_jam_selesai'].value = data.data
                            .jam_selesai;
                        form.elements['edit_id_guru'].value = data.data
                            .id_guru;
                        form.elements['edit_kelas'].value = data.data.kelas;
                        form.elements['edit_ruangan'].value = data.data.ruangan;

                        // Setel nilai langsung pada elemen <select>
                        var editIdMatpelSelect = document.getElementById('edit_id_matpel');
                        var editIdPengajarSelect = document.getElementById('edit_id_guru');

                        fetch('/data_matpel/getid/' + data.data.id_matpel, {
                                method: 'GET',
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Gagal mengambil data tambahan');
                                }
                                return response.json();
                            })
                            .then(data => {
                                updateOptionsAndSelect2Matpel(editIdMatpelSelect, data.data.id, data.data.nama_matpel);
                            });

                        fetch('/data_guru/getID/' + data.data.id_guru, {
                                method: 'GET',
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Gagal mengambil data tambahan');
                                }
                                return response.json();
                            })
                            .then(data => {
                                updateOptionsAndSelect2Guru(editIdPengajarSelect, data.data.id, data.data.nama);
                            });


                        $('#modal_edit_data').modal('show');
                    })

                $("#edit_id_matpel").select2({
                    theme: "bootstrap-5",
                    placeholder: "Pilih Matpel",
                    // minimumInputLength: 1,
                    dropdownParent: $("#modal_edit_data"),
                    ajax: {
                        url: '/get_data_matpel',
                        dataType: 'json',
                        processResults: function(data) {
                            if (data && data.length > 0) {
                                var results = $.map(data, function(item) {
                                    return {
                                        id: item.id,
                                        text: item.nama_matpel
                                    };
                                });
                                return {
                                    results: results
                                };
                            }
                        },
                    }
                });

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

            function updateData() {
                const form = document.getElementById('form_edit_jadwal');
                const formData = new FormData(form);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                fetch('/jadwal_pelajaran/update_jadwal_pelajaran', {
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
                                inputField.classList.add('is-invalid');
                                inputField.nextElementSibling.textContent = data.errors[
                                    fieldName][0];
                            });
                            // Hapus kelas 'is-invalid' dari elemen formulir yang telah diperbaiki
                            const validFields = form.querySelectorAll('.is-invalid');
                            validFields.forEach(validField => {
                                const fieldName = validField.id;
                                if (!data.errors[fieldName]) {
                                    validField.classList.remove('is-invalid');
                                    validField.nextElementSibling.textContent = '';
                                }
                            });

                        } else {
                            console.log(data.message);
                            form.reset();
                            $('#modal_edit_data').modal('hide');
                            Swal.fire(
                                'Tersimpan!',
                                'Data siswa berhasil diupdate.',
                                'success'
                            )
                            $('.datatable').DataTable().ajax.reload();

                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat mengupdate data siswa.',
                            'error'
                        );
                    });

            }

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
                const form = document.getElementById('form_edit_jadwal');
                form.reset();
                $('#modal_edit_data').modal('hide');
            }

            // Fungsi untuk memperbarui opsi di elemen <select> dan tampilan Select2
            function updateOptionsAndSelect2Matpel(selectElement, id, namaMatpel) {
                // Hapus semua opsi yang ada di elemen <select>
                $(selectElement).empty();

                // Tambahkan opsi baru ke elemen <select>
                var option = new Option(namaMatpel, id, true, true);
                $(selectElement).append(option);

                // Perbarui tampilan Select2
                $(selectElement).trigger('change');
            }

            function updateOptionsAndSelect2Guru(selectElement, id, namaGuru) {
                // Hapus semua opsi yang ada di elemen <select>
                $(selectElement).empty();

                // Tambahkan opsi baru ke elemen <select>
                var option = new Option(namaGuru, id, true, true);
                $(selectElement).append(option);

                // Perbarui tampilan Select2
                $(selectElement).trigger('change');
            }
        </script>
    @endpush
@endsection
