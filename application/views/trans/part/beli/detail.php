<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a target="_blank" href="<?= base_url('beli/print/') . $kdbeli->kd_beli ?>" class="btn btn-sm btn-primary mb-2">
              <i class="fas fa-print fa-sm"></i>
              Print
            </a>
            <a href="<?= base_url('beli') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <p class="text-danger font-weight-bold mb-3">
            <em>--No. D.O : <?= strtoupper($kdbeli->kd_beli) ?>--</em>
          </p>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <p><strong>Nama Toko</strong> : <?= strtoupper($kdbeli->nama_toko) ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <p><strong>Tanggal Nota</strong> : <?= date('d/m/Y', strtotime($kdbeli->tgl_beli)) ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <p><strong>Nama Petugas</strong> : <?= ucwords($kdbeli->nama_user) ?></p>
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
                      <th scope="col">Jumlah</th>
                      <th scope="col">Harga/pcs</th>
                      <th scope="col">Diskon/pcs</th>
                      <th scope="col">Sub-Total</th>
                      <th scope="col">Ket</th>
                    </tr>
                  </thead>
                  <tbody class="text-center" style="font-size:13px;">
                    <?php $i = 1;
                    foreach ($detail as $all) : ?>
                      <tr>
                        <td><?= $i ?>.</td>
                        <td><?= strtoupper($all->jenis_part) ?>, <?= strtoupper($all->nama_merk) ?>, <?= strtoupper($all->status_part_beli) ?></td>
                        <td><?= $all->jml_beli ?> <?= strtoupper($all->sat) ?> </td>
                        <td class="text-right">Rp <?= number_format($all->harga_pcs) ?></td>
                        <?php
                        $b = strlen($all->diskon);
                        if ($b <= '2') { ?>
                          <td><?= $all->diskon ?> %</td>
                        <?php } else { ?>
                          <td>Rp <?= number_format($all->diskon) ?></td>
                        <?php } ?>
                        <td class="text-right">
                          Rp <?= number_format($all->sub_total) ?>
                        </td>
                        <?php if ($all->ket_beli == '') { ?>
                          <td>
                            <i class="fas fa-minus"></i>
                          </td>
                        <?php } else { ?>
                          <td class="text-capitalize"><?= $all->ket_beli ?></td>
                        <?php } ?>
                      </tr>
                      <?php $i++; ?>
                    <?php endforeach ?>
                    <tr>
                      <td colspan="5" class="font-weight-bold text-right">
                        Total Harga :
                      </td>
                      <td colspan="3" class="font-weight-bold text-right pr-5">
                        Rp <?= number_format($sumtotal) ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="5" class="font-weight-bold text-right">
                        Diskon/all :
                      </td>
                      <?php
                      $d = strlen($kdbeli->diskon_all);
                      if ($d <= '2') { ?>
                        <td colspan="3" class="font-weight-bold text-right pr-5">
                          <?= $kdbeli->diskon_all ?> %
                        </td>
                      <?php } else { ?>
                        <td colspan="3" class="font-weight-bold text-right pr-5">
                          Rp <?= number_format($kdbeli->diskon_all) ?>
                        </td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td colspan="5" class="font-weight-bold text-right">
                        PPN :
                      </td>
                      <?php if ($kdbeli->ppn == '') { ?>
                        <td colspan="3" class="font-weight-bold text-right pr-5">
                          <i class="fas fa-minus"></i>
                        </td>
                      <?php } else { ?>
                        <td colspan="3" class="font-weight-bold text-right pr-5">Rp <?= number_format($kdbeli->ppn, 2) ?></td>
                      <?php } ?>
                    </tr>
                  </tbody>
                  <tfoot style="font-size:13px;">
                    <!-- Jika Ada Retur Part -->
                    <?php $no = 1;
                    if ($retur) { ?>
                      <?php foreach ($retur as $retur) : ?>
                        <tr class="font-weight-bold text-danger">
                          <td colspan="7"><em>--RETUR--</em></td>
                        </tr>
                        <tr class="font-weight-bold text-danger text-center">
                          <td><?= $no ?>.</td>
                          <td><?= strtoupper($retur->jenis_part) ?>, <?= strtoupper($retur->nama_merk) ?>, <?= strtoupper($retur->status_part_beli_retur) ?></td>
                          <td><?= $retur->jml_beli_retur ?> <?= strtoupper($retur->sat) ?></td>
                          <td class="text-right">Rp. <?= number_format($retur->harga_pcs_retur) ?></td>
                          <?php
                          $c = strlen($retur->diskon_retur);
                          if ($c <= '2') { ?>
                            <td><?= $retur->diskon_retur ?> %</td>
                          <?php } else { ?>
                            <td>Rp <?= number_format($retur->diskon_retur) ?></td>
                          <?php } ?>
                          <?php
                          $hrg = $retur->harga_pcs_retur;
                          $jml = $retur->jml_beli_retur;
                          $sub = $hrg * $jml;
                          ?>
                          <td class="text-right">Rp. <?= number_format($sub) ?></td>
                          <td><?= ucwords($retur->ket_retur) ?></td>
                        </tr>
                        <?php $no++; ?>

                        <tr class="font-weight-bold text-danger text-right">
                          <td colspan="5">
                            Total Retur :
                          </td>
                          <?php
                          $jmlretur        = $retur->jml_beli_retur;
                          $hargapcsretur   = $retur->harga_pcs_retur;
                          $sumretur        = $jmlretur * $hargapcsretur;
                          ?>
                          <td colspan="3" class="font-weight-bold text-danger text-right pr-5">
                            Rp <?= number_format($sumretur) ?>
                          </td>
                        </tr>
                        <tr class="font-weight-bold text-danger text-right">
                          <td colspan="5">
                            Total Bayar :
                          </td>
                          <?php
                          $totalHarga = $total->total_harga;
                          $jml        = $total->jml_beli_retur;
                          $hargaPcs   = $total->harga_pcs_retur;
                          $sumHarga   = $totalHarga - ($jml * $hargaPcs);
                          ?>
                          <td colspan="3" class="font-weight-bold text-danger text-right pr-5">
                            Rp <?= number_format($sumHarga) ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    <?php } else { ?>

                      <tr class="font-weight-bold text-danger text-right">
                        <td colspan="5">
                          Total Bayar :
                        </td>
                        <td colspan="3" class="font-weight-bold text-danger text-right pr-5">
                          <!-- <?php $totalAll = $kdbeli->ppn + $sumtotal; ?> -->
                          Rp <?= number_format($kdbeli->total_harga) ?>
                        </td>
                      </tr>
                    <?php } ?>
                    <!-- end retur -->

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