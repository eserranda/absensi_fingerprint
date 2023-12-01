<!-- detail.blade.php -->
<div class="modal" id="detailModal" tabindex="-1" role="dialog">
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
                            <textarea class="form-control" name="alamat" rows="2" id="alamat" placeholder="Masuxkan Alamat"></textarea>
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

            const detailLinks = document.querySelectorAll('.show_detail');
            const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));

            const editLinks = document.querySelectorAll('.show_edit');
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));

            detailLinks.forEach(detailLink => {
                detailLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    detailModal.show();
                });
            });


            editLinks.forEach(editLink => {
                editLink.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Mendapatkan data dari atribut
                    const dataId = editLink.getAttribute('data-id');

                    // Lakukan fetch data menggunakan ID
                    fetch(`/data_siswa/edit/${dataId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);

                            const form = document.getElementById('edit_data_siswa');
                            form.elements['nama'].value = data.data.nama;
                            form.elements['nisn'].value = data.data.nisn;
                            form.elements['tempat_lahir'].value = data.data
                                .tempat_lahir;
                            form.elements['tanggal_lahir'].value = data.data
                                .tanggal_lahir;
                            form.elements['jenis_kelamin'].value = data.data
                                .jenis_kelamin;
                            form.elements['agama'].value = data.data.agama;
                            form.elements['kelas'].value = data.data.kelas;
                            form.elements['alamat'].value = data.data.alamat;

                            editModal.show();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });

        });
    </script>
@endpush
