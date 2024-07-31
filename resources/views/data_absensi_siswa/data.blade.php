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
                <div class="btn-actions ">
                    <div class="input-icon">
                        <input class="form-control" type="date" id="tanggal" />

                    </div>
                </div>

                <button class="btn   btn-icon mx-2" id="reload">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                    </svg>

                </button>

                <div class="card-actions">
                    {{-- <a href="#" class="btn btn-success">
                        Exel
                    </a> --}}
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
                                <th>ID Finger</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Ket</th>
                                <th class="w-1">Lihat Absensi</th>
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
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" onclick="closeModalAdd()"></button>
                </div>
                <form action="" method="POST" id="form_add_data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Siswa</label>
                                    <select class="form-select" id="id_siswa" name="id_siswa">

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas">
                                    <div class="invalid-feedback"></div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">ID Finger</label>
                                    <input type="number" class="form-control" id="id_finger" name="id_finger">
                                    <div class="invalid-feedback"></div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Absen</label>
                                    <input type="date" class="form-control" id="tanggal_absen" name="tanggal_absen">
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
                                    <label class="form-label">Jam Keluar</label>
                                    <input type="time" class="form-control" id="jam_keluar" name="jam_keluar">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <select class="form-select" id="keterangan" name="keterangan">
                                        <option value="" selected disabled>- Pilih Keterangan -</option>
                                        <option value="Hadir">Hadir</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Terlambat">Terlambat</option>
                                        <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary ms-auto" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit data  --}}
    <div class="modal modal-blur fade" id="modal_edit_data" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" onclick="closeModalEdit()"></button>
                </div>
                <form action="" method="POST" id="form_edit_data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                                    <select class="form-select" id="edit_id_siswa" name="edit_id_siswa">

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="edit_kelas" name="edit_kelas">
                                    <div class="invalid-feedback"></div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">ID Finger</label>
                                    <input type="number" class="form-control" id="edit_id_finger"
                                        name="edit_id_finger">
                                    <div class="invalid-feedback"></div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Absen</label>
                                    <input type="date" class="form-control" id="edit_tanggal_absen"
                                        name="edit_tanggal_absen">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Masuk</label>
                                    <input type="time-local" class="form-control" id="edit_jam_masuk"
                                        name="edit_jam_masuk">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Keluar</label>
                                    <input type="time-local" class="form-control" id="edit_jam_keluar"
                                        name="edit_jam_keluar">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <select class="form-select" id="edit_keterangan" name="edit_keterangan">
                                        <option value="" selected disabled>- Pilih Keterangan -</option>
                                        <option value="Hadir">Hadir</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Terlambat">Terlambat</option>
                                        <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary ms-auto" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            async function edit(id) {
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                    const response = await fetch('/rekap-absensi-siswa/edit/' + id);
                    const responseData = await response.json();

                    if (!response.status) {
                        throw new Error('Gagal mengambil data');
                    }
                    console.log(response);
                    const form = document.getElementById('form_edit_data');
                    form.elements['edit_id'].value = responseData.data.id;
                    form.elements['edit_kelas'].value = responseData.data.kelas;
                    form.elements['edit_id_finger'].value = responseData.data.id_finger;
                    form.elements['edit_tanggal_absen'].value = responseData.data.tanggal_absen;
                    form.elements['edit_jam_masuk'].value = responseData.data.jam_masuk;
                    form.elements['edit_jam_keluar'].value = responseData.data.jam_keluar;
                    form.elements['edit_keterangan'].value = responseData.data.keterangan;


                    var editIdPengajarSelect = document.getElementById('edit_id_siswa');
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
                            updateOptionsAndSelect2Guru(editIdPengajarSelect, data.data.id, data.data.nama);
                        });

                    $('#modal_edit_data').modal('show');

                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                    throw error;
                }

                $("#edit_id_siswa").select2({
                    theme: "bootstrap-5",
                    placeholder: "Pilih siswa",
                    minimumInputLength: 1,
                    dropdownParent: $("#modal_edit_data"),
                    ajax: {
                        url: '/get_data_siswa',
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


            function updateOptionsAndSelect2Guru(selectElement, id, namaSiswa) {
                $(selectElement).empty();

                var option = new Option(namaSiswa, id, true, true);
                $(selectElement).append(option);

                $(selectElement).trigger('change');
            }

            document.getElementById('form_edit_data').addEventListener('submit', async function(event) {
                event.preventDefault();

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    const response = await fetch('/rekap-absensi-siswa/update', {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    }).then(response => response.json());
                    if (response.errors) {
                        Object.keys(response.errors).forEach(fieldName => {
                            const inputField = document.getElementById(fieldName);
                            if (fieldName === 'id_siswa') {
                                inputField.classList.add('is-invalid');
                            } else {
                                inputField.classList.add('is-invalid');
                                inputField.nextElementSibling.textContent = data.errors[fieldName][0];
                            }
                        });

                        const validFields = document.querySelectorAll('.is-invalid');
                        validFields.forEach(validField => {
                            const fieldName = validField.id;
                            if (!response.errors[fieldName]) {
                                if (fieldName === 'id_siswa') {
                                    validField.classList.remove('is-invalid');
                                } else {
                                    validField.classList.remove('is-invalid');
                                    validField.nextElementSibling.textContent = '';
                                }
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
                            'Data  berhasil diupdate.',
                            'success'
                        )
                        $('.datatable').DataTable().ajax.reload();
                    }
                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                    throw error;
                }
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
                const form = document.getElementById('form_data_matpel');
                form.reset();
                $('#modal_add_data').modal('hide');
            }

            $(document).ready(function() {
                $("#id_siswa").select2({
                    theme: "bootstrap-5",
                    placeholder: "Pilih nama siswa",
                    minimumInputLength: 1,
                    dropdownParent: $("#modal_add_data"),
                    ajax: {
                        url: '/get_data_siswa',
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


                $("#id_siswa").on("change", async function() {
                    var id = $(this).val();
                    try {
                        const response = await fetch('/siswa/get_kelas_siswa/' + id, {
                            method: 'GET',
                        });
                        const responseData = await response.json();
                        if (responseData) {
                            var kelas = responseData;
                            $('#kelas').val(kelas);
                        } else {
                            throw new Error('Gagal mendapatkan data Kelas');
                        }
                    } catch (error) {
                        console.error('Terjadi kesalahan:', error);
                    }
                });


                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: "{{ route('data_absensi_siswa.data') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '#',
                            searchable: false
                        },
                        {
                            data: 'id_siswa',
                            name: 'id_siswa'
                        },
                        {
                            data: 'id_fingerprint',
                            name: 'id_fingerprint'
                        },
                        {
                            data: 'kelas',
                            name: 'kelas'
                        },
                        {
                            data: 'tanggal_absen',
                            name: 'tanggal_absen'
                        },
                        {
                            data: 'jam_masuk',
                            name: 'jam_masuk'
                        },
                        {
                            data: 'jam_keluar',
                            name: 'jam_keluar'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    dom: "<'row'<'col-lg-3'l> <'col-lg-4 mt-2'B> <'col-lg-5'f>>" +
                        "<'row'<'col-sm-12 py-lg-2'tr>>" +
                        "<'row'<'col-sm-12 col-lg-5'i><'col-sm-12 col-lg-7'p>>",
                    "buttons": [{
                            extend: 'csv',
                            className: 'btn btn-secondary',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-secondary',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-secondary',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        }
                    ]
                });
                $('#tanggal').on('change', function() {
                    const selectedKelas = $(this).val();
                    myDataTable.ajax.url('{{ route('data_absensi_siswa.data') }}?tanggal=' +
                        selectedKelas).load();
                });


                $('#reload').on('click', function() {
                    myDataTable.ajax.url('{{ route('data_absensi_siswa.data') }}').load();
                });
            });

            // Add Data 
            const form = document.getElementById('form_add_data');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(form);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                fetch('/rekap-absensi-siswa/store', {
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
                                if (fieldName === 'id_siswa') {
                                    inputField.classList.add('is-invalid');
                                } else {
                                    inputField.classList.add('is-invalid');
                                    inputField.nextElementSibling.textContent = data.errors[fieldName][0];
                                }

                            });

                            // Hapus kelas 'is-invalid' dari elemen formulir yang telah diperbaiki
                            const validFields = form.querySelectorAll('.is-invalid');
                            validFields.forEach(validField => {
                                const fieldName = validField.id;
                                if (!data.errors[fieldName]) {
                                    if (fieldName === 'id_siswa') {
                                        validField.classList.remove('is-invalid');
                                    } else {
                                        validField.classList.remove('is-invalid');
                                        validField.nextElementSibling.textContent = '';
                                    }
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
                            url: '/rekap-absensi-siswa/delete/' + id,
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
        </script>
    @endpush
@endsection
