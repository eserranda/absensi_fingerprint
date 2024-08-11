   {{-- edit data  --}}
   <div class="modal modal-blur fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">

                   <h5 class="modal-title">Edit Data </h5>
                   <button type="button" class="btn-close" onclick="closeModalEdit()"></button>

               </div>
               <form id="editForm">
                   @csrf
                   <div class="modal-body">
                       <div class="row">
                           <div class="col-lg-6">
                               <div class="mb-3">
                                   <input type="hidden" class="form-control" id="edit_id" name="id">
                                   <label class="form-label">Nama Lengkap</label>
                                   <select id="edit_id_guru" name="edit_id_guru">

                                   </select>
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="mb-3">
                                   <label class="form-label">NUPTK</label>
                                   <input type="text" class="form-control" id="edit_username" name="edit_username"
                                       readonly>
                                   <div class="invalid-feedback"></div>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-lg-6">
                               <div class="mb-3">
                                   <label class="form-label">Email</label>
                                   <input type="email" class="form-control" id="edit_email" name="edit_email">
                                   <div class="invalid-feedback"></div>
                               </div>
                           </div>

                       </div>
                       <div id="editRolesContainer">

                       </div>


                       <div class="modal-footer">
                           <button href="" class="btn btn-primary ms-auto" type="submit">
                               Update
                           </button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>

   <script>
       $('#editModal').on('shown.bs.modal', function() {
           const id = document.getElementById('edit_id').value;
           fetch('/role/getUserRoles/' + id)
               .then(response => response.json())
               .then(data => {
                   const user = data.user;
                   console.log(user);
                   const roles = data.roles;

                   const rolesContainer = document.getElementById('editRolesContainer');
                   rolesContainer.innerHTML = ''; // Clear any existing content

                   roles.forEach(role => {
                       const div = document.createElement('div');
                       div.className = 'custom-control custom-checkbox custom-control-inline';

                       const checkbox = document.createElement('input');
                       checkbox.type = 'checkbox';
                       checkbox.className = 'custom-control-input';
                       checkbox.id = `edit_roles_${role.id}`;
                       checkbox.name = 'edit_roles[]';
                       checkbox.value = role.id;

                       // Check if the role is already assigned to the user
                       if (user.roles.some(userRole => userRole.id === role.id)) {
                           checkbox.checked = true;
                       }

                       const label = document.createElement('label');
                       label.className = 'custom-control-label';
                       label.htmlFor = `edit_roles_${role.id}`;
                       label.appendChild(document.createTextNode(role.name));

                       div.appendChild(checkbox);
                       div.appendChild(label);
                       rolesContainer.appendChild(div);
                   });
               })
               .catch(error => console.error('Error fetching data:', error));
       });

       function closeModalEdit() {
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

           const form = document.getElementById('editForm');
           form.reset();
           $('#editModal').modal('hide');
       }

       document.getElementById('editForm').addEventListener('submit', async (event) => {
           event.preventDefault();

           const form = event.target;
           const formData = new FormData(form);
           const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

           try {
               const response = await fetch('/akun/update_akun_guru', {
                   method: 'POST',
                   headers: {
                       'Accept': 'application/json',
                       'X-CSRF-TOKEN': csrfToken
                   },
                   body: formData,
               });

               const data = await response.json();
               console.log(data);
               if (!data.success) {
                   Object.keys(data.messages).forEach(fieldName => {
                       const inputField = document.getElementById(fieldName);
                       if (inputField) {
                           inputField.classList.add('is-invalid');
                           if (inputField.nextElementSibling) {
                               inputField.nextElementSibling.textContent = data.messages[
                                   fieldName][0];
                           }
                       }
                   });

                   // hapus error message jika form sudah di isi
                   const validFields = document.querySelectorAll('.is-invalid');
                   validFields.forEach(validField => {
                       const fieldName = validField.id;
                       if (!data.messages[fieldName]) {
                           validField.classList.remove('is-invalid');
                           if (validField.nextElementSibling) {
                               validField.nextElementSibling.textContent = '';
                           }
                       }
                   });

               } else {
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

                   $('#datatable').DataTable().ajax.reload();
                   $('#editModal').modal('hide');
               }
           } catch (error) {
               console.error(error);
           }
       });

       $('#edit_id_guru').select2({
           theme: "bootstrap-5",
           placeholder: "Pilih Guru",
           dropdownParent: $('#editModal'),
           ajax: {
               url: '/get_data_guru',
               dataType: 'json',
               delay: 250,
               processResults: function(data) {
                   return {
                       results: data
                   };
               },
               cache: true
           }
       });

       $("#edit_id_guru").on("change", async function() {
           var id = $(this).val();
           //    alert(id);
           try {
               const response = await fetch('/get_nuptk_guru/' + id, {
                   method: 'GET',
               });
               const responseData = await response.json();
               if (responseData.status === true) {
                   var nuptk = responseData.data;
                   $('#edit_username').val(nuptk);
               } else {
                   throw new Error('Gagal mendapatkan data nuptk');
               }
           } catch (error) {
               console.error('Terjadi kesalahan:', error);
           }
       });
   </script>
