<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#printall">
              <i class="fas fa-print fa-sm"></i>
              Print
            </button>
            <a href="<?= base_url('beli') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="allBeliPartTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">D.O</th>
                  <th class="align-middle">Toko</th>
                  <th class="align-middle">Part</th>
                  <th class="align-middle">Jml</th>
                  <th class="align-middle">Harga</th>
                  <th class="align-middle">Sub</th>
                  <th class="align-middle">Tgl</th>
                  <th class="align-middle">Ket</th>
                  <th class="align-middle">Aksi</th>
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

<!-- retur part -->
<div class="modal fade p-0" id="returpart" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h4 class="modal-title text-dark font-weight-bold" id="retur">Retur Stok Masuk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px">
        <p class="text-danger font-weight-bold">Jumlah yang dapat di retur minimal 1, dan maksimal sejumlah item yang di beli</p>
        <hr>
        <form id="form_returPart">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="font-weight-bold text-dark" for="kd">No D.O</label>
              <input type="text" class="form-control text-uppercase" name="kd" id="kd" readonly>
              <input type="hidden" class="form-control" name="id" id="id">
            </div>
            <div class="form-group col-md-6">
              <label class="font-weight-bold text-dark" for="toko">Toko</label>
              <input type="text" class="form-control text-uppercase" name="toko" id="toko" readonly>
              <input type="hidden" class="form-control" name="tokoid" id="tokoid">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="font-weight-bold text-dark" for="part">Jenis Part, Merk, Status</label>
              <input type="text" class="form-control text-uppercase" name="part" id="part" readonly>
              <input type="hidden" class="form-control" name="partid" id="partid">
              <input type="hidden" class="form-control" name="merkid" id="merkid">
              <input type="hidden" class="form-control" name="statretur" id="statretur">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label class="font-weight-bold text-dark" for="jmlbeli">Jml di Retur</label>
              <input type="number" class="form-control" name="jmlbeli" id="jmlbeli">
            </div>
            <div class="form-group col-md-3">
              <label class="font-weight-bold text-dark" for="sat">Satuan</label>
              <input type="text" class="form-control text-uppercase" name="sat" id="sat" readonly>
            </div>
            <div class="form-group col-md-6">
              <label class="font-weight-bold text-dark" for="hrgpcs">Harga/pcs</label>
              <input type="text" class="form-control" name="hrgpcs" id="hrgpcs" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="font-weight-bold text-dark" for="diskon">Diskon</label>
              <input type="text" class="form-control" name="diskon" id="diskon" readonly>
            </div>
            <div class="form-group col-md-6">
              <label class="font-weight-bold text-dark" for="subtotal">Harga Total</label>
              <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
            </div>
            <div class="form-group col-md-12">
              <label class="font-weight-bold text-dark" for="ket">Alasan Retur</label>
              <input type="text" class="form-control text-capitalize" name="ket" id="ket" required autofocus oninvalid="this.setCustomValidity('Alasan wajib diisi !')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-block btn-danger">Retur</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- print all -->
<div class="modal fade p-0" id="printall" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bold text-dark" id="retur">Print Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px">
        <form action="<?= base_url('beli/printAll') ?>" target="_blank" method="POST">
          <div class="form-group">
            <label class="font-weight-bold text-dark" for="toko">Pilih Toko</label>
            <select name="toko" id="toko" class="form-control selecttoko" style="width:100%">
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label class="font-weight-bold text-dark" for="bulan">Pilih Bulan</label>
            <input type="month" class="form-control" name="bulan" id="bulan">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">Print</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>