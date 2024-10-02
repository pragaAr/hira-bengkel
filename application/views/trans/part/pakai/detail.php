<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('pakai') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <p class="text-danger font-weight-bold mb-3">
            <em>--Kd Pakai : <?= strtoupper($kdpakai->kd_pakai) ?>--</em>
          </p>
          <div class="row">
            <div class="col-md">
              <table class="table table-borderless" width="100%">
                <tr>
                  <td class="text-dark font-weight-bold">Plat Nomor</td>
                  <td>:</td>
                  <td><?= strtoupper($kdpakai->plat_no_truck) ?>, <?= strtoupper($kdpakai->merk_truck) ?> <?= strtoupper($kdpakai->jenis_truck) ?></td>
                  <td class="text-dark font-weight-bold">Nama Petugas</td>
                  <td>:</td>
                  <td><?= $kdpakai->username ?></td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Nama Montir</td>
                  <td>:</td>
                  <td class="text-capitalize"><?= strtoupper($kdpakai->nama_montir) ?></td>
                  <td class="text-dark font-weight-bold">Tanggal Keluar</td>
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
                  <thead class="thead-dark text-center">
                    <tr>
                      <th class="align-middle">No</th>
                      <th class="align-middle">Jenis</th>
                      <th class="align-middle">Status</th>
                      <th class="align-middle">Jumlah</th>
                      <th class="align-middle">Status Pemakaian</th>
                      <th class="align-middle">Ket</th>
                    </tr>
                  </thead>
                  <tbody class="text-center" style="font-size:13px">
                    <?php $i = 1;
                    foreach ($detail as $all) : ?>
                      <tr>
                        <td class="align-middle"><?= $i ?>.</td>
                        <td class="align-middle"><?= strtoupper($all->jenis_part) ?> <?= strtoupper($all->nama_merk) ?></td>
                        <td class="align-middle"><?= ucwords($all->status_part_pakai) ?></td>
                        <td class="align-middle"><?= $all->jml_pakai ?> <?= ucwords($all->sat) ?></td>
                        <?php if ($all->jml_pakai == 0) { ?>
                          <td class="align-middle">
                            Di oper semua
                          </td>
                        <?php } else { ?>
                          <td class="align-middle">
                            <?= ucwords($all->status_pakai) ?>
                          </td>
                        <?php } ?>
                        <?php if ($all->ket_pakai == '') { ?>
                          <td class="align-middle">
                            <i class="fas fa-minus fa-sm"></i>
                          </td>
                        <?php } else { ?>
                          <td class="align-middle">
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