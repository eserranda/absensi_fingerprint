 <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Tambah Jadwal</h5>
                 <button type="button" class="btn-close" onclick="closeModalAdd()"></button>

             </div>
             <form id="addForm">
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="mb-3">
                                 <label class="form-label">Semseter</label>
                                 <select class="form-select" id="semester" name="semester">
                                     <option value="" selected disabled>- Pilih Semester -</option>
                                     <option value="Ganjil">Ganjil</option>
                                     <option value="Genap">Genap</option>
                                 </select>
                                 <div class="invalid-feedback"></div>
                             </div>
                         </div>

                         <div class="col-lg-6">
                             <div class="mb-3">
                                 <label class="form-label">Tahun Ajaran</label>
                                 <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran"
                                     placeholder="ex: 2022/2023">

                                 <div class="invalid-feedback"></div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-primary " type="submit">
                         Simpan
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <script>
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

         const form = document.getElementById('addForm');
         form.reset();
         $('#addModal').modal('hide');
     }

     document.getElementById('addForm').addEventListener('submit', async (event) => {
         event.preventDefault();
         const form = event.target;
         const formData = new FormData(form);
         const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

         try {
             const response = await fetch('/tahun-ajaran/store', {
                 method: 'POST',
                 headers: {
                     'Accept': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                 },
                 body: formData,
             });

             //  if (!response.ok) {
             //      throw new Error('Network response was not ok');
             //  }

             const data = await response.json();
             console.log(data);

             if (data.errors) {
                 // Display validation errors
                 Object.keys(data.errors).forEach(fieldName => {
                     const inputField = document.getElementById(fieldName);
                     if (inputField) {
                         inputField.classList.add('is-invalid');
                         const errorElement = inputField.nextElementSibling;
                         if (errorElement) {
                             errorElement.textContent = data.errors[fieldName][0];
                         }
                     }
                 });

                 // Remove 'is-invalid' class from corrected form fields
                 const invalidFields = form.querySelectorAll('.is-invalid');
                 invalidFields.forEach(invalidField => {
                     const fieldName = invalidField.id;
                     if (!data.errors[fieldName]) {
                         invalidField.classList.remove('is-invalid');
                         const errorElement = invalidField.nextElementSibling;
                         if (errorElement) {
                             errorElement.textContent = '';
                         }
                     }
                 });
             } else {
                 form.reset();
                 $('#addModal').modal('hide');
                 Swal.fire(
                     'Tersimpan!',
                     'Jadwal pelajaran berhasil ditambahkan.',
                     'success'
                 );

                 setTimeout(function() {
                     location.reload();
                 }, 1000);
             }
         } catch (error) {
             Swal.fire(
                 'Gagal!',
                 'Terjadi kesalahan saat menambahkan Jadwal pelajaran.',
                 'error'
             );
         }
     });
 </script>
