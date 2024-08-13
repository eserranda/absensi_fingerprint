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
