<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('stok') ?>" class="btn btn-sm btn-dark">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md">
              <p class="mb-2 font-weight-bold">Menampilkan data transaksi terakhir dari sparepart <strong><?= ucwords($stok->jenis_part) ?></strong></p>
              <ul class="timeline">
                <?php foreach ($history as $history) : ?>
                  <?php
                  $a = $history->kd_history_part;
                  $b = substr($a, 0, 3);

                  if ($b == "trm") { ?>
                    <li>
                      <p class="font-weight-bold text-primary"><?= strtoupper($history->kd_history_part) ?>
                        <span class="float-right"><?= date("d-F-Y H:i:s", strtotime($history->tgl_part_history)) ?></span>
                      </p>
                      <p><?= $history->ket_history_part ?></p>
                      <p class="text-capitalize"><?= $history->ket_trans_part ?></p>
                      <hr>
                    </li>
                  <?php } elseif ($b == "trk") { ?>
                    <li>
                      <p class="font-weight-bold text-success"><?= strtoupper($history->kd_history_part) ?>
                        <span class="float-right"><?= date("d-F-Y H:i:s", strtotime($history->tgl_part_history)) ?></span>
                      </p>
                      <p><?= $history->ket_history_part ?></p>
                      <p class="text-capitalize"><?= $history->ket_trans_part ?></p>
                      <hr>
                    </li>
                  <?php } elseif ($b == "opr") { ?>
                    <li>
                      <p class="font-weight-bold text-warning"><?= strtoupper($history->kd_history_part) ?>
                        <span class="float-right"><?= date("d-F-Y H:i:s", strtotime($history->tgl_part_history)) ?></span>
                      </p>
                      <p><?= $history->ket_history_part ?></p>
                      <p class="text-capitalize"><?= $history->ket_trans_part ?></p>
                      <hr>
                    </li>
                  <?php } else { ?>
                    <li>
                      <p class="font-weight-bold text-danger"><?= strtoupper($history->kd_history_part) ?>
                        <span class="float-right"><?= date("d-F-Y H:i:s", strtotime($history->tgl_part_history)) ?></span>
                      </p>
                      <p><?= $history->ket_history_part ?></p>
                      <p class="text-capitalize"><?= $history->ket_trans_part ?></p>
                      <hr>
                    </li>
                  <?php } ?>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md">
              <?= $this->pagination->create_links(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>