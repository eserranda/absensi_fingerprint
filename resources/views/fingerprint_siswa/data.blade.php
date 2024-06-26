@extends('layouts.master')
@push('headcss')
    <link href="{{ asset('assets') }}/dist/css/dataTables-bootstrap5.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Fingerprint Siswa</h5>
                <div class="card-actions">
                    <a href="/fingerprint_siswa/add" class="btn btn-primary" id="add_data">
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
                                <th>ID Fingerprint</th>
                                <th>Nama Siswa</th>
                                <th>Modul Fingerprint</th>
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

    @push('script')
        <script type="text/javascript">
            function detail(id) {
                alert(id);
            }

            function hapus(id, modul, id_finger) {
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
                        var data = {
                            id_finger: id,
                            modul_fingerprint: modul,
                            id_finger: id_finger
                        };

                        fetch('/fingerprint_moduls/deleted_id', {
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
                                // Lanjutkan dengan menghapus data
                                $.ajax({
                                    url: '/fingerprint_siswa/delete/' + id,
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
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.error('Error:', errorThrown);
                                        Swal.fire(
                                            'Gagal!',
                                            'Terjadi kesalahan saat menghapus data.',
                                            'error'
                                        );
                                    }
                                });
                            })
                            .catch(error => {
                                // Tangani kesalahan jika ada
                                console.error('Error:', error);
                            });
                    }
                });
            }

            $(document).ready(function() {
                const myDataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: "{{ route('fingerprint_siswa.data') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: '#',
                            searchable: false
                        },
                        {
                            data: 'id_fingerprint',
                            name: 'id_fingerprint'
                        },
                        {
                            data: 'id_siswa',
                            name: 'id_siswa',
                            orderable: false,
                        },
                        {
                            data: 'id_modul_fingerprint',
                            name: 'id_modul_fingerprint',
                            orderable: false,
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
        </script>
    @endpush
@endsection
