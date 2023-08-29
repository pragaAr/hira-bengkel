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
            <a href="<?= base_url('oper_ban/allDataPakai') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </a>
          </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="operBanTables" width="100%" cellspacing="0">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Kd Oper</th>
                  <th scope="col">Kd Pakai</th>
                  <th scope="col">Seri</th>
                  <th scope="col">Asal</th>
                  <th scope="col">Oper</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Montir</th>
                  <th scope="col">Status</th>
                  <th scope="col">Tgl</th>
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

<!-- operLagiModal -->
<div class="modal fade" id="operLagiModal" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title">Operan Ban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="font-weight-bold" id="subtitle"></p>
        <hr>
        <form id="form_operLagi">

          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-left" for="seri">No Seri Ban</label>
              <input type="hidden" class="form-control" id="dari" name="dari" readonly>
              <input type="hidden" class="form-control" id="daritruck" name="daritruck" readonly>
              <input type="hidden" class="form-control" id="kdoper" name="kdoper" readonly>
              <input type="hidden" class="form-control" id="banid" name="banid" readonly>
              <input type="hidden" class="form-control" id="pakaiid" name="pakaiid" readonly>
              <input type=" text" class="form-control" id="seri" name="seri" readonly>
            </div>
            <div class=" form-group col-lg-6 col-md-6">
              <label class="font-weight-bold" for="merk">Merk Ban</label>
              <input type="hidden" class="form-control" id="merkid" name="merkid" readonly>
              <input type="text" class="form-control" id="merk" name="merk" readonly>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold" for="jmlban">Jumlah Pakai</label>
              <input type="number" class="form-control" id="jmlban" name="jmlban" readonly required>
            </div>
            <div class=" form-group col-lg-6 col-md-6">
              <label class="font-weight-bold" for="tujuanid">Oper Ke</label>
              <select name="tujuanid" id="tujuanid" class="form-control selecttruck" required>
                <option value=""></option>

              </select>
              <input type="hidden" name="tujuan" id="tujuan" class="form-control" readonly>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold" for="montir">Nama Montir</label>
              <input type="text" class="form-control text-capitalize" id="montir" name="montir" required oninvalid="this.setCustomValidity('Montir nya siapa ?')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold" for="ket">Keterangan Oper</label>
              <input type="text" class="form-control text-capitalize" id="ket" name="ket" required oninvalid="this.setCustomValidity('Di Oper karena apa ?')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg text-right">
              <button type="submit" class="btn btn-primary">Oper</button>
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

<script src="<?= base_url('public/') ?>js/pages/notify-swal.js"></script>

<script src="<?= base_url('public/') ?>js/pages/trans/ban/oper/index.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>