<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('vulkanisir') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <h6 class="text-danger font-weight-bold mb-3">
            <em>--Harap teliti dalam menginput data--</em>
          </h6>
          <hr>
          <form action="<?= base_url('vulkanisir/proses') ?>" method="POST">

            <div class="form-row">
              <div class="form-group col-md-4">
                <label class="font-weight-bold" for="kd">Kd Vulk</label>
                <input type="text" name="kd" id="kd" value="<?= $kd ?>" class="form-control text-uppercase" readonly>
              </div>
              <div class="form-group col-md-4">
                <label class="font-weight-bold" for="tgl">Tanggal</label>
                <input type="text" name="tgl" id="tgl" value="<?= date('d-m-Y') ?>" class="form-control" readonly>
              </div>
              <div class="form-group col-md-4">
                <label class="font-weight-bold" for="tokoid">Tempat Vulk</label>
                <select name="tokoid" id="tokoid" class="form-control selecttoko" style="width:100%" required>
                  <option value=""></option>

                </select>
                <input type="hidden" name="toko" id="toko" class="form-control" required readonly>
              </div>
            </div>

            <h5>Data Ban</h5>
            <hr>

            <div class="form-row">
              <div class="form-group col-md-3">
                <label class="font-weight-bold" for="banid">No Seri</label>
                <select name="banid" id="banid" class="form-control selectban" style="width:100%">
                  <option value=""></option>

                </select>
                <input type="hidden" name="noseri" id="noseri" class="form-control" readonly>
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-bold" for="merk">Merk Ban</label>
                <input type="text" name="merk" id="merk" class="form-control" readonly>
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-bold" for="size">Ukuran Ban</label>
                <input type="text" name="size" id="size" class="form-control" readonly>
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-bold" for="jml">Jumlah Ban</label>
                <input type="number" name="jml" id="jml" class="form-control" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-8">
                <label class="font-weight-bold" for="ket">Keterangan</label>
                <input type="text" name="ket" id="ket" class="form-control text-capitalize" readonly>
              </div>
              <div class="form-group col-md-4 d-flex align-items-end">
                <button type="button" class="btn btn-primary btn-block" id="tambah" style="height:calc(1.5em + 0.75rem + 2px);" disabled>
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5>Data Vulkanisir Ban</h5>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered" id="cart">
                  <thead class="text-center">
                    <tr>
                      <th scope="col">No Seri</th>
                      <th scope="col">Merk</th>
                      <th scope="col">Ukuran</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="3">
                        <h5 class="font-weight-bold">Total Ban Vulkanisir : </h5>
                      </td>
                      <td>
                        <h5 class="font-weight-bold text-danger" id="totalban"></h5>
                      </td>
                      <td>
                        <input type="hidden" name="totalban_hidden" value="">
                        <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="Simpan">
                          <i class="fa fa-save fa-sm"></i>
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

<script src="<?= base_url('public/') ?>js/pages/trans/ban/vulk/add.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>