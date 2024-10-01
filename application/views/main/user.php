<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <button type="button" class="btn btn-sm btn-dark" id="btn-add-user">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </button>
          </div>

        </div>
        <div class="card-body" style="font-size:13px;">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="userTables" width="100%" cellspacing="0">
              <thead class="text-center">
                <tr>
                  <th scope="col" class="align-middle">No</th>
                  <th scope="col" class="align-middle">Nama </th>
                  <th scope="col" class="align-middle">Uname</th>
                  <th scope="col" class="align-middle">Telp</th>
                  <th scope="col" class="align-middle">Role</th>
                  <th scope="col" class="align-middle">Actions</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- addUser -->
<div class="modal fade" id="addUser" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_addUser">

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label for="nama">
                Nama User
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control text-capitalize" name="nama" id="nama" autocomplete="off" required oninvalid="this.setCustomValidity('Nama User wajib di isi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label for="telpon">
                Telepon
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" name="telpon" id="telpon" autocomplete="off" required oninvalid="this.setCustomValidity('No Telepon wajib di isi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label for="username">
                Username
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" name="username" id="username" autocomplete="off" required oninvalid="this.setCustomValidity('Username wajib di isi!')" oninput="setCustomValidity('')">
              <div class="output mt-1" style="display:none"></div>
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label for="pass">
                Password
                <span class="text-danger">*</span>
              </label>
              <input type="password" class="form-control" name="pass" id="pass" required oninvalid="this.setCustomValidity('Password wajib di isi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-12">
              <label for="role">
                Pilih Role
                <span class="text-danger">*</span>
              </label>
              <select name="role" id="role" class="form-control selectrole" style="width:100%;" required oninvalid="this.setCustomValidity('User Role wajib di isi!')" oninput="setCustomValidity('')">
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>

            <div class="form-group col-md-6 col-sm-12 d-flex align-items-end">
              <button type="submit" id="add-user" class="btn btn-primary btn-block" style="height:calc(1.5em + 0.75rem + 2px);">
                Tambah
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- editUser -->
<div class="modal fade" id="editUser" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h4 class="modal-title text-dark font-weight-bold">Edit Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_editUser">

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label for="namaedit">
                Nama User
                <span class="text-danger">*</span>
              </label>
              <input type="hidden" name="iduser" id="iduser" class="form-control" readonly required>
              <input type="text" class="form-control text-capitalize" name="namaedit" id="namaedit" autocomplete="off" required oninvalid="this.setCustomValidity('Nama User wajib di isi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label for="telpedit">
                Telepon
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" name="telpedit" id="telpedit" autocomplete="off" required oninvalid="this.setCustomValidity('No Telepon wajib di isi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label for="usernameupdate">
                Username
                <span class="text-danger">*</span>
              </label>
              <input type="hidden" name="usernameold" id="usernameold" class="form-control" readonly required>
              <input type="text" class="form-control" name="usernameupdate" id="usernameupdate" autocomplete="off" required oninvalid="this.setCustomValidity('Username wajib di isi!')" oninput="setCustomValidity('')">
              <div class="output mt-1" style="display:none"></div>
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label for="passupdate">
                Password
                <span class="text-danger">*</span>
              </label>
              <input type="password" class="form-control" name="passupdate" id="passupdate" required oninvalid="this.setCustomValidity('Password wajib di isi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label for="roleupdate">
                Pilih Role
                <span class="text-danger">*</span>
              </label>
              <select name="roleupdate" id="roleupdate" class="form-control roleupdate" style="width:100%;" required oninvalid="this.setCustomValidity('Role wajib di isi!')" oninput="setCustomValidity('')">
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>
            <div class="form-group col-md-6 col-sm-6 d-flex align-items-end">
              <button type="submit" id="edit-user" class="btn btn-primary btn-block" style="height:calc(1.5em + 0.75rem + 2px);">
                Edit
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>