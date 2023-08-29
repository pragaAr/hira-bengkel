<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('percab') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-between align-items-center flex-wrap">
              <p><strong>No. Surat</strong> : <?= strtoupper($percab->nosurat) ?></p>
              <p><strong>Tanggal Surat</strong> : <?= date('d-m-Y', strtotime($percab->tglsurat)) ?></p>
              <p><strong>Cabang</strong> : <?= strtoupper($percab->cabang) ?></p>
            </div>
          </div>
          <hr>
          <div class="row mt-4">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                  <thead class="text-center">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Truck</th>
                      <th scope="col">Bengkel</th>
                      <th scope="col">Tgl Nota</th>
                      <th scope="col">Part</th>
                      <th scope="col">Ongkos</th>
                      <th scope="col">Ket</th>
                    </tr>
                  </thead>
                  <tbody style="font-size:13px">
                    <?php $i = 1;
                    foreach ($detail as $data) : ?>
                      <tr>
                        <td><?= $i ?>.</td>
                        <td><?= strtoupper($data->plat_no_truck) ?> - <?= ucwords($data->sopir) ?></td>
                        <td><?= ucwords($data->bengkel) ?> </td>
                        <td><?= date('d-m-Y', strtotime($data->tglnota)) ?></td>
                        <td><?= ucwords($data->part) ?> </td>
                        <td>Rp <?= number_format($data->ongkos) ?></td>
                        <td><?= ucwords($data->ketpercab) ?> </td>
                      </tr>
                      <?php $i++; ?>
                    <?php endforeach ?>
                    <tr>
                      <td colspan="5">
                        <h6 class="font-weight-bold text-danger">Total Bayar : </h6>
                      </td>
                      <td colspan="2">
                        <h6 class="font-weight-bold text-danger">Rp. <?= number_format($percab->totalbyr) ?></h6>
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