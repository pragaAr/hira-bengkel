<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <button type="button" class="btn btn-sm btn-dark" id="btn-add-toko">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </button>
          </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tokoTables" width="100%" cellspacing="0">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Toko</th>
                  <th scope="col">No Telepon</th>
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

<!-- add Toko -->
<div class="modal fade" id="addToko" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Form Tambah Data Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_addToko">
          <div class="form-group">
            <label class="font-weight-bold" for="nama">
              Nama Toko
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control text-capitalize" name="nama" id="nama" placeholder="Nama Toko.." autocomplete="off" required oninvalid="this.setCustomValidity('Nama Toko wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold" for="telp">
              No Telepon
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control text-capitalize" name="telp" id="telp" placeholder="No Telepon.." autocomplete="off">
          </div>
          <div>
            <button type="submit" id="add-toko" class="btn btn-primary float-right" style="border: 1px solid white">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit Toko -->
<div class="modal fade" id="editToko" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h4 class="modal-title text-dark">Edit Data Toko</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_editToko">

          <div class="form-group">
            <label class="font-weight-bold" for="namaedit">
              Nama Toko
              <span class="text-danger">*</span>
            </label>
            <input type="hidden" name="idtoko" id="idtoko" class="form-control" readonly required>
            <input type="text" class="form-control text-capitalize" name="namaedit" id="namaedit" placeholder="Nama Toko.." autocomplete="off" required oninvalid="this.setCustomValidity('Nama Toko wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold" for="telpedit">
              No Telepon
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control text-capitalize" name="telpedit" id="telpedit" placeholder="no Telepon Toko.." autocomplete="off" required oninvalid="this.setCustomValidity('no Telepon Toko wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div>
            <button type="submit" id="edit-toko" class="btn btn-primary float-right" style="border: 1px solid white">
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

<script src="<?= base_url('public/') ?>js/pages/main/toko.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>