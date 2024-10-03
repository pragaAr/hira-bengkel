<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('vulkanisir') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="detailAllDoneTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Kd Vulk</th>
                  <th class="align-middle">Tempat</th>
                  <th class="align-middle">Nota</th>
                  <th class="align-middle">Seri/Merk/Uk</th>
                  <th class="align-middle">Ongkos</th>
                  <th class="align-middle">Selesai</th>
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