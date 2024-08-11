 {{-- edit data  --}}
 <div class="modal  modal-blur fade" id="modal_edit_data" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Tambah Jadwal</h5>
                 <button type="button" class="btn-close" onclick="closeModalEdit()"></button>

             </div>
             <form action="" method="POST" id="form_edit_jadwal">
                 @csrf
                 <div class="modal-body">
                     <input type="hidden" id="edit_id" name="edit_id">
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="mb-3">
                                 <label class="form-label">Hari</label>
                                 <select class="form-select" id="edit_hari" name="edit_hari">
                                     {{-- <option value="">- Pilih Hari -</option> --}}
                                     <option value="Senin">Senin</option>
                                     <option value="Selasa">Selasa</option>
                                     <option value="Rabu">Rabu</option>
                                     <option value="Kamis">Kamis</option>
                                     <option value="Jumat">Jumat</option>
                                     <option value="Sabtu">Sabtu</option>
                                 </select>
                                 <div class="invalid-feedback"></div>
                             </div>
                         </div>

                         <div class="col-lg-6">
                             <div class="mb-3">
                                 <label class="form-label">Matpel</label>
                                 <select class="form-select" id="edit_id_matpel" name="edit_id_matpel">
                                 </select>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-lg-6">
                             <div class="mb-3">
                                 <label class="form-label">Jam Mulai</label>
                                 <input type="time" class="form-control" id="edit_jam_mulai" name="edit_jam_mulai">
                                 <div class="invalid-feedback"></div>
                             </div>
                         </div>

                         <div class="col-lg-6">
                             <div class="mb-3">
                                 <label class="form-label">Jam Selesai</label>
                                 <input type="time" class="form-control" id="edit_jam_selesai"
                                     name="edit_jam_selesai">
                                 <div class="invalid-feedback"></div>

                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-lg-6">
                             <div class="mb-3">
                                 <label class="form-label">Pengajar</label>
                                 <select class="form-select" id="edit_id_guru" name="edit_id_guru">

                                 </select>
                             </div>
                         </div>

                         <div class="col-lg-6">
                             <div class="mb-3">
                                 <label class="form-label">Kelas</label>
                                 <select class="form-select" id="edit_kelas" name="edit_kelas">
                                     <option value="">- Pilih Kelas -</option>
                                     <option value="XI MIPA 1">XI MIPA 1</option>
                                     <option value="X IPS 1">X IPS 1</option>
                                     <option value="XII IPS 1">XII IPS 1</option>
                                 </select>
                                 <div class="invalid-feedback"></div>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-lg-6">
                             <div class="mb-3">
                                 <label class="form-label">Ruangan</label>
                                 <select class="form-select" id="edit_ruangan" name="edit_ruangan">
                                     <option value="">- Pilih Ruangan -</option>
                                     <option value="XI MIPA 1">XI MIPA 1</option>
                                     <option value="X IPS 1">X IPS 1</option>
                                     <option value="XII IPS 1">XII IPS 1</option>
                                 </select>
                                 <div class="invalid-feedback"></div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     {{-- <button class="btn btn-primary " type="submit">
                        Update
                    </button> --}}
                     <button type="button" tabindex="2" class="btn btn-primary"
                         onclick="updateData()">Update</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
