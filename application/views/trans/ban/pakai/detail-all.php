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
              <i class="fas fa-file fa-sm"></i>
              Export
            </button>
            <a href="<?= base_url('pakai_ban') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="allPakaiBanTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Kd Pakai</th>
                  <th class="align-middle">Truck</th>
                  <th class="align-middle">Seri</th>
                  <th class="align-middle">Merk</th>
                  <th class="align-middle">Ukuran</th>
                  <th class="align-middle">Jumlah</th>
                  <th class="align-middle">Status</th>
                  <th class="align-middle">Ket</th>
                  <th class="align-middle">Tanggal</th>
                  <th class="align-middle">Actions</th>
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

<!-- print all -->
<div class="modal fade p-0" id="printall" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h4 class="modal-title test-dark font-weight-bold" id="retur">Export Detail Pemakaian</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px">
        <form action="<?= base_url('pakai_ban/printAll') ?>" target="_blank" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="text-dark font-weight-bold" for="truck">Pilih Truck</label>
              <select name="truck" id="truck" class="form-control selecttruck" style="width:100%">
                <option value=""></option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="text-dark font-weight-bold" for="bulan">Pilih Bulan</label>
              <input type="month" class="form-control" name="bulan" id="bulan">
            </div>
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-block btn-primary">PDF</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>