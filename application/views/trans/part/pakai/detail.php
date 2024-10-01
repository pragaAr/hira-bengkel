<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('pakai') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <p class="text-danger font-weight-bold mb-3">
            <em>--Kd Pakai : <?= strtoupper($kdpakai->kd_pakai) ?>--</em>
          </p>
          <div class="row">
            <div class="col-md">
              <table class="table table-borderless" width="100%">
                <tr>
                  <td><strong>Plat Nomor</strong></td>
                  <td>:</td>
                  <td><?= strtoupper($kdpakai->plat_no_truck) ?>, <?= strtoupper($kdpakai->merk_truck) ?> <?= strtoupper($kdpakai->jenis_truck) ?></td>
                  <td><strong>Nama Petugas</strong></td>
                  <td>:</td>
                  <td><?= $kdpakai->username ?></td>
                </tr>
                <tr>
                  <td><strong>Nama Montir</strong></td>
                  <td>:</td>
                  <td class="text-capitalize"><?= strtoupper($kdpakai->nama_montir) ?></td>
                  <td><strong>Tanggal Keluar</strong></td>
                  <td>:</td>
                  <td><?= date('d-m-Y', strtotime($kdpakai->tgl_pakai)) ?></td>
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
                      <th><strong>Jenis</strong></th>
                      <th><strong>Status</strong></th>
                      <th><strong>Jumlah</strong></th>
                      <th><strong>Status Pemakaian</strong></th>
                      <th><strong>Ket</strong></th>
                    </tr>
                  </thead>
                  <tbody class="text-center" style="font-size:13px">
                    <?php $i = 1;
                    foreach ($detail as $all) : ?>
                      <tr>
                        <td><?= $i ?>.</td>
                        <td><?= strtoupper($all->jenis_part) ?> <?= strtoupper($all->nama_merk) ?></td>
                        <td><?= ucwords($all->status_part_pakai) ?></td>
                        <td><?= $all->jml_pakai ?> <?= ucwords($all->sat) ?></td>
                        <?php if ($all->jml_pakai == 0) { ?>
                          <td>
                            Di oper semua
                          </td>
                        <?php } else { ?>
                          <td>
                            <?= ucwords($all->status_pakai) ?>
                          </td>
                        <?php } ?>
                        <?php if ($all->ket_pakai == '') { ?>
                          <td>
                            <i class="fas fa-minus fa-sm"></i>
                          </td>
                        <?php } else { ?>
                          <td class="text-capitalize">
                            <?= ucwords($all->ket_pakai) ?>
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