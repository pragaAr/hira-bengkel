<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('beli') ?>" class="btn btn-sm btn-dark mb-2">
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
          <form action="<?= base_url('pakai/proses') ?>" method="POST">
            <div class="form-row">
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold" for="kd">Kd Pakai</label>
                <input type="text" name="kd" id="kd" value="<?= $kd ?>" readonly class="form-control text-uppercase">
              </div>
              <div class="form-group col-lg-2 col-md-6">
                <label class="font-weight-bold" for="tgl">Tanggal</label>
                <input type="text" name="tgl" id="tgl" value="<?= date('d/m/Y') ?>" readonly class="form-control">
              </div>
              <div class="form-group col-lg-4 col-md-6">
                <label class="font-weight-bold" for="truckid">Plat Nomor</label>
                <select name="truckid" id="truckid" class="form-control selecttruck" style="width:100%" required>
                  <option value=""></option>
                </select>
                <input type="hidden" name="platno" id="platno" value="" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold" for="montir">Nama Montir</label>
                <input type="text" name="montir" id="montir" value="" required readonly class="form-control text-capitalize">
              </div>
            </div>

            <h5>Data Part</h5>
            <hr>

            <div class="form-row">
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold" for="partid">Jenis Part</label>
                <select name="partid" id="partid" class="form-control selectpart" style="width:100%">
                  <option value=""></option>
                </select>
                <input type="hidden" name="jenispart" id="jenispart" value="" class="form-control" required readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="merk">Merk Part</label>
                <input type="text" name="merk" id="merk" value="" class="form-control" readonly>
                <input type="hidden" name="merkid" id="merkid" value="" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="sat">Satuan</label>
                <input type="text" name="sat" id="sat" value="" class="form-control" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="jml">Jumlah Part</label>
                <input type="number" name="jml" id="jml" value="" class="form-control" step="0.01" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="statuspart">Status Part</label>
                <select name="statuspart" id="statuspart" class="form-control selectstatus" style="width:100%" disabled="true">
                  <option value=""></option>
                  <option value="Baru">Baru</option>
                  <option value="Bekas">Bekas</option>
                </select>
                <input type="hidden" name="baru" id="baru" value="" class="form-control" readonly>
                <input type="hidden" name="bekas" id="bekas" value="" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold" for="ket">Keterangan</label>
                <input type="text" name="ket" id="ket" value="" class="form-control text-capitalize" required readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-12 col-md-12">
                <button type="button" class="btn btn-secondary btn-block" id="tambah" disabled>
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5 class="text-dark">Data Pemakaian</h5>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered table-responsive" id="cart" width="100%">
                  <thead class="text-center" class="font-weight-bold">
                    <tr>
                      <th width="25%">Part</th>
                      <th width="25%">Merk</th>
                      <th width="25%">Status</th>
                      <th width="25%">Jumlah</th>
                      <th width="15%">Sat</th>
                      <th width="15%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="3">
                        <h5 class="font-weight-bold">Total Pemakaian : </h5>
                      </td>
                      <td colspan="2">
                        <h5 class="font-weight-bold text-danger" id="totalpart"></h5>
                      </td>
                      <td>
                        <input type="hidden" name="totalpart_hidden" value="">
                        <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="Simpan">
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

<script src="<?= base_url('public/') ?>js/sb-admin-2.min.js"></script>

<script src="<?= base_url('public/') ?>js/pages/trans/part/pakai/add.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>