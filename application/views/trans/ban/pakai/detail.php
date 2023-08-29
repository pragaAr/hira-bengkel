<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('pakai_ban') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <p class="text-danger font-weight-bold mb-3">
            <em>--Kd Pakai : <?= strtoupper($kdpakai->kd_pakai_ban) ?>--</em>
          </p>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-borderless" width="100%">
                <tr>
                  <td><strong>Truck</strong></td>
                  <td>:</td>
                  <td><?= $kdpakai->plat_no_truck ?>, <?= $kdpakai->merk_truck ?> <?= $kdpakai->jenis_truck ?></td>
                  <td><strong>Nama Petugas</strong></td>
                  <td>:</td>
                  <td><?= $kdpakai->username ?></td>
                </tr>
                <tr>
                  <td><strong>Nama Montir</strong></td>
                  <td>:</td>
                  <td class="text-capitalize"><?= $kdpakai->nama_montir_ban ?></td>
                  <td><strong>Tanggal Keluar</strong></td>
                  <td>:</td>
                  <td><?= date('d-m-Y', strtotime($kdpakai->tgl_pakai_ban)) ?></td>
                </tr>
              </table>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                  <thead class="text-center">
                    <tr>
                      <th style="width:5%;"><strong>No</strong></th>
                      <th><strong>No Seri/Merk</strong></th>
                      <th><strong>Status</strong></th>
                      <th><strong>Qty</strong></th>
                      <th><strong>Status Pakai</strong></th>
                      <th><strong>Ket</strong></th>
                    </tr>
                  </thead>
                  <tbody class="text-center" style="font-size:13px;">
                    <?php $i = 1;
                    foreach ($detail as $all) : ?>
                      <tr>
                        <td><?= $i ?>.</td>
                        <td><?= $all->no_seri ?>, <?= $all->nama_merk ?></td>
                        <td><?= $all->status_ban_pakai ?></td>
                        <td><?= $all->jml_pakai_ban ?> pcs</td>
                        <?php if ($all->jml_pakai_ban == 0) { ?>
                          <td>
                            Di oper
                          </td>
                        <?php } else { ?>
                          <td>
                            <?= $all->status_pakai_ban ?>
                          </td>
                        <?php } ?>
                        <?php if ($all->ket_pakai_ban == '') { ?>
                          <td>
                            <i class="fas fa-minus"></i>
                          </td>
                        <?php } else { ?>
                          <td class="text-capitalize">
                            <?= $all->ket_pakai_ban ?>
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