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
            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#cetakDo">
              <i class="fas fa-print fa-sm"></i>
              Print DO
            </a>
            <a href="<?= base_url('vulkanisir/allDetailVulk') ?>" class="btn btn-warning">
              <i class="fas fa-file-alt fa-sm"></i>
              All Data
            </a>
            <a href="<?= base_url('vulkanisir/allDetailVulkDone') ?>" class="btn btn-secondary">
              <i class="fas fa-file-alt fa-sm"></i>
              All Data Done
            </a>
            <a href="<?= base_url('vulkanisir/selesai') ?>" class="btn btn-success">
              <i class="fas fa-check-circle fa-sm"></i>
              Done
            </a>
            <a href="<?= base_url('vulkanisir/addData') ?>" class="btn btn-dark">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="vulkBanTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Kd Vulk</th>
                  <th class="align-middle">Tempat Vulk</th>
                  <th class="align-middle">Qty</th>
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

<!-- cetakDoModal -->
<div class="modal fade p-0" id="cetakDo" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Cetak DO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <form action="<?= base_url('vulkanisir/printDo') ?>" method="POST" target="_blank">
        <div class="modal-body" style="font-size:13px">
          <div class="form-group col-md-12">
            <label class="text-dark font-weight-bold" for="id">Pilih Nota</label>
            <select name="id" id="id" class="form-control selectnota" required>
              <option value=""></option>

            </select>
            <input type="hidden" name="nota" id="nota" class="form-control" readonly>
          </div>
          <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary btn-block" id="buttonCetakDo">Cetak</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- detailModal -->
<div class="modal fade p-0" id="detailVulk" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold" id="titledetail"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px">
        <div class="d-flex justify-content-between align-items-center font-weight-bold">
          <p class="text-dark font-weight-bold" id="detailtempat"></p>
          <p class="text-dark font-weight-bold" id="detailtgl"></p>
        </div>
        <hr>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="thead-dark text-center">
              <tr>
                <th class="align-middle">Seri</th>
                <th class="align-middle">Merk</th>
                <th class="align-middle">Ukuran</th>
                <th class="align-middle">Status</th>
              </tr>
            </thead>
            <tbody class="text-center" id="tbodyDetail">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>