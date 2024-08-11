   {{-- Tambah data  --}}
   <div class="modal modal-blur fade" id="modal_add_data" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">Tambah Users Guru</h5>
                   <button type="button" class="btn-close" onclick="closeModalAdd()"></button>
               </div>
               <form action="" method="POST" id="form_add_user_guru">
                   @csrf
                   <div class="modal-body">
                       <div class="row">
                           <div class="col-lg-6">
                               <div class="mb-3">
                                   <label class="form-label">Nama Lengkap</label>
                                   <select class="form-select" id="id_guru" name="id_guru">

                                   </select>
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="mb-3">
                                   <label class="form-label">NUPTK</label>
                                   <input type="text" class="form-control" id="username" name="username" readonly>
                                   <div class="invalid-feedback"></div>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-lg-6">
                               <div class="mb-3">
                                   <label class="form-label">Email</label>
                                   <input type="email" class="form-control" id="email" name="email">
                                   <div class="invalid-feedback"></div>
                               </div>
                           </div>

                           <div class="col-lg-6">
                               <div class="mb-3">
                                   <label class="form-label">Password</label>
                                   <input type="password" class="form-control" id="password" name="password">

                                   <div class="invalid-feedback"></div>
                               </div>
                           </div>
                       </div>
                       <div id="roles-container"></div>
                       {{-- <div class="row">
                        <div class="form-label">Role</div>
                        <div>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="guru" id="guru"
                                    value="guru" checked>
                                <span class="form-check-label">Guru</span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="wali_kelas" id="wali_kelas"
                                    value="wali_kelas">
                                <span class="form-check-label">Wali Kelas</span>
                            </label>
                        </div>
                    </div> --}}

                       <div class="modal-footer">
                           <button href="" class="btn btn-primary ms-auto" type="submit">
                               Simpan
                           </button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>
