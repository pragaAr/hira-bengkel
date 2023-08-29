<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a target="_blank" href="<?= base_url('stok/print') ?>" class="btn btn-sm btn-primary">
              <i class="fas fa-print fa-sm"></i>
              Print
            </a>
            <button type="button" class="btn btn-sm btn-dark" id="btn-add-stok">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </button>
          </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="stokTables" width="100%" cellspacing="0">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Merk</th>
                  <th scope="col">Sat</th>
                  <th scope="col">Baru</th>
                  <th scope="col">Bks</th>
                  <th scope="col">Jml</th>
                  <th scope="col">Rak</th>
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

<!-- add Stok -->
<div class="modal fade" id="addStok" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Form Tambah Stok Part</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_addStok">
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label for="nama">Nama Sparepart</label>
              <input type="text" class="form-control text-uppercase" name="nama" id="nama" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Sparepart wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="merk">Merk</label>
              <select name="merk" id="merk" class="form-control selectmerk" style="width:100%;" required oninvalid="this.setCustomValidity('Merk wajib di isi!')" oninput="setCustomValidity('')">
                <option value=""></option>
              </select>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="baru">Part Baru</label>
              <input type="number" class="form-control" name="baru" id="baru" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Baru wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="bekas">Part Bekas</label>
              <input type="number" class="form-control" name="bekas" id="bekas" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Bekas wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="satuan">Satuan</label>
              <input type="text" class="form-control text-uppercase" name="satuan" id="satuan" autocomplete="off" required oninvalid="this.setCustomValidity('Satuan wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="rak">Rak</label>
              <input type="text" class="form-control text-uppercase" name="rak" id="rak" autocomplete="off" required oninvalid="this.setCustomValidity('Rak wajib diisi!')" oninput="setCustomValidity('')">
            </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit Stok -->
<div class="modal fade" id="editStok" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Edit Data Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_editStok">
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label for="namaedit">Nama Sparepart</label>
              <input type="hidden" class="form-control" name="idstok" id="idstok" readonly>
              <input type="text" class="form-control text-uppercase" name="namaedit" id="namaedit" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Sparepart wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="merkedit">Merk</label>
              <select name="merkedit" id="merkedit" class="form-control selectmerkedit" style="width:100%;" required oninvalid="this.setCustomValidity('Merk wajib di isi!')" oninput="setCustomValidity('')">
                <option value=""></option>
              </select>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="baruedit">Part Baru</label>
              <input type="number" class="form-control" name="baruedit" id="baruedit" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Baru wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="bekasedit">Part Bekas</label>
              <input type="number" class="form-control" name="bekasedit" id="bekasedit" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Bekas wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="satuanedit">Satuan</label>
              <input type="text" class="form-control text-uppercase" name="satuanedit" id="satuanedit" autocomplete="off" required oninvalid="this.setCustomValidity('Satuan wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="rakedit">Rak</label>
              <input type="text" class="form-control text-uppercase" name="rakedit" id="rakedit" autocomplete="off" required oninvalid="this.setCustomValidity('Rak wajib diisi!')" oninput="setCustomValidity('')">
            </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
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

<script src="<?= base_url('public/') ?>js/pages/main/stok/part/stok.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>