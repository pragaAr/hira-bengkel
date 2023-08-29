<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <a target="_blank" href="<?= base_url('ban/print') ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-print fa-sm"></i>
            Print
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="banTables" width="100%" cellspacing="0">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Seri</th>
                  <th scope="col">Merk, Uk</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Kondisi</th>
                  <th scope="col">Status</th>
                  <th scope="col">In</th>
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

<!-- vulk Ban -->
<div class="modal fade" id="vulkBan" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Ubah Kondisi Ban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_vulkBan">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="no_seri">No Seri</label>
                <input type="text" class="form-control" name="no_seri" id="no_seri" readonly>
              </div>
              <div class="form-group">
                <label for="nama_merk">Merk</label>
                <input type="text" class="form-control" name="nama_merk" id="nama_merk" readonly>
              </div>
              <div class="form-group">
                <label for="jml_ban">Jumlah</label>
                <input type="text" class="form-control" name="jml_ban" id="jml_ban" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="ukuran_ban">Ukuran</label>
                <input type="text" class="form-control" name="ukuran_ban" id="ukuran_ban" readonly>
              </div>
              <div class="form-group">
                <label for="vulk">Kondisi/V-1</label>
                <input type="text" class="form-control" name="vulk" id="vulk" readonly>
              </div>
              <div class="form-group">
                <label for="aksi">Aksi</label>
                <select name="aksi" id="aksi" class="form-control selectaksi" required>
                  <option value=""></option>
                  <option value="void">Void</option>
                  <option value="diberikan ke bengkel paket">Berikan ke Bengkel Paket</option>
                </select>
              </div>
              <div class="form-group float-right mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
              </div>
            </div>
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

<script src="<?= base_url('public/') ?>js/pages/main/stok/ban/ban.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>