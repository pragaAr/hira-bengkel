<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('percab') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px;">
          <div class="row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-between align-items-center flex-wrap">
              <p><span class="text-dark font-weight-bold">No. Surat</span> : <?= strtoupper($percab->nosurat) ?></p>
              <p><span class="text-dark font-weight-bold">Tgl Surat</span> : <?= date('d-m-Y', strtotime($percab->tglsurat)) ?></p>
              <p><span class="text-dark font-weight-bold">Cabang</span> : <?= strtoupper($percab->cabang) ?></p>
            </div>
          </div>
          <hr>
          <div class="row mt-4">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th class="align-middle">No</th>
                      <th class="align-middle">Truck</th>
                      <th class="align-middle">Sopir</th>
                      <th class="align-middle">Bengkel</th>
                      <th class="align-middle">Tgl Nota</th>
                      <th class="align-middle">Part</th>
                      <th class="align-middle">Keterangan</th>
                      <th class="align-middle">Ongkos</th>
                    </tr>
                  </thead>
                  <tbody style="font-size:13px">
                    <?php $i = 1;
                    foreach ($detail as $data) : ?>
                      <tr class="text-center">
                        <td class="align-middle"><?= $i ?>.</td>
                        <td class="align-middle"><?= strtoupper($data->plat_no_truck) ?></td>
                        <td class="align-middle"><?= ucwords($data->sopir) ?></td>
                        <td class="align-middle"><?= ucwords($data->bengkel) ?> </td>
                        <td class="align-middle"><?= date('d-m-Y', strtotime($data->tglnota)) ?></td>
                        <td class="align-middle"><?= ucwords($data->part) ?> </td>
                        <td class="align-middle"><?= ucwords($data->ketpercab) ?> </td>
                        <td class="align-middle text-right">Rp <?= number_format($data->ongkos) ?></td>
                      </tr>
                      <?php $i++; ?>
                    <?php endforeach ?>
                    <tr>
                      <td class="align-middle" colspan="6">
                        <h6 class="font-weight-bold text-danger text-center">Biaya : </h6>
                      </td>
                      <td class="align-middle" colspan="2">
                        <h6 class="font-weight-bold text-danger text-right">Rp. <?= number_format($percab->totalbyr) ?></h6>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>