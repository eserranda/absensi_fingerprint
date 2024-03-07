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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mx-1">Jam Absensi</h3>
                <div class="card-actions">
                    <a class="btn btn-primary" id="add_data">
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body border-bottom py-3 ">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Opsi</th>
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
                    <h5 class="modal-title">Tambah Data Jam Absensi</h5>
                    <button type="button" class="btn-close" onclick="closeModalAdd()"></button>
                </div>
                <form action="" method="POST" id="form_add_jam_absensi">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Hari</label>
                                    <select class="form-select" id="hari" name="hari">
                                        <option value="" selected disabled>Pilih Hari</option>
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

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Masuk</label>
                                    <input type="time" class="form-control" id="jam_masuk" name="jam_masuk">

                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Pulang</label>
                                    <input type="time" class="form-control" id="jam_pulang" name="jam_pulang">

                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button href="" class="btn btn-primary ms-auto" type="submit">
                            Simpan
                        </button>
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
                    <h5 class="modal-title">Edit Data Jam Absensi </h5>
                    <button type="button" class="btn-close" onclick="closeModalEdit()"></button>
                </div>
                <form action="" method="POST" id="form_edit_data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                                    <label class="form-label">Pilih Hari</label>
                                    <select class="form-select" id="edit_hari" name="edit_hari">
                                        <option value="" selected disabled>Pilih Hari</option>
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
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Masuk</label>
                                    <input type="time" class="form-control" id="edit_jam_masuk"
                                        name="edit_jam_masuk">

                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Pulang</label>
                                    <input type="time" class="form-control" id="edit_jam_pulang"
                                        name="edit_jam_pulang">

                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" tabindex="2" class="btn btn-primary"
                            onclick="updateData()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
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

            function edit(id) {
                fetch('/jam_absensi/getid/' + id, {
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
                        form.elements['edit_hari'].value = data.data.hari;
                        form.elements['edit_jam_masuk'].value = data.data.jam_masuk;
                        form.elements['edit_jam_pulang'].value = data.data.jam_pulang;

                        $('#modal_edit_data').modal('show');
                    })
            }

            function updateData() {
                const form = document.getElementById('form_edit_data');
                const formData = new FormData(form);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                fetch('/update_jam_absensi', {
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
                            url: '/jam_absensi/delete/' + id,
                            type: 'DELETE',
                            data: {
                                _token: csrfToken
                            },
                            success: function(response) {
                                console.log('Response:', response);
                                if (response.status) {
                                    Swal.fire(
                                        'Terhapus!',
                                        'Data berhasil dihapus.',
                                        'success'
                                    );
                                    $('.datatable').DataTable().ajax.reload();
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

            $(document).ready(function() {
                $('#modal_add_data').on('shown.bs.modal', function() {
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
                });

                const form = document.getElementById('form_add_jam_absensi');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(form);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    fetch('/simpan_data_jam_absensi', {
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
                                    const inputField = document.getElementById(
                                        fieldName);
                                    inputField.classList.add('is-invalid');
                                    inputField.nextElementSibling.textContent = data
                                        .errors[
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
                            // Swal.fire(
                            //     'Gagal!',
                            //     'Terjadi kesalahan saat menambahkan  data.',
                            //     'error'
                            // );
                        });
                });
            });

            document.getElementById('add_data').addEventListener('click', function() {
                $('#modal_add_data').modal('show');
            });

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
                const form = document.getElementById('form_add_jam_absensi');
                form.reset();
                $('#modal_add_data').modal('hide');
            }

            $(document).ready(function() {
                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: "{{ route('jam_absensi.data') }}",
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
                            data: 'jam_masuk',
                            name: 'jam_masuk',
                            orderable: false,
                        },
                        {
                            data: 'jam_pulang',
                            name: 'jam_pulang'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });

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
