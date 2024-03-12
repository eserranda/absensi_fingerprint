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
                <div class="btn-list">
                    <div class="btn-actions col-12">
                        <div class="col-6">
                            <select class="form-select" id="filterKelas">
                                <option value="" selected disabled>Pilih Kelas</option>
                                <option value="X IPS 1">X IPS 1</option>
                                <option value="XI MIPA 1">XI MIPA 1</option>
                                <option value="XII IPS 1">XII IPS 1</option>
                            </select>
                        </div>

                        <div class="col-7 mx-2">
                            <input type="date" class="form-control  " id="filterTanggal">
                        </div>

                        <a href="#" class="btn btn-icon" aria-label="Button" id="search">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </a>
                    </div>
                </div>


                <div class="card-actions">
                    <button class="btn   btn-icon mx-2" id="reload">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="card-body border-bottom py-3 ">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Hari</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Guru</th>
                                <th>MatPel</th>
                                <th>Keterangan</th>
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
                                    <input type="text" class="form-control" id="edit_nama_kelas"
                                        name="edit_nama_kelas">
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
                        <button type="button" tabindex="2" class="btn btn-primary"
                            onclick="updateData()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            // function closeModalEdit() {
            //     const invalidInputs = document.querySelectorAll('.is-invalid');
            //     invalidInputs.forEach(invalidInput => {
            //         invalidInput.value = '';
            //         invalidInput.classList.remove('is-invalid');
            //         const errorNextSibling = invalidInput.nextElementSibling;
            //         if (errorNextSibling && errorNextSibling.classList.contains(
            //                 'invalid-feedback')) {
            //             errorNextSibling.textContent = '';
            //         }
            //     });
            //     const form = document.getElementById('form_edit_data');
            //     form.reset();
            //     $('#modal_edit_data').modal('hide');
            // }

            // function edit(id) {
            //     fetch('/data_kelas/getid/' + id, {
            //             method: 'GET',
            //         })
            //         .then(response => {
            //             if (!response.ok) {
            //                 throw new Error('Gagal mengambil data siswa');
            //             }
            //             return response.json();
            //         })
            //         .then(data => {
            //             const form = document.getElementById('form_edit_data');
            //             form.elements['edit_id'].value = data.data.id;
            //             form.elements['edit_nama_kelas'].value = data.data.nama_kelas;
            //             form.elements['edit_id_guru'].value = data.data.id_guru;

            //             // Setel nilai langsung pada elemen <select>
            //             var editIdPengajarSelect = document.getElementById('edit_id_guru');
            //             fetch('/data_guru/getID/' + data.data.id_guru, {
            //                     method: 'GET',
            //                 })
            //                 .then(response => {
            //                     if (!response.ok) {
            //                         throw new Error('Gagal mengambil data tambahan');
            //                     }
            //                     return response.json();
            //                 })
            //                 .then(data => {
            //                     updateOptionsAndSelect2Guru(editIdPengajarSelect, data.data.id, data.data.nama);
            //                 });


            //             $('#modal_edit_data').modal('show');
            //         })

            //     $("#edit_id_guru").select2({
            //         theme: "bootstrap-5",
            //         placeholder: "Pilih guru",
            //         minimumInputLength: 1,
            //         dropdownParent: $("#modal_edit_data"),
            //         ajax: {
            //             url: '/get_data_guru',
            //             dataType: 'json',
            //             processResults: function(data) {
            //                 if (data && data.length > 0) {
            //                     var results = $.map(data, function(item) {
            //                         return {
            //                             id: item.id,
            //                             text: item.nama
            //                         };
            //                     });
            //                     return {
            //                         results: results
            //                     };
            //                 }
            //             },
            //         }
            //     });
            // }

            // function updateData() {
            //     const form = document.getElementById('form_edit_data');
            //     const formData = new FormData(form);
            //     const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            //     fetch('/update_data_kelas', {
            //             method: 'POST',
            //             body: formData,
            //             headers: {
            //                 'X-CSRF-TOKEN': csrfToken,
            //             },
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             console.log(data.message);
            //             if (data.errors) {
            //                 Object.keys(data.errors).forEach(fieldName => {
            //                     const inputField = document.getElementById(fieldName);
            //                     inputField.classList.add('is-invalid');
            //                     inputField.nextElementSibling.textContent = data.errors[
            //                         fieldName][0];
            //                 });
            //                 // Hapus kelas 'is-invalid' dari elemen formulir yang telah diperbaiki
            //                 const validFields = form.querySelectorAll('.is-invalid');
            //                 validFields.forEach(validField => {
            //                     const fieldName = validField.id;
            //                     if (!data.errors[fieldName]) {
            //                         validField.classList.remove('is-invalid');
            //                         validField.nextElementSibling.textContent = '';
            //                     }
            //                 });

            //             } else {
            //                 console.log(data.message);
            //                 form.reset();
            //                 $('#modal_edit_data').modal('hide');
            //                 Swal.fire(
            //                     'Tersimpan!',
            //                     'Data siswa berhasil diupdate.',
            //                     'success'
            //                 )
            //                 $('.datatable').DataTable().ajax.reload();

            //             }
            //         })
            //         .catch(error => {
            //             console.error('Error:', error);
            //             Swal.fire(
            //                 'Gagal!',
            //                 'Terjadi kesalahan saat mengupdate data siswa.',
            //                 'error'
            //             );
            //         });

            // }

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
                            url: '/absensi-matpel/delete/' + id,
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

            // $(document).ready(function() {
            //     $('#modal_add_data').on('shown.bs.modal', function() {
            //         $("#id_guru").select2({
            //             theme: "bootstrap-5",
            //             placeholder: "Pilih guru",
            //             minimumInputLength: 1,
            //             dropdownParent: $("#modal_add_data"),
            //             ajax: {
            //                 url: '/get_data_guru',
            //                 dataType: 'json',
            //                 processResults: function(data) {
            //                     if (data && data.length > 0) {
            //                         var results = $.map(data, function(item) {
            //                             return {
            //                                 id: item.id,
            //                                 text: item.nama
            //                             };
            //                         });
            //                         return {
            //                             results: results
            //                         };
            //                     }
            //                 },
            //             }
            //         });
            //     });

            //     const form = document.getElementById('form_data_kelas');
            //     form.addEventListener('submit', function(event) {
            //         event.preventDefault();
            //         const formData = new FormData(form);

            //         const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            //         fetch('/simpan_data_kelas', {
            //                 method: 'POST',
            //                 body: formData,
            //                 headers: {
            //                     'X-CSRF-TOKEN': csrfToken,
            //                 },
            //             })
            //             .then(response => response.json())
            //             .then(data => {
            //                 console.log(data.message);
            //                 if (data.errors) {
            //                     Object.keys(data.errors).forEach(fieldName => {
            //                         const inputField = document.getElementById(fieldName);
            //                         if (fieldName === 'id_guru') {
            //                             inputField.classList.add('is-invalid');
            //                         } else {
            //                             inputField.classList.add('is-invalid');
            //                             inputField.nextElementSibling.textContent = data.errors[
            //                                 fieldName][0];
            //                         }

            //                     });

            //                     // Hapus kelas 'is-invalid' dari elemen formulir yang telah diperbaiki
            //                     const validFields = form.querySelectorAll('.is-invalid');
            //                     validFields.forEach(validField => {
            //                         const fieldName = validField.id;
            //                         if (!data.errors[fieldName]) {
            //                             if (fieldName === 'id_guru') {
            //                                 validField.classList.remove('is-invalid');
            //                             } else {
            //                                 validField.classList.remove('is-invalid');
            //                                 validField.nextElementSibling.textContent = '';
            //                             }
            //                         }
            //                     });
            //                 } else {
            //                     console.log(data.message);
            //                     form.reset();
            //                     $('#modal_add_data').modal('hide');
            //                     Swal.fire(
            //                         'Tersimpan!',
            //                         'Data berhasil ditambahkan.',
            //                         'success'
            //                     );
            //                     $('.datatable').DataTable().ajax.reload();
            //                 }
            //             })
            //             .catch(error => {
            //                 console.error('Error:', error);
            //                 Swal.fire(
            //                     'Gagal!',
            //                     'Terjadi kesalahan saat menambahkan  data.',
            //                     'error'
            //                 );
            //             });
            //     });
            // });

            // document.getElementById('add_data').addEventListener('click', function() {
            //     $('#modal_add_data').modal('show');
            // });

            // function closeModalAdd() {
            //     const invalidInputs = document.querySelectorAll('.is-invalid');
            //     invalidInputs.forEach(invalidInput => {
            //         invalidInput.value = '';
            //         invalidInput.classList.remove('is-invalid');
            //         const errorNextSibling = invalidInput.nextElementSibling;
            //         if (errorNextSibling && errorNextSibling.classList.contains(
            //                 'invalid-feedback')) {
            //             errorNextSibling.textContent = '';
            //         }
            //     });

            //     $('#modal_add_data').modal('hide');
            //     const form = document.getElementById('form_data_kelas');
            //     form.reset();
            //     $('#modal_add_data').modal('hide');
            // }

            $(document).ready(function() {
                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('absensi-matpel.data') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '#',
                            searchable: false
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal',
                            render: function(data, type, full, meta) {
                                if (type === 'display') {
                                    return formatDate(
                                        data);
                                }
                                return data;
                            }
                        },
                        {
                            data: 'hari',
                            name: 'hari',
                            orderable: false,
                        },
                        {
                            data: 'id_siswa',
                            name: 'id_siswa'
                        },
                        {
                            data: 'kelas',
                            name: 'kelas'
                        },
                        {
                            data: 'id_guru',
                            name: 'id_guru'
                        },
                        {
                            data: 'id_matpel',
                            name: 'id_matpel'
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

                $('#search').on('click', function() {
                    const selectedKelas = $('#filterKelas').val();
                    const selectedTanggal = $('#filterTanggal').val();
                    const url = '{{ route('absensi-matpel.data') }}?kelas=' + selectedKelas + '&tanggal=' +
                        selectedTanggal;
                    myDataTable.ajax.url(url).load();
                });

                $('#reload').on('click', function() {
                    $('#filterTanggal').val('');
                    $('#filterKelas').val('');
                    myDataTable.ajax.url('{{ route('absensi-matpel.data') }}').load();
                });

            });

            function formatDate(dateString) {
                const parts = dateString.split('-');
                const dateObject = new Date(parts[0], parts[1] - 1, parts[2]);
                return `${dateObject.toLocaleDateString('en-GB')}`;
            }

            // function updateOptionsAndSelect2Guru(selectElement, id, namaGuru) {
            //     // Hapus semua opsi yang ada di elemen <select>
            //     $(selectElement).empty();

            //     // Tambahkan opsi baru ke elemen <select>
            //     var option = new Option(namaGuru, id, true, true);
            //     $(selectElement).append(option);

            //     // Perbarui tampilan Select2
            //     $(selectElement).trigger('change');
            // }
        </script>
    @endpush
@endsection
