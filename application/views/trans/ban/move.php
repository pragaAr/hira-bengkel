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
            <a href="<?= base_url('ban') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="moveTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle" style="width:5%;">No</th>
                  <th class="align-middle">Seri</th>
                  <th class="align-middle">Merk</th>
                  <th class="align-middle">Ukuran</th>
                  <th class="align-middle">Keterangan</th>
                  <th class="align-middle">Tanggal</th>
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