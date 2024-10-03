<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('oper') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <p class="text-danger font-weight-bold mb-3">
            <em>--Kd Oper : <?= strtoupper($kd) ?>--</em>
          </p>
          <div class="row">
            <div class="col-md">
              <table class="table table-borderless" width="100%">
                <tr>
                  <td class="text-dark font-weight-bold">Truck Asal</td>
                  <td>:</td>
                  <td><?= strtoupper($oper->asal) ?>, <?= $oper->merkasal ?></td>
                  <td class="text-dark font-weight-bold">Truck Oper</td>
                  <td>:</td>
                  <td><?= strtoupper($oper->tujuan) ?>, <?= $oper->merktujuan ?></td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Tanggal Oper</td>
                  <td>:</td>
                  <td><?= date('d-m-Y', strtotime($oper->tgl_oper)) ?></td>
                  <td class="text-dark font-weight-bold">Status Oper</td>
                  <td>:</td>
                  <?php if ($oper->status_oper == 'Belum dikembalikan') { ?>
                    <td class="font-weight-bold text-danger"> <?= $oper->status_oper; ?></td>
                  <?php } else { ?>
                    <td class="font-weight-bold text-success"> <?= $oper->status_oper; ?></td>
                  <?php } ?>
                </tr>
              </table>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th class="align-middle">No</th>
                      <th class="align-middle">Jenis Part</th>
                      <th class="align-middle">Qty</th>
                      <th class="align-middle">Montir</th>
                      <th class="align-middle">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody class="text-center" style="font-size:13px">
                    <tr>
                      <?php $no = 1; ?>
                      <td class="align-middle"><?= $no++ ?>.</td>
                      <td class="align-middle"><?= strtoupper($oper->part) ?>, <?= strtoupper($oper->merk) ?></td>
                      <td class="align-middle"><?= $oper->jml_oper ?> <?= ucwords($oper->sat) ?></td>
                      <td class="align-middle"><?= ucwords($oper->nama_montir_oper) ?></td>
                      <td class="align-middle"><?= ucwords($oper->ket_oper) ?></td>
                    </tr>
                  </tbody>
                  <tfoot>
                  </tfoot>
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