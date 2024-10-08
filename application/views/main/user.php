<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <button type="button" class="btn btn-dark" id="btn-add-user">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </button>
          </div>

        </div>
        <div class="card-body" style="font-size:13px;">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="userTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Nama </th>
                  <th class="align-middle">Uname</th>
                  <th class="align-middle">Telp</th>
                  <th class="align-middle">Role</th>
                  <th class="align-middle">Aksi</th>
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
<div class="modal fade p-0" id="addUser" data-backdrop="static">
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
              <label class="text-dark font-weight-bold" for="nama">
                Nama User
              </label>
              <input type="text" class="form-control text-capitalize" name="nama" id="nama" autocomplete="off" required oninvalid="this.setCustomValidity('Nama User wajib di isi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="telpon">
                Telepon
              </label>
              <input type="text" class="form-control" name="telpon" id="telpon" autocomplete="off" required oninvalid="this.setCustomValidity('No Telepon wajib di isi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="username">
                Username
              </label>
              <input type="text" class="form-control" name="username" id="username" autocomplete="off" required oninvalid="this.setCustomValidity('Username wajib di isi!')" oninput="setCustomValidity('')">
              <div class="output mt-1" style="display:none"></div>
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="pass">
                Password
              </label>
              <input type="password" class="form-control" name="pass" id="pass" required oninvalid="this.setCustomValidity('Password wajib di isi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="text-dark font-weight-bold" for="role">
                Pilih Role
              </label>
              <select name="role" id="role" class="form-control selectrole" style="width:100%;" required oninvalid="this.setCustomValidity('User Role wajib di isi!')" oninput="setCustomValidity('')">
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>

            <div class="form-group col-md-12">
              <button type="submit" id="add-user" class="btn btn-primary btn-block">
                Simpan
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- editUser -->
<div class="modal fade p-0" id="editUser" data-backdrop="static">
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
              <label class="text-dark font-weight-bold" for="namaedit">
                Nama User
              </label>
              <input type="hidden" name="iduser" id="iduser" class="form-control" readonly required>
              <input type="text" class="form-control text-capitalize" name="namaedit" id="namaedit" autocomplete="off" required oninvalid="this.setCustomValidity('Nama User wajib di isi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="telpedit">
                Telepon
              </label>
              <input type="text" class="form-control" name="telpedit" id="telpedit" autocomplete="off" required oninvalid="this.setCustomValidity('No Telepon wajib di isi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="usernameupdate">
                Username
              </label>
              <input type="hidden" name="usernameold" id="usernameold" class="form-control" readonly required>
              <input type="text" class="form-control" name="usernameupdate" id="usernameupdate" autocomplete="off" required oninvalid="this.setCustomValidity('Username wajib di isi!')" oninput="setCustomValidity('')">
              <div class="output mt-1" style="display:none"></div>
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="passupdate">
                Password
              </label>
              <input type="password" class="form-control" name="passupdate" id="passupdate" required oninvalid="this.setCustomValidity('Password wajib di isi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="text-dark font-weight-bold" for="roleupdate">
                Pilih Role
              </label>
              <select name="roleupdate" id="roleupdate" class="form-control roleupdate" style="width:100%;" required oninvalid="this.setCustomValidity('Role wajib di isi!')" oninput="setCustomValidity('')">
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>
            <div class="form-group col-md-12">
              <button type="submit" id="edit-user" class="btn btn-primary btn-block">
                Simpan
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>