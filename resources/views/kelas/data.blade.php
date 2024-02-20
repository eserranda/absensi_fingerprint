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
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Jumlah Siswa</th>
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
                    <h5 class="modal-title">Tambah Data </h5>
                    <button type="button" class="btn-close" onclick="closeModalAdd()"></button>
                </div>
                <form action="" method="POST" id="form_data_kelas">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Kelas</label>
                                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Wali</label>
                                    <select class="form-select" id="id_guru" name="id_guru">

                                    </select>
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
                    <h5 class="modal-title">Tambah Data </h5>
                    <button type="button" class="btn-close" onclick="closeModalEdit()"></button>
                </div>
                <form action="" method="POST" id="form_edit_data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Kelas</label>
                                    <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                                    <input type="text" class="form-control" id="edit_nama_kelas" name="edit_nama_kelas">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Wali</label>
                                    <select class="form-select" id="edit_id_guru" name="edit_id_guru">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" tabindex="2" class="btn btn-primary" onclick="updateData()">Update</button>
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
                fetch('/data_kelas/getid/' + id, {
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
                        form.elements['edit_nama_kelas'].value = data.data.nama_kelas;
                        form.elements['edit_id_guru'].value = data.data.id_guru;

                        // Setel nilai langsung pada elemen <select>
                        var editIdPengajarSelect = document.getElementById('edit_id_guru');
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
                const form = document.getElementById('form_edit_data');
                const formData = new FormData(form);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                fetch('/update_data_kelas', {
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
                            url: '/data_kelas/delete/' + id,
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

                const form = document.getElementById('form_data_kelas');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(form);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    fetch('/simpan_data_kelas', {
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
                const form = document.getElementById('form_data_kelas');
                form.reset();
                $('#modal_add_data').modal('hide');
            }

            $(document).ready(function() {
                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: "{{ route('kelas.data') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '#',
                            searchable: false
                        },
                        {
                            data: 'nama_kelas',
                            name: 'nama_kelas'
                        },
                        {
                            data: 'id_guru',
                            name: 'id_guru',
                            orderable: false,
                        },
                        {
                            data: 'jumlah_siswa',
                            name: 'jumlah_siswa'
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
