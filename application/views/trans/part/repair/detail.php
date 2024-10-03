<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a target="_blank" href="<?= base_url('repair/print/') .  $rep->kd_repair ?>" class="btn btn-primary mb-2">
              <i class="fas fa-print fa-sm"></i>
              Print
            </a>
            <a href="<?= base_url('repair') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <p class="text-danger font-weight-bold mb-3">
            <em>--Kd Repair : <?= strtoupper($rep->kd_repair) ?>--</em>
          </p>
          <div class="row">
            <div class="col-md">
              <table class="table table-borderless" width="100%">
                <tr>
                  <td class="text-dark font-weight-bold">Petugas :</td>
                  <td><?= ucwords($rep->nama_user) ?></td>
                  <td class="text-dark font-weight-bold">Tempat :</td>
                  <td><?= strtoupper($rep->nama_toko) ?></td>
                  <td class="text-dark font-weight-bold">Tanggal :</td>
                  <td><?= date('d-m-Y', strtotime($rep->tgl_repair)) ?></td>
                </tr>
              </table>
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
                      <th class="align-middle">Jenis</th>
                      <th class="align-middle">Qty</th>
                      <th class="align-middle">Ket</th>
                    </tr>
                  </thead>
                  <tbody style="font-size:13px">
                    <?php $i = 1;
                    foreach ($detail as $all) : ?>
                      <tr>
                        <td class="text-center align-middle"><?= $i ?>.</td>
                        <td class="align-middle"><?= strtoupper($all->jenis_part) ?>, <?= strtoupper($all->nama_merk) ?></td>
                        <td class="text-center align-middle"><?= $all->jml_repair ?> <?= ucwords($all->sat) ?></td>
                        <?php if ($all->ket_repair == '') { ?>
                          <td class="align-middle">
                            <i class="fas fa-minus fa-sm"></i>
                          </td>
                        <?php } else { ?>
                          <td class="text-capitalize align-middle">
                            <?= $all->ket_repair ?>
                          </td>
                        <?php } ?>
                      </tr>
                      <?php $i++; ?>
                    <?php endforeach ?>
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