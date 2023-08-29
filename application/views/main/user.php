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
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="userTables" width="100%" cellspacing="0">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama User</th>
                  <th scope="col">Username</th>
                  <th scope="col">No Telp</th>
                  <th scope="col">User Role</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody style="font-size:13px;">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>
        &copy; <?= date('Y') ?>
        Dibuat Dengan
      </span>
      <i class="fas fa-heart text-danger"></i>
      <a target="_blank" href="https://hira-express.com">PT. Hira Adya Naranata</a> Hak cipta di lindungi <div class="bullet"></div>
    </div>
  </div>
</footer>
</div>
</div>

<!-- addUser -->
<div class="modal fade" id="addUser" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h4 class="modal-title text-dark">Form Tambah Data User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_addUser">

          <div class="form-group">
            <label class="font-weight-bold" for="nama">
              Nama User
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control text-capitalize" name="nama" id="nama" placeholder="Nama User.." autocomplete="off" required oninvalid="this.setCustomValidity('Nama User wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold" for="telpon">
              No Telepon
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" name="telpon" id="telpon" placeholder="No Telepon.." autocomplete="off" required oninvalid="this.setCustomValidity('No Telepon wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold" for="username">
              Username
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username.." autocomplete="off" required oninvalid="this.setCustomValidity('Username wajib di isi!')" oninput="setCustomValidity('')">
            <div class="output mt-1" style="display:none"></div>
          </div>
          <div class="form-group">
            <label class="font-weight-bold" for="pass">
              Password
              <span class="text-danger">*</span>
            </label>
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Password.." required oninvalid="this.setCustomValidity('Password wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold" for="role">
              Role
              <span class="text-danger">*</span>
            </label>
            <select name="role" id="role" class="form-control selectrole" style="width:100%;" required oninvalid="this.setCustomValidity('User Role wajib di isi!')" oninput="setCustomValidity('')">
              <option value=""></option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
          <div>
            <button type="submit" id="add-user" class="btn btn-primary float-right">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- editUser -->
<div class="modal fade" id="editUser" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h4 class="modal-title text-dark">Edit Data User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_editUser">

          <div class="form-group">
            <label class="font-weight-bold" for="namaedit">
              Nama User
              <span class="text-danger">*</span>
            </label>
            <input type="hidden" name="iduser" id="iduser" class="form-control" readonly required>
            <input type="text" class="form-control text-capitalize" name="namaedit" id="namaedit" placeholder="Nama User.." autocomplete="off" required oninvalid="this.setCustomValidity('Nama User wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold" for="telpedit">
              No Telepon
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" name="telpedit" id="telpedit" placeholder="No Telepon.." autocomplete="off" required oninvalid="this.setCustomValidity('No Telepon wajib di isi!')" oninput="setCustomValidity('')">
          </div>

          <div class="form-group">
            <label class="font-weight-bold" for="usernameupdate">
              Username
              <span class="text-danger">*</span>
            </label>
            <input type="hidden" name="usernameold" id="usernameold" class="form-control" readonly required>
            <input type="text" class="form-control" name="usernameupdate" id="usernameupdate" placeholder="Username.." autocomplete="off" required oninvalid="this.setCustomValidity('Username wajib di isi!')" oninput="setCustomValidity('')">
            <div class="output mt-1" style="display:none"></div>
          </div>
          <div class="form-group">
            <label class="font-weight-bold" for="passupdate">
              Password
              <span class="text-danger">*</span>
            </label>
            <input type="password" class="form-control" name="passupdate" id="passupdate" placeholder="Password.." required oninvalid="this.setCustomValidity('Password wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold" for="roleupdate">
              Role
              <span class="text-danger">*</span>
            </label>
            <select name="roleupdate" id="roleupdate" class="form-control roleupdate" style="width:100%;" required oninvalid="this.setCustomValidity('Role wajib di isi!')" oninput="setCustomValidity('')">
              <option value=""></option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>

          <div>
            <button type="submit" id="edit-user" class="btn btn-primary float-right">
              Simpan
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<script src="<?= base_url('public/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('public/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/datatables/jquery.dataTables.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/select2/select2-full.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?= base_url('public/') ?>js/sb-admin-2.min.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/user.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>