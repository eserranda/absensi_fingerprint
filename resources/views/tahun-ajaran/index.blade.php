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

                <h5 class="card-title">Tahun Ajaran</h5>
                <div class="card-actions">
                    {{-- <a class="btn btn-primary" id="add_data">
                        Tambah Data
                    </a> --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah
                        Data</button>
                </div>
            </div>

            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <td>Status</td>
                                <th>Pilih</th>
                                <th class="w-1">Opsi</th>
                            </tr>
                        </thead>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->semester }}</td>
                                <td>{{ $d->tahun_ajaran }}</td>
                                <td>
                                    @if ($d->is_active == 1)
                                        <span class="badge badge-outline text-green">Aktif</span>
                                    @else
                                        <span class="badge badge-outline text-red">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($d->is_active != 1)
                                        <button type="button" class="btn w-50 btn-primary btn-icon"
                                            onclick="active({{ $d->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-checkbox">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M9 11l3 3l8 -8" />
                                                <path
                                                    d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                            </svg>
                                        </button>
                                    @else
                                        <span class="badge badge-outline text-green">Sedang berjalan</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger btn-icon" aria-label="Button"
                                        onclick="hapus({{ $d->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('tahun-ajaran.add')
    @include('tahun-ajaran.edit')
@endsection

<script>
    function active(id) {
        fetch(`/tahun-ajaran/active/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // alert(data.message);
                    location.reload(); // Reload the page to reflect the changes
                } else {
                    alert('Failed to update status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
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
                    url: '/tahun-ajaran/delete/' + id,
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
                            location.reload();
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
</script>
