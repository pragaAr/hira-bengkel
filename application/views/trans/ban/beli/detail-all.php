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
            <a href="<?= base_url('beli_ban') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>
        </div>
        <div class="card-body" style="font-size:13px">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="allBeliBanTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">D.O</th>
                  <th class="align-middle">Toko</th>
                  <th class="align-middle">Seri/Merk</th>
                  <th class="align-middle">Uk</th>
                  <th class="align-middle">Stat</th>
                  <th class="align-middle">Qty</th>
                  <th class="align-middle">Harga</th>
                  <th class="align-middle">Disk</th>
                  <th class="align-middle">Sub</th>
                  <th class="align-middle">In</th>
                  <th class="align-middle">Ket</th>
                  <th class="align-middle">Action</th>
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

<!-- Modal Retur Ban -->
<div class="modal fade p-0" id="returban" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bold text-dark">Retur Pembelian Ban</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px">
        <p class="text-danger font-weight-bold">Jumlah yang dapat di retur minimal 1, dan maksimal sejumlah item yang di beli</p>
        <hr>
        <form id="form_returban">
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="kd">No D.O</label>
              <input type="text" class="form-control text-uppercase" name="kd" id="kd" readonly>
              <input type="hidden" class="form-control" name="id" id="id" readonly>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="toko">Toko</label>
              <input type="text" class="form-control text-uppercase" name="toko" id="toko" readonly>
              <input type="hidden" class="form-control" name="tokoid" id="tokoid">
              <input type="hidden" class="form-control" name="merkid" id="merkid">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="noseri">No Seri</label>
              <input type="text" class="form-control" name="noseri" id="noseri" readonly>
              <input type="hidden" class="form-control" name="statretur" id="statretur">
              <input type="hidden" class="form-control" name="ukuran" id="ukuran">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="jmlbeli">Jumlah</label>
              <input type="number" class="form-control" name="jmlbeli" id="jmlbeli">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="hrgpcs">Harga</label>
              <input type="text" class="form-control" name="hrgpcs" id="hrgpcs" readonly>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="diskon">Diskon</label>
              <input type="text" class="form-control" name="diskon" id="diskon" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="subtotal">Sub Total</label>
              <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="ket">Alasan Retur</label>
              <input type="text" class="form-control text-capitalize" name="ket" id="ket" required autofocus oninvalid="this.setCustomValidity('Alasan nya apa ?')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-12">
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
        <h4 class="modal-title text-dark font-weight-bold" id="retur">Print Detail Pembelian</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('beli_ban/printAll') ?>" target="_blank" method="POST">
          <div class="form-group">
            <label class="text-dark fontweight-bold" for="bulan">Pilih Bulan</label>
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