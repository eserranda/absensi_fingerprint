@extends('layouts.master')
@push('headcss')
    <link href="{{ asset('assets') }}/dist/css/dataTables-bootstrap5.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
@endpush
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-actions ">
                    <div class="input-icon">
                        <input class="form-control " placeholder="Select a date" id="datepicker-icon" value="2020-06-20" />
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                                <path d="M11 15h1" />
                                <path d="M12 15v3" />
                            </svg>
                        </span>
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

                {{-- <div class="card-actions">
                    <a href="#" class="btn btn-success">
                        Exel
                    </a>
                    <a href="#" class="btn btn-primary" id="add_data">
                        Tambah Data
                    </a>
                </div> --}}
            </div>

            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>ID Finger</th>
                                <th>Status Pegawai</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
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


    {{-- Tambah data  --}}
    <div class="modal modal-blur fade" id="modal_add_data" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data </h5>
                    <button type="button" class="btn-close" onclick="closeModalAdd()"></button>
                </div>
                <form action="" method="POST" id="form_data_guru">
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
                                    <label class="form-label">NUPTK</label>
                                    <input type="number" class="form-control" id="nuptk" name="nuptk">
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
                                    <label class="form-label">Status Kepegawaian</label>
                                    <select class="form-select" id="status_pegawai" name="status_pegawai">
                                        <option value=" ">Pilih Status Pegawai</option>
                                        <option value="PNS">PNS</option>
                                        <option value="PNS">PPPK</option>
                                        <option value="Honor Sekolah">Honor Sekolah</option>
                                        <option value="Honor Daerah">Honor Daerah</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">NIP</label>
                                    <input type="number" class="form-control" id="nip" name="nip">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jenis PTK</label>
                                    <select class="form-select" id="jenis_ptk" name="jenis_ptk">
                                        <option value="">- Pilih Jenis PTK -</option>
                                        <option value="Guru Mapel">Guru Mapel</option>
                                        <option value="Guru Kelas">Guru Kelas</option>
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
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="">Pilih Gender</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukkan Alamat"></textarea>
                                    <div class="invalid-feedback"> </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button href="#" class="btn btn-primary ms-auto" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.Litepicker && (new Litepicker({
                element: document.getElementById('datepicker-icon'),
                buttonText: {
                    previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                },
            }));
        });
        // @formatter:on
    </script>
    {{-- @push('script')
        <script type="text/javascript">
            function hapus(id) {
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
                            url: '/data_guru/delete/' + id,
                            type: 'DELETE',
                            data: {
                                _token: csrfToken
                            },
                            success: function(response) {
                                console.log('Response:', response);
                                if (response.status) {
                                    Swal.fire(
                                        'Terhapus!',
                                        'Data guru berhasil dihapus.',
                                        'success'
                                    );
                                    $('.datatable').DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan saat menghapus data guru.',
                                        'error'
                                    );
                                }
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data guru.',
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

                    const response = await fetch('/data_guru/getID/' + id, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                        },
                    })
                    const responseData = await response.json();

                    if (!response.status) {
                        throw new Error('Gagal mengambil data siswa');
                    }
                    console.log(response);
                    const form = document.getElementById('form_edit_data_guru');
                    form.elements['id'].value = responseData.data.id;
                    form.elements['edit_nama'].value = responseData.data.nama;
                    form.elements['edit_nuptk'].value = responseData.data.nuptk;
                    form.elements['edit_jenis_kelamin'].value = responseData.data.jenis_kelamin;
                    form.elements['edit_tempat_lahir'].value = responseData.data.tempat_lahir;
                    form.elements['edit_tanggal_lahir'].value = responseData.data.tanggal_lahir;
                    form.elements['edit_nip'].value = responseData.data.nip;
                    form.elements['edit_status_pegawai'].value = responseData.data.status_pegawai;
                    form.elements['edit_jenis_ptk'].value = responseData.data.jenis_ptk;
                    form.elements['edit_agama'].value = responseData.data.agama;
                    form.elements['edit_alamat'].value = responseData.data.alamat;
                    $('#modal_edit_data').modal('show');

                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                    throw error;
                }
            }

            document.getElementById('form_edit_data_guru').addEventListener('submit', async function(event) {
                event.preventDefault();

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    const response = await fetch('/update_data_guru', {
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
                        const form = document.getElementById('form_edit_data_guru');
                        form.reset();
                        $('#modal_edit_data').modal('hide');
                        Swal.fire(
                            'Tersimpan!',
                            'Data guru berhasil diupdate.',
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
                const form = document.getElementById('form_edit_data_guru');
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
                const form = document.getElementById('form_data_guru');
                form.reset();
                $('#modal_add_data').modal('hide');
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('add_data').addEventListener('click', function() {
                    $('#modal_add_data').modal('show');
                });

                document.getElementById('form_data_guru').addEventListener('submit', async function(event) {
                    event.preventDefault();
                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        const response = await fetch('/simpan_data_guru', {
                            method: 'POST',
                            body: new FormData(this),
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        }).then(response => response.json());

                        if (!response.status) {
                            handleValidationErrors(response.errors);
                        } else {
                            console.log(response);
                            // Cari semua elemen input dengan kelas "is-invalid"
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
                            const form = document.getElementById('form_data_guru');
                            form.reset();
                            $('#modal_add_data').modal('hide');
                            Swal.fire(
                                'Tersimpan!',
                                'Data siswa berhasil diupdate.',
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
            });

            $(document).ready(function() {
                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: "{{ route('data_guru.data') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '#',
                            searchable: false
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nuptk',
                            name: 'nuptk'
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin'
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
                            data: 'nip',
                            name: 'nip'
                        },
                        {
                            data: 'status_pegawai',
                            name: 'status_pegawai'
                        },
                        {
                            data: 'jenis_ptk',
                            name: 'jenis_ptk'
                        },
                        {
                            data: 'agama',
                            name: 'agama'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                $('#filterPegawai').on('change', function() {
                    const selectedPegawai = $(this).val();
                    myDataTable.ajax.url('{{ route('data_guru.data') }}?status_pegawai=' + selectedPegawai)
                        .load();
                });

                $('#reload').on('click', function() {
                    myDataTable.ajax.url('{{ route('data_guru.data') }}').load();
                });

            });
        </script>
    @endpush --}}
@endsection
