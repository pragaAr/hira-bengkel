<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('pakai_ban') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <p class="text-danger font-weight-bold mb-3">
            <em>--Kd Pakai : <?= strtoupper($kdpakai->kd_pakai_ban) ?>--</em>
          </p>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-borderless" width="100%">
                <tr>
                  <td class="text-dark font-weight-bold align-middle">Truck</td>
                  <td class="align-middle">:</td>
                  <td class="align-middle"><?= $kdpakai->plat_no_truck ?>, <?= $kdpakai->merk_truck ?> <?= $kdpakai->jenis_truck ?></td>
                  <td class="text-dark font-weight-bold align-middle">Nama Petugas</td>
                  <td class="align-middle">:</td>
                  <td class="align-middle"><?= $kdpakai->username ?></td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold align-middle">Nama Montir</td>
                  <td class="align-middle">:</td>
                  <td class="text-capitalize"><?= $kdpakai->nama_montir_ban ?></td>
                  <td class="text-dark font-weight-bold align-middle">Tanggal Keluar</td>
                  <td class="align-middle">:</td>
                  <td class="align-middle"><?= date('d-m-Y', strtotime($kdpakai->tgl_pakai_ban)) ?></td>
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
                      <th class="align-middle" style="width:5%;">No</th>
                      <th class="align-middle">Seri/Merk/Ukuran</th>
                      <th class="align-middle">Status</th>
                      <th class="align-middle">Qty</th>
                      <th class="align-middle">Status Pakai</th>
                      <th class="align-middle">Ket</th>
                    </tr>
                  </thead>
                  <tbody class="text-center" style="font-size:13px;">
                    <?php $i = 1;
                    foreach ($detail as $all) : ?>
                      <tr>
                        <td class="align-middle"><?= $i ?>.</td>
                        <td class="align-middle"><?= $all->no_seri ?>, <?= $all->nama_merk ?>, <?= $all->ukuran_ban ?></td>
                        <td class="align-middle"><?= $all->status_ban_pakai ?></td>
                        <td class="align-middle"><?= $all->jml_pakai_ban ?> pcs</td>
                        <?php if ($all->jml_pakai_ban == 0) { ?>
                          <td class="align-middle">
                            Di oper
                          </td>
                        <?php } else { ?>
                          <td class="align-middle">
                            <?= $all->status_pakai_ban ?>
                          </td>
                        <?php } ?>
                        <?php if ($all->ket_pakai_ban == '') { ?>
                          <td class="align-middle">
                            <i class="fas fa-minus"></i>
                          </td>
                        <?php } else { ?>
                          <td class="align-middle text-capitalize">
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