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
            <a href="<?= base_url('oper/allDataPakai') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="operTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Kd Oper</th>
                  <th class="align-middle">Kd Pakai</th>
                  <th class="align-middle">Part</th>
                  <th class="align-middle">Asal</th>
                  <th class="align-middle">Oper</th>
                  <th class="align-middle">Qty</th>
                  <th class="align-middle">Montir</th>
                  <th class="align-middle">Status</th>
                  <th class="align-middle">Tanggal</th>
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

<!-- Modal Oper -->
<div class="modal fade p-0" id="operanModal" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Oper Part</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <p class="font-weight-bold text-dark" id="subtitle"></p>
        <small class="font-weight-bold text-danger">--Jumlah yang dioper tidak bisa melebihi jumlah yang dipakai</small>
        <hr>
        <form id="form_operLagi">
          <div class="form-row">
            <div class="form-group col-lg-4 col-md-4">
              <label class="font-weight-bold text-dark" for="part">Jenis</label>
              <input type="hidden" class="form-control" id="kdpakai" name="kdpakai" readonly>
              <input type="hidden" class="form-control" id="detailpakai_id" name="detailpakai_id" readonly>
              <input type="hidden" class="form-control" id="asal" name="asal" readonly>
              <input type="hidden" class="form-control" id="asalid" name="asalid" readonly>
              <input type="hidden" class="form-control" id="partid" name="partid" readonly>
              <input type="hidden" class="form-control" id="sat" name="sat" readonly>
              <input type="text" class="form-control text-uppercase" id="part" name="part" readonly>
            </div>
            <div class="form-group col-lg-4 col-md-4">
              <label class="font-weight-bold text-dark" for="merk">Merk</label>
              <input type="text" class="form-control" id="merk" name="merk" readonly>
              <input type="hidden" class="form-control text-uppercase" id="merkid" name="merkid" readonly>
            </div>
            <div class="form-group col-lg-4 col-md-4">
              <label class="font-weight-bold text-dark" for="jml">Jumlah Pakai</label>
              <input type="number" class="form-control" id="jml" name="jml" readonly required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="tujuanid">Oper Ke</label>
              <select name="tujuanid" id="tujuanid" class="form-control selecttruck" required>
                <option value=""></option>

              </select>
              <input type="hidden" class="form-control" id="tujuan" name="tujuan" readonly>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="jmloper">Jumlah Oper</label>
              <input type="number" class="form-control" id="jmloper" name="jmloper" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="montir">Montir</label>
              <input type="text" class="form-control text-uppercase" id="montir" name="montir" required>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="ket">Keterangan</label>
              <input type="text" class="form-control text-uppercase" id="ket" name="ket" required>
            </div>
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary btn-block">Oper Lagi</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>