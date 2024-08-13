  {{-- Tambah data  --}}
  <div class="modal modal-blur fade" id="modal_add_data" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Tambah Data </h5>
                  <button type="button" class="btn-close" onclick="closeModalAdd()"></button>
              </div>
              <form action="" method="POST" id="form_add_data">
                  @csrf
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="mb-3">
                                  <label class="form-label">Tanggal</label>
                                  <input type="date" class="form-control" id="tanggal" name="tanggal">
                                  <div class="invalid-feedback"></div>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="mb-3">
                                  <label class="form-label">Nama Siswa</label>
                                  <select class="form-select" id="id_siswa" name="id_siswa">

                                  </select>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-6">
                              <div class="mb-3">
                                  <label class="form-label">Kelas</label>
                                  <input type="text" class="form-control" id="kelas" name="kelas"
                                      placeholder="Kelas" readonly>
                                  <div class="invalid-feedback"></div>
                              </div>
                          </div>

                          <div class="col-lg-6">
                              <div class="mb-3">
                                  <label class="form-label">Mata Pelajaran</label>
                                  <select class="form-select" id="id_matpel" name="id_matpel"> </select>
                                  <div class="invalid-feedback"></div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-6">
                              <div class="mb-3">
                                  <label class="form-label">Guru/Pegajar</label>
                                  <input type="text" class="form-control" id="nama_guru" placeholder="Guru" readonly>
                                  <input type="hidden" id="id_guru" name="id_guru">
                                  <div class="invalid-feedback"> </div>
                              </div>
                          </div>

                          <div class="col-lg-6">
                              <div class="mb-3">
                                  <label class="form-label">Keterangan</label>
                                  <select class="form-select" id="keterangan" name="keterangan">
                                      <option value="" selected disabled>- Pilih Keterangan -</option>
                                      <option value="Hadir">Hadir</option>
                                      <option value="Izin">Izin</option>
                                      <option value="Sakit">Sakit</option>
                                      <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                  </select>
                                  <div class="invalid-feedback"></div>
                              </div>
                          </div>
                      </div>

                  </div>

                  <div class="modal-footer">
                      <button class="btn btn-primary ms-auto" type="submit">
                          Simpan
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <script>
      const form = document.getElementById('form_add_data');
      form.addEventListener('submit', function(event) {
          event.preventDefault();
          const formData = new FormData(form);

          const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
          fetch('/absensi-matpel/store', {
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
                          if (fieldName === 'id_guru' || fieldName === 'id_matpel' || fieldName ===
                              'id_siswa') {
                              inputField.classList.add('is-invalid');
                          } else {
                              inputField.classList.add('is-invalid');
                              inputField.nextElementSibling.textContent = data.errors[
                                  fieldName][0];
                          }
                      });

                      // Hapus kelas 'is-invalid' dari elemen formulir yang telah diperbaiki
                      const validFields = form.querySelectorAll('.is-invalid');
                      validFields.forEach(validField => {
                          const fieldName = validField.id;
                          if (!data.errors[fieldName]) {
                              if (fieldName === 'id_guru') {
                                  validField.classList.remove('is-invalid');
                              } else {
                                  validField.classList.remove('is-invalid');
                                  validField.nextElementSibling.textContent = '';
                              }
                          }
                      });
                  } else {
                      console.log(data.message);
                      form.reset();
                      $('#modal_add_data').modal('hide');
                      Swal.fire(
                          'Tersimpan!',
                          'Data berhasil ditambahkan.',
                          'success'
                      );
                      $('.datatable').DataTable().ajax.reload();
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  //   Swal.fire(
                  //       'Gagal!',
                  //       'Terjadi kesalahan saat menambahkan  data.',
                  //       'error'
                  //   );
              });
      });

      $(document).ready(function() {
          $("#id_siswa").select2({
              theme: "bootstrap-5",
              placeholder: "Pilih nama siswa",
              minimumInputLength: 1,
              dropdownParent: $("#modal_add_data"),
              ajax: {
                  url: '/get_data_siswa',
                  dataType: 'json',
                  processResults: function(data) {
                      if (data && data.length > 0) {
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

          $("#id_siswa").on("change", async function() {
              var id = $(this).val();
              try {
                  const response = await fetch('/siswa/get_kelas_siswa/' + id, {
                      method: 'GET',
                  });
                  const responseData = await response.json();
                  if (responseData) {
                      var kelas = responseData;
                      $('#kelas').val(kelas);
                  } else {
                      throw new Error('Gagal mendapatkan data Kelas');
                  }
              } catch (error) {
                  console.error('Terjadi kesalahan:', error);
              }
          });

          $("#id_matpel").select2({
              theme: "bootstrap-5",
              placeholder: "Pilih Matpel",
              // minimumInputLength: 1,
              dropdownParent: $("#modal_add_data"),
              ajax: {
                  url: '/get_data_matpel',
                  dataType: 'json',
                  processResults: function(data) {
                      if (data && data.length > 0) {
                          var results = $.map(data, function(item) {
                              return {
                                  id: item.id,
                                  text: item.nama_matpel
                              };
                          });
                          return {
                              results: results
                          };
                      }
                  },
              }
          });

          $("#id_matpel").on("change", async function() {
              var id = $(this).val();
              try {
                  const response = await fetch('/matpel/get_id_guru/' + id, {
                      method: 'GET',
                  });
                  const responseData = await response.json();
                  if (responseData.status) {
                      var id_guru = responseData.data.id_guru;
                      var nama_guru = responseData.data.nama_guru;

                      $('#id_guru').val(id_guru);
                      $('#nama_guru').val(nama_guru);
                  } else {
                      throw new Error(responseData.message || 'Gagal mendapatkan data Kelas');
                  }
              } catch (error) {
                  console.error('Terjadi kesalahan:', error);
              }
          });

      });


      function closeModalAdd() {
          const invalidInputs = document.querySelectorAll('.is-invalid');
          invalidInputs.forEach(invalidInput => {
              invalidInput.value = '';
              invalidInput.classList.remove('is-invalid');
              const errorNextSibling = invalidInput.nextElementSibling;
              if (errorNextSibling && errorNextSibling.classList.contains(
                      'invalid-feedback')) {
                  errorNextSibling.textContent = '';
              }
          });

          $('#modal_add_data').modal('hide');
          const form = document.getElementById('form_data_kelas');
          //   form.reset();
          $('#modal_add_data').modal('hide');
      }
  </script>
