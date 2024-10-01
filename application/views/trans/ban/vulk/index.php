<div class="container-fluid">
  <div class="success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cetakDo">
              <i class="fas fa-print fa-sm"></i>
              Print DO
            </a>
            <a href="<?= base_url('vulkanisir/allDetailVulk') ?>" class="btn btn-warning btn-sm">
              <i class="fas fa-file-alt fa-sm"></i>
              All Data
            </a>
            <a href="<?= base_url('vulkanisir/allDetailVulkDone') ?>" class="btn btn-secondary btn-sm">
              <i class="fas fa-file-alt fa-sm"></i>
              All Data Done
            </a>
            <a href="<?= base_url('vulkanisir/selesai') ?>" class="btn btn-success btn-sm">
              <i class="fas fa-check-circle fa-sm"></i>
              Done
            </a>
            <a href="<?= base_url('vulkanisir/addData') ?>" class="btn btn-dark btn-sm">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </a>
          </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="vulkBanTables" width="100%" cellspacing="0">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Kd Vulk</th>
                  <th scope="col">Tempat Vulk</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Action</th>
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
      <a target="_blank" href="https://hira-express.com">PT. Hira Adya Naranata</a>
      Hak cipta di lindungi
      <div class="bullet"></div>
    </div>
  </div>
</footer>
</div>
</div>

<!-- detailModal -->
<div class="modal fade" id="detailModal" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title">Detail Vulkanisir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- cetakDoModal -->
<div class="modal fade" id="cetakDo" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title">Cetak DO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('vulkanisir/printDo') ?>" method="POST" target="_blank">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <label for="id">Pilih Nota</label>
              <select name="id" id="id" class="form-control selectnota" required>
                <option value=""></option>

              </select>
              <input type="hidden" name="nota" id="nota" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="buttonCetakDo">Cetak</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- detailModal -->
<div class="modal fade" id="detailVulk" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="titledetail"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-between align-items-center font-weight-bold">
          <p id="detailtempat"></p>
          <p id="detailtgl"></p>
        </div>
        <hr>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="text-center">
              <tr>
                <th scope="col">Seri</th>
                <th scope="col">Merk</th>
                <th scope="col">Ukuran</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody class="text-center" id="tbodyDetail">

            </tbody>
          </table>
        </div>
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

<script src="<?= base_url('public/') ?>js/pages/notify-swal.js"></script>

<script src="<?= base_url('public/') ?>js/pages/trans/ban/vulk/index.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>