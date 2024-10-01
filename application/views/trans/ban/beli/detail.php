<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a target="_blank" href="<?= base_url('beli_ban/print/') . $kdbeli->kd_beli_ban ?>" class="btn btn-sm btn-primary mb-2">
              <i class="fas fa-print fa-sm"></i>
              Print
            </a>
            <a href="<?= base_url('beli_ban') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <p class="text-danger font-weight-bold mb-3">
            --No. D.O : <?= strtoupper($kdbeli->kd_beli_ban) ?>--
          </p>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <p><strong>Nama Toko</strong> : <?= strtoupper($kdbeli->nama_toko) ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <p><strong>Tanggal Nota</strong> : <?= date('d/m/Y', strtotime($kdbeli->tgl_beli_ban)) ?></p>
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
                      <th scope="col">No Seri/Merk/Ukuran</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Status</th>
                      <th scope="col">Diskon</th>
                      <th scope="col">Sub-Total</th>
                      <th scope="col">Ket</th>
                    </tr>
                  </thead>
                  <tbody style="font-size:13px;">
                    <?php $i = 1;
                    foreach ($detail as $all) : ?>
                      <tr>
                        <td><?= $i++ ?>.</td>
                        <td><?= strtoupper($all['no_seri_ban']) ?>, <?= $all['nama_merk'] ?>, <?= $all['ukuran_ban_beli'] ?></td>
                        <td><?= $all['jml_beli_ban'] ?> Pcs</td>
                        <td>Rp <?= number_format($all['harga_ban']) ?></td>
                        <?php if ($all['status_ban_beli'] == 0) { ?>
                          <td>Ori</td>
                        <?php } else { ?>
                          <td>Vulkanisir</td>
                        <?php } ?>
                        <?php
                        $b = strlen($all['diskon_ban']);
                        if ($b <= '2') { ?>
                          <td><?= $all['diskon_ban'] ?> %</td>
                        <?php } else { ?>
                          <td>Rp <?= number_format($all['diskon_ban']) ?></td>
                        <?php } ?>
                        <td class="text-right">
                          Rp <?= number_format($all['sub_total_ban']) ?>
                        </td>
                        <?php if ($all['ket_beli_ban'] == '') { ?>
                          <td>
                            <i class="fas fa-minus"></i>
                          </td>
                        <?php } else { ?>
                          <td class="text-capitalize"><?= $all['ket_beli_ban'] ?></td>
                        <?php } ?>
                      </tr>
                    <?php endforeach ?>
                    <tr>
                      <td colspan="5" class="text-right font-weight-bold">
                        Total Harga :
                      </td>
                      <td colspan="4" class="text-right font-weight-bold pr-5">
                        Rp <?= number_format($sumtotal) ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-right font-weight-bold">
                        Dsikon All :
                      </td>
                      <?php if ($kdbeli->diskon_ban_all > 100) { ?>
                        <td colspan="4" class="text-right font-weight-bold pr-5">
                          Rp <?= number_format($kdbeli->diskon_ban_all) ?>
                        </td>
                      <?php } else { ?>
                        <td colspan="4" class="text-right font-weight-bold pr-5">
                          <?= $kdbeli->diskon_ban_all ?> %
                        </td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-right font-weight-bold">
                        PPN :
                      </td>
                      <td colspan="4" class="text-right font-weight-bold pr-5">
                        Rp <?= number_format($kdbeli->ppn_ban) ?>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot style="font-size:13px;">
                    <!-- Jika Ada Retur Ban -->
                    <?php $no = 1;
                    if ($retur) {
                      foreach ($retur as $retur) : ?>
                        <tr>
                          <td colspan="8" class="font-weight-bold text-danger">
                            --RETUR--
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold text-danger text-center"><?= $no ?>.</td>
                          <td class="font-weight-bold text-danger text-center"><?= $retur['noseri_ban_retur'] ?>, <?= $retur['nama_merk'] ?>, <?= $retur['ukuran_ban_retur'] ?></td>
                          <td class="font-weight-bold text-danger text-center"><?= $retur['jml_beli_ban_retur'] ?> Pcs</td>
                          <td class="font-weight-bold text-danger text-right">Rp. <?= number_format($retur['harga_ban_retur']) ?></td>
                          <?php if ($retur['status_ban_beli_retur'] == '0') { ?>
                            <td class="font-weight-bold text-danger text-center">Ori</td>
                          <?php } else { ?>
                            <td class="font-weight-bold text-danger text-center">Vulkanisir</td>
                          <?php } ?>
                          <?php
                          $c = strlen($retur['diskon_retur']);
                          if ($c <= '2') { ?>
                            <td class="font-weight-bold text-danger text-right"><?= $retur['diskon_retur'] ?> %</td>
                          <?php } else { ?>
                            <td class="font-weight-bold text-danger text-right">Rp <?= number_format($retur['diskon_retur']) ?></td>
                          <?php } ?>
                          <?php
                          $hrg = $retur['harga_ban_retur'];
                          $jml = $retur['jml_beli_ban_retur'];
                          $sub = $hrg * $jml;
                          ?>
                          <td class="font-weight-bold text-danger text-right">Rp. <?= number_format($sub) ?></td>
                          <td class="font-weight-bold text-danger text-center"><?= ucwords($retur['ket_ban_retur']) ?></td>
                        </tr>
                        <?php $no++; ?>

                        <tr>
                          <td colspan="5" class="font-weight-bold text-danger text-right">
                            Total Retur :
                          </td>
                          <?php
                          $jmlretur        = $retur['jml_beli_ban_retur'];
                          $hargapcsretur   = $retur['harga_ban_retur'];
                          $sumretur        = $jmlretur * $hargapcsretur;
                          ?>
                          <td colspan="3" class="font-weight-bold text-danger text-right pr-5">
                            Rp <?= number_format($sumretur) ?>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" class="font-weight-bold text-danger text-right">
                            Total Bayar :
                          </td>
                          <?php
                          $totalHarga = $total['total_harga_ban'];
                          $jml        = $total['jml_beli_ban_retur'];
                          $hargaPcs   = $total['harga_ban_retur'];
                          $sumHarga   = $totalHarga - ($jml * $hargaPcs);
                          ?>
                          <td colspan="3" class="font-weight-bold text-danger text-right pr-5">
                            Rp <?= number_format($sumHarga) ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    <?php } else { ?>
                      <tr>
                        <td colspan="5" class="font-weight-bold text-danger text-right">
                          Total Bayar :
                        </td>
                        <td colspan="3" class="font-weight-bold text-danger text-right pr-5">
                          Rp <?= number_format($kdbeli->total_harga_ban) ?>
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