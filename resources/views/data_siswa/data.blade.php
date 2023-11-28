@extends('layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{-- <h3 class="card-title mr-5">Data Guru</h3> --}}

                <h3 class="card-title mx-1">Kelas : </h3>
                <div class="mx-2 btn-actions">
                    <select class="form-select">
                        <option>XI MIPA 1</option>
                        <option>X IPS 1 </option>
                        <option>X IPS 2 </option>
                    </select>
                </div>

                <div class="card-actions">
                    <a href="#" class="btn btn-success">
                        Exel
                    </a>

                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-report">
                        Tambah Data
                    </a>


                </div>
            </div>
            <div class="card-body p-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>JK</th>
                                    <th>NISN</th>
                                    <th>TTL</th>
                                    <th>Agama</th>
                                    <th>Alamat</th>
                                    <th>Kelas</th>
                                    <th class="w-1">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_siswa as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->jenis_kelamin }}</td>
                                        <td>{{ $row->nisn }}</td>
                                        <td>{{ $row->tempat_lahir }} / {{ date('d-m-Y', strtotime($row->tanggal_lahir)) }}
                                        </td>
                                        <td>{{ $row->agama }}</td>
                                        <td>{{ $row->alamat }}</td>
                                        <td>{{ $row->kelas }}</td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                        data-bs-toggle="dropdown">
                                                        Opsi
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                            href="/data_siswa/detail/{{ $row->id }}">
                                                            Detail
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="/data_siswa/edit/{{ $row->id }}">
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="/data_siswa/hapus/{{ $row->id }}">
                                                            Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- Modal  --}}

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Kelas</label>
                                <select class="form-select" id="kelas" name="kelas">
                                    <option value="X IPA 1">X IPA 1</option>
                                    <option value="X IPS 2">X IPS 2 </option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="2" id="alamat" placeholder="Masukkan Alamat"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button href="#" class="btn btn-primary ms-auto" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d=" M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        </script>
    @endpush
@endsection
