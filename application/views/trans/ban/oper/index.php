<div class="container-fluid">
  <div class="success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('oper_ban/allDataPakai') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="operBanTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Kd Oper</th>
                  <th class="align-middle">Kd Pakai</th>
                  <th class="align-middle">Seri</th>
                  <th class="align-middle">Asal</th>
                  <th class="align-middle">Oper</th>
                  <th class="align-middle">Qty</th>
                  <th class="align-middle">Montir</th>
                  <th class="align-middle">Status</th>
                  <th class="align-middle">Tgl</th>
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

<!-- operLagiModal -->
<div class="modal fade p-0" id="operLagiModal" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title">Operan Ban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px">
        <p class="font-weight-bold text-dark" id="subtitle"></p>
        <small class="font-weight-bold text-danger">--Jumlah yang dioper tidak bisa melebihi jumlah yang dipakai</small>
        <hr>
        <form id="form_operLagi">

          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="seri">No Seri Ban</label>
              <input type="hidden" class="form-control" id="dari" name="dari" readonly>
              <input type="hidden" class="form-control" id="daritruck" name="daritruck" readonly>
              <input type="hidden" class="form-control" id="kdoper" name="kdoper" readonly>
              <input type="hidden" class="form-control" id="banid" name="banid" readonly>
              <input type="hidden" class="form-control" id="pakaiid" name="pakaiid" readonly>
              <input type=" text" class="form-control" id="seri" name="seri" readonly>
            </div>
            <div class=" form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="merk">Merk Ban</label>
              <input type="hidden" class="form-control" id="merkid" name="merkid" readonly>
              <input type="text" class="form-control" id="merk" name="merk" readonly>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="jmlban">Jumlah Pakai</label>
              <input type="number" class="form-control" id="jmlban" name="jmlban" readonly required>
            </div>
            <div class=" form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="tujuanid">Oper Ke</label>
              <select name="tujuanid" id="tujuanid" class="form-control selecttruck" required>
                <option value=""></option>

              </select>
              <input type="hidden" name="tujuan" id="tujuan" class="form-control" readonly>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="montir">Nama Montir</label>
              <input type="text" class="form-control text-capitalize" id="montir" name="montir" required oninvalid="this.setCustomValidity('Montir nya siapa ?')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="ket">Keterangan Oper</label>
              <input type="text" class="form-control text-capitalize" id="ket" name="ket" required oninvalid="this.setCustomValidity('Di Oper karena apa ?')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-primary btn-block">Oper</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>