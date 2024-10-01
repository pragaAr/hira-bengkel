<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('repair') ?>" class="btn btn-sm btn-dark mb-2">
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
          <form action="<?= base_url('repair/proses') ?>" id="form-tambah" method="POST">
            <div class="form-row">
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="kd">Kd Repair</label>
                <input type="text" name="kd" id="kd" class="form-control text-uppercase" value="<?= $kd ?>" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="tokoid">Tempat Repair</label>
                <div class="input-group">
                  <select name="tokoid" id="tokoid" class="form-control selecttoko" required>
                    <option value=""></option>

                  </select>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-secondary btn-add-toko" data-toggle="modal" data-target="#modal-addnew-toko">
                      <i class="fas fa-plus fa-sm"></i>
                    </button>
                  </div>
                </div>
                <input type="hidden" name="toko" id="toko" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="tgl">Tanggal</label>
                <input type="text" name="tgl" id="tgl" class="form-control" value="<?= date('d-m-Y') ?>" readonly>
              </div>
            </div>

            <h5>Data Part</h5>
            <hr>

            <div class="form-row">
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold" for="partid">Jenis Part</label>
                <select name="partid" id="partid" class="form-control selectpart">
                  <option value=""></option>

                </select>
                <input type="hidden" name="partname" id="partname" class="form-control" required readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="merk">Merk</label>
                <input type="text" name="merk" id="merk" class="form-control" readonly>
                <input type="hidden" name="merkid" id="merkid" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="sat">Satuan</label>
                <input type="text" name="sat" id="sat" class="form-control" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-2 col-md-2">
                <label class="font-weight-bold" for="jml">Jumlah</label>
                <input type="number" name="jml" id="jml" class="form-control" required readonly>
              </div>
              <div class="form-group col-lg-2 col-md-2">
                <label class="font-weight-bold" for="statpart">Status</label>
                <select name="statpart" id="statpart" class="form-control selectstatpart" disabled="true">
                  <option value=""></option>
                  <option value="Baru">Baru</option>
                  <option value="Bekas">Bekas</option>
                </select>
                <input type="hidden" name="baru" id="baru" class="form-control" readonly>
                <input type="hidden" name="bekas" id="bekas" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold" for="ket">Keterangan</label>
                <input type="text" name="ket" id="ket" class="form-control text-capitalize" required readonly>
              </div>
              <div class="form-group col-lg-2 col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-secondary btn-block mt-4" id="tambah" style="border: 1px solid white; height:calc(1.5em + 0.75rem + 2px);" disabled>
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5>Data Repair</h5>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered" id="cart" width="100%">
                  <thead class="text-center">
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
                        <h5 class="font-weight-bold">Total Repair : </h5>
                      </td>
                      <td colspan="2">
                        <h5 class="font-weight-bold text-danger" id="totalpart"></h5>
                      </td>
                      <td>
                        <input type="hidden" name="totalpart_hidden" value="">
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Simpan" style="border: 1px solid white;">
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

<!-- add Toko -->
<div class="modal fade" id="modal-addnew-toko" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="modal-addnew-toko">Tambah Data Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg">
              <div class="form-group">
                <label class="font-weight-bold" for="namatoko">Nama Toko</label>
                <input type="text" class="form-control text-uppercase" name="namatoko" id="namatoko" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Toko wajib diisi!')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label class="font-weight-bold" for="telptoko">Telp Toko</label>
                <input type="text" class="form-control text-uppercase" name="telptoko" id="telptoko" autocomplete="off">
              </div>
              <div class="form-group text-right">
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="border: 1px solid white">Batal</button>
                <button type="submit" id="btn-submit-toko" class="btn btn-primary" style="border: 1px solid white">Tambah</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
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

<script src="<?= base_url('public/') ?>js/pages/trans/part/repair/add.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>