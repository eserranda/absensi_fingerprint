@extends('layouts.master')
@push('headcss')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

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
                <h5 class="card-title">Tambah data Fingerprint Siswa</h5>
            </div>
            <div class="card-body border-bottom py-3 ">
                <form action=" " method="POST" id="form_data_fingerprint_guru">
                    @csrf
                    <div class="modal-body">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Siswa</label>
                                <select class="form-select" id="id_siswa" name="id_siswa">

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Modul Fingerprint</label>
                                <input type="text " class="form-control bg-white" id="id_modul_fingerprint"
                                    name="id_modul_fingerprint" readonly>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-5 mb-0">
                                <label class="form-label">ID Fingerprint</label>
                                <input type="text " class="form-control bg-white" id="id_fingerprint"
                                    name="id_fingerprint">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3 col-lg-2 d-flex align-items-center mb-0">
                                <button type="button" class="btn btn-info mt-4" id="scan">
                                    Scan
                                </button>
                            </div>
                        </div>


                        <button href="" class="btn btn-primary " type="submit">
                            Simpan
                        </button>
                        <a href="/fingerprint_siswa"class="btn btn-warning">Back</a>
                    </div>
                </form>
            </div>
        </div>

        @push('script')
            <script type="text/javascript">
                const form = document.getElementById('form_data_fingerprint_guru');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(form);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    fetch('/fingerprint_siswa/store', {
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
                                Swal.fire(
                                    'Tersimpan!',
                                    'Data berhasil ditambahkan.',
                                    'success'
                                );
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

                var kelas
                $(document).ready(function() {
                    $("#id_siswa").select2({
                        theme: "bootstrap-5",
                        placeholder: "Pilih nama siswa",
                        minimumInputLength: 1,
                        ajax: {
                            url: '/get_data_siswa',
                            dataType: 'json',
                            processResults: function(data) {
                                if (data && data.length > 0) {
                                    kelas = data[0].kelas;
                                    $('#id_modul_fingerprint').val(kelas);
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

                    document.getElementById('scan').addEventListener('click', function() {
                        const kelas_siswa = kelas;
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        fetch('/finger-status/update-status-finger-siswa', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                body: JSON.stringify({
                                    kelas: kelas_siswa
                                }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Lakukan sesuatu dengan data yang diterima
                                console.log(data);
                            })
                            .catch(error => {
                                // Tangani error jika terjadi
                                console.error('Error:', error);
                            });
                    });
                });

                document.addEventListener('DOMContentLoaded', function() {
                    function getID_siswa() {
                        const apiKey = kelas;
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                        const idModulFingerprint = document.getElementById('id_modul_fingerprint').value;
                        if (!idModulFingerprint) {
                            console.error('Modul Fingerprint  masih kosong');
                            return;
                        }
                        fetch('/fingerprint/get-finger-id-siswa/' + apiKey, {
                                method: 'GET',
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                const idFingerprintInput = document.getElementById('id_fingerprint');
                                if (data.error) {
                                    idFingerprintInput.value = "Loading...";
                                } else {
                                    idFingerprintInput.value = data;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }
                    getID_siswa();
                    setInterval(getID_siswa, 3000);
                });
            </script>
        @endpush
    @endsection
