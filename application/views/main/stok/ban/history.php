<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('ban') ?>" class="btn btn-sm btn-dark">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <p class="mb-4 font-weight-bold">Menampilkan data transaksi terakhir dari ban dengan No Seri :
                <strong>
                  <?php if (empty($ban->no_seri)) { ?>
                    <?= $this->uri->segment('3') ?>
                  <?php } else { ?>
                    <?= strtoupper($ban->no_seri) ?>
                  <?php } ?>
                </strong>
              </p>
              <hr>
              <ul class="timeline">
                <?php foreach ($history as $history) : ?>
                  <?php
                  $a = $history->kd_history_ban;
                  $b = substr($a, 0, 3);
                  if ($b == "tbn") { ?>
                    <li>
                      <p class="font-weight-bold text-primary"><?= strtoupper($history->kd_history_ban) ?>
                        <span class="float-right"><?= date('d-m-Y H:i:s', strtotime($history->tgl_add_history)) ?></span>
                      </p>
                      <p class="text-capitalize"><?= $history->ket_history ?></p>
                      <p class="text-capitalize"><?= $history->ket_trans ?></p>
                    </li>
                    <hr>
                  <?php } elseif ($b == "tbk") { ?>
                    <li>
                      <p class="font-weight-bold text-success"><?= strtoupper($history->kd_history_ban) ?>
                        <span class="float-right"><?= date('d-m-Y H:i:s', strtotime($history->tgl_add_history)) ?></span>
                      </p>
                      <p class="text-capitalize"><?= $history->ket_history ?></p>
                      <p class="text-capitalize"><?= $history->ket_trans ?></p>
                    </li>
                    <hr>
                  <?php } elseif ($b == "opr") { ?>
                    <li>
                      <p class="font-weight-bold text-warning"><?= strtoupper($history->kd_history_ban) ?>
                        <span class="float-right"><?= date('d-m-Y H:i:s', strtotime($history->tgl_add_history)) ?></span>
                      </p>
                      <p class="text-capitalize"><?= $history->ket_history ?></p>
                      <p class="text-capitalize"><?= $history->ket_trans ?></p>
                    </li>
                    <hr>
                  <?php } else { ?>
                    <li>
                      <p class="font-weight-bold text-danger"><?= strtoupper($history->kd_history_ban) ?>
                        <span class="float-right"><?= date('d-m-Y H:i:s', strtotime($history->tgl_add_history)) ?></span>
                      </p>
                      <p class="text-capitalize"><?= $history->ket_history ?></p>
                      <p class="text-capitalize"><?= $history->ket_trans ?></p>
                    </li>
                    <hr>
                  <?php } ?>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>