@extends('layouts.master')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h3 class="card-title mx-1">Kelas : </h3>
                <div class="mx-2 btn-actions">
                    <select class="form-select">
                        <option>XI MIPA 1</option>
                        <option>X IPS 1 </option>
                        <option>X IPS 2 </option>
                    </select>
                </div>
                <div class="card-actions">
                    {{-- <a href="#" class="btn btn-success">
                        Exel
                    </a> --}}
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add_data">
                        Tambah Jadwal
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
                                <th>Matpel</th>
                                <th>Jam</th>
                                <th>Pengajar</th>
                                <th>Kelas</th>
                                <th>Ruangan</th>
                                <th class="w-1">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Senin</td>
                                <td>Matematika</td>
                                <td>08.00 - 10.00</td>
                                <td>Yunita.Spd</td>
                                <td>II MIPA 1</td>
                                <td>II MIPA 2</td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Senin</td>
                                <td>Bhs Inggris</td>
                                <td>08.00 - 10.00</td>
                                <td>Babo.Spd</td>
                                <td>II MIPA 1</td>
                                <td>II MIPA 2</td>
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
@endsection
