<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a target="_blank" href="<?= base_url('repair/print/') .  $rep->kd_repair ?>" class="btn btn-sm btn-primary mb-2">
              <i class="fas fa-print fa-sm"></i>
              Print
            </a>
            <a href="<?= base_url('repair') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <p class="text-danger font-weight-bold mb-3">
            <em>--Kd Repair : <?= strtoupper($rep->kd_repair) ?>--</em>
          </p>
          <div class="row">
            <div class="col-md">
              <table class="table table-borderless" width="100%">
                <tr>
                  <td>Petugas :</td>
                  <td><?= ucwords($rep->nama_user) ?></td>
                  <td>Tempat :</td>
                  <td><?= strtoupper($rep->nama_toko) ?></td>
                  <td>Tanggal :</td>
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
                  <thead class="text-center">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Jenis</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Ket</th>
                    </tr>
                  </thead>
                  <tbody style="font-size:13px">
                    <?php $i = 1;
                    foreach ($detail as $all) : ?>
                      <tr>
                        <td class="text-center"><?= $i ?>.</td>
                        <td><?= strtoupper($all->jenis_part) ?>, <?= strtoupper($all->nama_merk) ?></td>
                        <td class="text-center"><?= $all->jml_repair ?> <?= ucwords($all->sat) ?></td>
                        <?php if ($all->ket_repair == '') { ?>
                          <td>
                            <i class="fas fa-minus fa-sm"></i>
                          </td>
                        <?php } else { ?>
                          <td class="text-capitalize">
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