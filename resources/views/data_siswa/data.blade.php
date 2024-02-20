@extends('layouts.master')
@push('headcss')
    <link href="{{ asset('assets') }}/dist/css/dataTables-bootstrap5.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{-- <h3 class="card-title mx-1">Kelas : </h3> --}}
                <div class="btn-actions">
                    <select class="form-select" id="filterKelas">
                        <option value="XI MIPA 1">XI MIPA 1</option>
                        <option value="X IPS 1">X IPS 1</option>
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
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add_data">
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
                                <th>NISN</th>
                                <th>TTL</th>
                                <th>Tanggal Lahir</th>
                                <th>JK</th>
                                <th>Agama</th>
                                <th>Kelas</th>
                                <th>Alamat</th>
                                <th>Keterangan</th>
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

    {{-- Modal edit data  --}}
    <div class="modal modal-blur fade" id="modal_edit_data" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeModalButton"></button>
                </div>
                <form action="/update_data_siswa" method="POST" id="edit_data_siswa">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                                    <input type="text" class="form-control" id="edit_nama" name="edit_nama">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">NISN</label>
                                    <input type="text" class="form-control" id="edit_nisn" name="edit_nisn">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="edit_tempat_lahir"
                                        name="edit_tempat_lahir">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="edit_tanggal_lahir"
                                        name="edit_tanggal_lahir">
                                    <div class="invalid-feedback"></div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="edit_jenis_kelamin" name="edit_jenis_kelamin">
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Agama</label>
                                    <select class="form-select" id="edit_agama" name="edit_agama">
                                        <option value="">Pilih Agama</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Kelas</label>
                                <select class="form-select" id="edit_kelas" name="edit_kelas">
                                    <option value="XI MIPA 1">XI MIPA 1</option>
                                    <option value="X IPS 1">X IPS 1</option>
                                    <option value="XII IPS 1">XII IPS 1</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="edit_alamat" rows="2" id="edit_alamat" placeholder="Masukkan Alamat"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Keterangan</label>
                                <select class="form-select" id="edit_keterangan" name="edit_keterangan">
                                    <option value="Aktif">Aktif</option>
                                    <option value="DO">DO</option>
                                    <option value="Sudah Berhenti">Sudah Berhenti</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <a class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a> --}}
                        <button type="button" tabindex="2" class="btn btn-primary"
                            onclick="updateData()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal add data --}}
    <div class="modal  modal-blur fade" id="modal_add_data" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Siswa</h5>
                    {{-- <button type="button" class="btn-close" onclick="close_add_data()"></button> --}}
                    <button type="button" class="btn-close" onclick="closeModalAdd()"></button>
                </div>
                <form action="/simpan_data_siswa" method="POST" id="form_data_siswa">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">NISN</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Agama</label>
                                    <select class="form-select" id="agama" name="agama">
                                        <option value="">Pilih Agama</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Kelas</label>
                                <select class="form-select" id="kelas" name="kelas">
                                    <option value="">Pilih Kelas</option>
                                    <option value="XI MIPA 1">XI MIPA 1</option>
                                    <option value="X IPS 1">X IPS 1</option>
                                    <option value="XII IPS 1">XII IPS 1</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="2" id="alamat" placeholder="Masukkan Alamat"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Keterangan</label>
                                <select class="form-select" id="keterangan" name="keterangan">
                                    <option value="Aktif">Aktif</option>
                                    <option value="DO">DO</option>
                                    <option value="Sudah Berhenti">Sudah Berhenti</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button href="" class="btn btn-primary " type="submit">
                            Simpan
                        </button>
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

                $('#modal_add_data').modal('hide');
                const form = document.getElementById('form_data_guru');
                form.reset();
                $('#modal_add_data').modal('hide');
            }

            function deleteSiswa(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data siswa akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '/data_siswa/delete/' + id,
                            type: 'DELETE',
                            data: {
                                _token: csrfToken
                            },
                            success: function(response) {
                                console.log('Response:', response);
                                if (response.status) {
                                    Swal.fire(
                                        'Terhapus!',
                                        'Data siswa berhasil dihapus.',
                                        'success'
                                    );
                                    $('.datatable').DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan saat menghapus data siswa.',
                                        'error'
                                    );
                                }
                            },
                            error: function(error) {
                                console.log('Gagal menghapus data siswa: ' + error);
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data siswa.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

            $(document).ready(function() {
                const myDataTable = $('.datatable').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: "{{ route('data_siswa.data') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '#',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nisn',
                            name: 'nisn'
                        },
                        {
                            data: 'tempat_lahir',
                            name: 'tempat_lahir'
                        },
                        {
                            data: 'tanggal_lahir',
                            name: 'tanggal_lahir'
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin'
                        },
                        {
                            data: 'agama',
                            name: 'agama'
                        },
                        {
                            data: 'kelas',
                            name: 'kelas'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
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
                    ]
                });

                $('#filterKelas').on('change', function() {
                    const selectedKelas = $(this).val();
                    myDataTable.ajax.url('{{ route('data_siswa.data') }}?kelas=' + selectedKelas).load();
                });

                // Event click pada tombol reload
                $('#reload').on('click', function() {
                    myDataTable.ajax.url('{{ route('data_siswa.data') }}').load();
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const closeModalButton = document.getElementById('closeModalButton');

                function resetForm() {
                    form.reset();
                    const invalidFields = form.querySelectorAll('.is-invalid');
                    invalidFields.forEach(invalidField => {
                        const fieldName = invalidField.name || invalidField.id;
                        invalidField.classList.remove('is-invalid');
                        invalidField.nextElementSibling.textContent = '';
                    });
                }

                async function close_add_data() {
                    $('#modal_add_data').modal('hide');
                }

                closeModalButton.addEventListener('click', resetForm);

                const form = document.getElementById('form_data_siswa');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(form);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    fetch('/simpan_data_siswa', {
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
                                $('#modal_add_data').modal('hide');
                                Swal.fire(
                                    'Tersimpan!',
                                    'Data siswa berhasil ditambahkan.',
                                    'success'
                                );
                                $('.datatable').DataTable().ajax.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menambahkan data siswa.',
                                'error'
                            );
                        });
                });
            });

            // detail data 
            function detailSiswa(id) {
                fetch('/data_siswa/getid/' + id, {
                        method: 'GET',
                    })

                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengambil data siswa');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // const form = document.getElementById('detail_data_siswa');
                    })
            }
            // Edit data
            function editSiswa(id) {
                fetch('/data_siswa/edit/' + id, {
                        method: 'GET',
                        // mode: 'cors', //   permintaan lintas domain
                    })

                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengambil data siswa');
                        }
                        return response.json();
                    })
                    .then(data => {
                        var tanggalLahirISO = data.data.tanggal_lahir;
                        var tanggalLahirDate = new Date(tanggalLahirISO);
                        var tanggalLahirFormatted = tanggalLahirDate.toISOString().split('T')[0];

                        const form = document.getElementById('edit_data_siswa');
                        form.elements['edit_id'].value = data.data.id;
                        form.elements['edit_nama'].value = data.data.nama;
                        form.elements['edit_nisn'].value = data.data.nisn;
                        form.elements['edit_tempat_lahir'].value = data.data
                            .tempat_lahir;
                        form.elements['edit_tanggal_lahir'].value = tanggalLahirFormatted;
                        form.elements['edit_jenis_kelamin'].value = data.data
                            .jenis_kelamin;
                        form.elements['edit_agama'].value = data.data.agama;
                        form.elements['edit_kelas'].value = data.data.kelas;
                        form.elements['edit_alamat'].value = data.data.alamat;
                        $('#modal_edit_data').modal('show');
                    })
            }

            function updateData() {
                const form = document.getElementById('edit_data_siswa');
                const formData = new FormData(form);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                fetch('/update_data_siswa', {
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

            // async function getData() {
            //     try {
            //         const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            //         const response = await fetch('/data_siswa_tes', {
            //             method: 'GET',
            //             headers: {
            //                 'X-CSRF-TOKEN': csrfToken,
            //                 'Content-Type': 'application/json',
            //             },
            //         }).then(response => response.json());

            //         if (!response.status) {
            //             throw new Error('Gagal mengambil data siswa');
            //         } else {
            //             console.log(response);
            //         }
            //     } catch (error) {
            //         console.error('Terjadi kesalahan:', error);
            //         throw error;
            //     }
            // }

            // getData()
        </script>
    @endpush
@endsection
