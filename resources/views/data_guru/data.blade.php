@extends('layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{-- <h3 class="card-title mr-5">Data Guru</h3> --}}

                <h3 class="card-title mx-1">Filter : </h3>
                <div class="mx-2 btn-actions">
                    <select class="form-select">
                        <option>PNS</option>
                        <option>PPK</option>
                        <option>Honor Sekolah</option>
                        <option>Honor Daerah</option>
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
                                    <th>NUPTK</th>
                                    <th>JK</th>
                                    <th>NIP</th>
                                    <th>Status Kepegawaian</th>
                                    <th>Jenis PTK</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Jhon Doe</td>
                                    <td>123456789</td>
                                    <td>L</td>
                                    <td>00001234</td>
                                    <td>PNS</td>
                                    <td>Guru Kelas</td>
                                    <td>
                                        <a href="#">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Hannah Igrone</td>
                                    <td>987654321</td>
                                    <td>P</td>
                                    <td>-</td>
                                    <td>Honor Sekolah</td>
                                    <td>Guru Mapel Matematika</td>
                                    <td>
                                        <a href="#">Edit</a>
                                    </td>
                                </tr>

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
                    <h5 class="modal-title">Tambah Data </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">NUPTK</label>
                                <input type="number" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Status Kepegawaian</label>
                                <select class="form-select">
                                    <option value="1">PNS</option>
                                    <option value="3">PPPK</option>
                                    <option value="2">Honor Sekolah</option>
                                    <option value="3">Honor Daerah</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">NIP</label>
                                <input type="number" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis PTK</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="example-textarea-input" rows="2" placeholder="Masukkan Alamat"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Simpan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
