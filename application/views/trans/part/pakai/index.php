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
            <a href="<?= base_url('pakai/detailAll') ?>" class="btn btn-sm btn-success mb-2">
              <i class="far fa-file-alt fa-sm"></i>
              Detail All
            </a>
            <a href="<?= base_url('pakai/addData') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </a>
          </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="pakaiPartTables" width="100%" cellspacing="0">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Kd Pakai</th>
                  <th scope="col">Truck</th>
                  <th scope="col">Montir</th>
                  <th scope="col">Total</th>
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

<script src="<?= base_url('public/') ?>js/pages/trans/part/pakai/index.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>