<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#printall">
              <i class="fas fa-print fa-sm"></i>
              Print
            </button>
            <a href="<?= base_url('beli') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="allBeliPartTables" width="100%" cellspacing="0">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">D.O</th>
                  <th scope="col">Toko</th>
                  <th scope="col">Part</th>
                  <th scope="col">Jml</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Sub</th>
                  <th scope="col">Tgl</th>
                  <th scope="col">Ket</th>
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

<!-- retur part -->
<div class="modal fade" id="returpart" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h4 class="modal-title" id="retur">Form Retur Stok Masuk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <small class="text-warning font-weight-bold">Jumlah yang dapat di retur minimal 1, dan maksimal sejumlah item yang di beli</small>
        <hr>
        <form id="form_returPart">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="kd">No D.O</label>
              <input type="text" class="form-control text-uppercase" name="kd" id="kd" readonly>
              <input type="hidden" class="form-control" name="id" id="id">
            </div>
            <div class="form-group col-md-6">
              <label for="toko">Toko</label>
              <input type="text" class="form-control text-uppercase" name="toko" id="toko" readonly>
              <input type="hidden" class="form-control" name="tokoid" id="tokoid">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="part">Jenis Part, Merk, Status</label>
              <input type="text" class="form-control text-uppercase" name="part" id="part" readonly>
              <input type="hidden" class="form-control" name="partid" id="partid">
              <input type="hidden" class="form-control" name="merkid" id="merkid">
              <input type="hidden" class="form-control" name="statretur" id="statretur">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="jmlbeli">Jml di Retur</label>
              <input type="number" class="form-control" name="jmlbeli" id="jmlbeli">
            </div>
            <div class="form-group col-md-3">
              <label for="sat">Satuan</label>
              <input type="text" class="form-control text-uppercase" name="sat" id="sat" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="hrgpcs">Harga/pcs</label>
              <input type="text" class="form-control" name="hrgpcs" id="hrgpcs" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="diskon">Diskon</label>
              <input type="text" class="form-control" name="diskon" id="diskon" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="subtotal">Harga Total</label>
              <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
            </div>
            <div class="form-group col-md-12">
              <label for="ket">Alasan Retur</label>
              <input type="text" class="form-control text-capitalize" name="ket" id="ket" required autofocus oninvalid="this.setCustomValidity('Alasan wajib diisi !')" oninput="setCustomValidity('')">
            </div>
          </div>
          <button type="submit" class="btn btn-block btn-danger mt-3">Retur</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- print all -->
<div class="modal fade" id="printall" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h4 class="modal-title" id="retur">Print Detail Pembelian</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('beli/printAll') ?>" target="_blank" method="POST">
          <div class="form-group">
            <label for="bulan">Pilih Bulan</label>
            <input type="month" class="form-control" name="bulan" id="bulan">
          </div>
          <button type="submit" class="btn btn-block btn-primary mt-3">Print</button>
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

<script src="<?= base_url('public/') ?>js/pages/main/format.js"></script>

<script src="<?= base_url('public/') ?>js/pages/trans/part/beli/all.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>