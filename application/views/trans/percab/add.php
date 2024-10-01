<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('percab') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <h6 class="text-danger font-weight-bold">
            <em>--Harap teliti dalam menginput data--</em>
          </h6>
          <h6 class="text-danger font-weight-bold mb-3">
            <em>--Gunakan tanda (-) untuk pemisah no surat !--</em>
          </h6>
          <hr>
          <form action="<?= base_url('percab/proses') ?>" method="POST">
            <div class="form-row">
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="nosurat">No Surat </label>
                <input type="text" name="nosurat" id="nosurat" class="form-control text-uppercase" autofocus autocomplete="off" required>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="tglsurat">Tanggal Surat</label>
                <input type="date" name="tglsurat" id="tglsurat" class="form-control" required>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="cabang">Cabang</label>
                <input type="text" name="cabang" id="cabang" class="form-control text-uppercase" autocomplete="off" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="truckid">Truck</label>
                <select name="truckid" id="truckid" class="form-control selecttruck">
                  <option value=""></option>

                </select>
                <input type="hidden" name="platno" id="platno" class="form-control text-uppercase" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="sopir">Sopir</label>
                <input type="text" name="sopir" id="sopir" class="form-control text-capitalize" autocomplete="off">
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="bengkel">Bengkel</label>
                <input type="text" name="bengkel" id="bengkel" class="form-control text-capitalize" autocomplete="off">
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="tglnota">Tanggal Nota</label>
                <input type="date" name="tglnota" id="tglnota" class="form-control">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold" for="part">Sparepart</label>
                <input type="text" name="part" id="part" class="form-control text-capitalize" autocomplete="off">
              </div>
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold" for="ongkos">Ongkos</label>
                <input type="text" name="ongkos" id="ongkos" class="form-control" autocomplete="off">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-10 col-md-10">
                <label class="font-weight-bold" for="ket">Keterangan Perbaikan</label>
                <input type="text" name="ket" id="ket" class="form-control text-capitalize" autocomplete="off">
              </div>
              <div class="form-group col-lg-2 col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-primary btn-block mt-4" id="tambah" style="border: 1px solid white; height:calc(1.5em + 0.75rem + 2px);">
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5>Data Perbaikan Cabang</h5>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered" id="cart" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>Truck</th>
                      <th>Bengkel</th>
                      <th>Tgl Nota</th>
                      <th>Sparepart</th>
                      <th>Ongkos</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="4">
                        <h5 class="font-weight-bold">Total Ongkos : </h5>
                      </td>
                      <td>
                        <h5 class="text-danger text-right font-weight-bold" id="total"> </h5>
                      </td>
                      <td>
                        <input type="hidden" name="total_hidden" value="">
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Simpan" style="border:1px solid white">
                          <i class="fa fa-save"></i>
                        </button>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </form>
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

<script src="<?= base_url('public/') ?>vendor/select2/select2-full.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?= base_url('public/') ?>js/sb-admin-2.min.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/format.js"></script>

<script src="<?= base_url('public/') ?>js/pages/trans/percab/add.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>