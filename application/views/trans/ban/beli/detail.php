<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a target="_blank" href="<?= base_url('beli_ban/print/') . $kdbeli->kd_beli_ban ?>" class="btn btn-primary mb-2">
              <i class="fas fa-print fa-sm"></i>
              Print
            </a>
            <a href="<?= base_url('beli_ban') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <p class="text-danger font-weight-bold mb-3">
            --No. D.O : <?= strtoupper($kdbeli->kd_beli_ban) ?>--
          </p>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <p><span class="text-dark font-weight-bold">Nama Toko</span> : <?= strtoupper($kdbeli->nama_toko) ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <p><span class="text-dark font-weight-bold">Tanggal Nota</span> : <?= date('d/m/Y', strtotime($kdbeli->tgl_beli_ban)) ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <p><span class="text-dark font-weight-bold">Nama Petugas</span> : <?= ucwords($kdbeli->nama_user) ?></p>
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
                      <th class="align-middle">No Seri/Merk/Ukuran</th>
                      <th class="align-middle">Jumlah</th>
                      <th class="align-middle">Harga</th>
                      <th class="align-middle">Status</th>
                      <th class="align-middle">Diskon</th>
                      <th class="align-middle">Sub-Total</th>
                      <th class="align-middle">Ket</th>
                    </tr>
                  </thead>
                  <tbody style="font-size:13px;">
                    <?php $i = 1;
                    foreach ($detail as $all) : ?>
                      <tr>
                        <td class="align-middle"><?= $i++ ?>.</td>
                        <td class="align-middle"><?= strtoupper($all['no_seri_ban']) ?>, <?= $all['nama_merk'] ?>, <?= $all['ukuran_ban_beli'] ?></td>
                        <td class="align-middle"><?= $all['jml_beli_ban'] ?> Pcs</td>
                        <td class="align-middle">Rp <?= number_format($all['harga_ban']) ?></td>
                        <?php if ($all['status_ban_beli'] == 0) { ?>
                          <td class="align-middle">Ori</td>
                        <?php } else { ?>
                          <td class="align-middle">Vulkanisir</td>
                        <?php } ?>
                        <?php
                        $b = strlen($all['diskon_ban']);
                        if ($b <= '2') { ?>
                          <td class="align-middle"><?= $all['diskon_ban'] ?> %</td>
                        <?php } else { ?>
                          <td class="align-middle">Rp <?= number_format($all['diskon_ban']) ?></td>
                        <?php } ?>
                        <td class="text-right align-middle">
                          Rp <?= number_format($all['sub_total_ban']) ?>
                        </td>
                        <?php if ($all['ket_beli_ban'] == '') { ?>
                          <td class="align-middle">
                            <i class="fas fa-minus"></i>
                          </td>
                        <?php } else { ?>
                          <td class="text-capitalize align-middle"><?= $all['ket_beli_ban'] ?></td>
                        <?php } ?>
                      </tr>
                    <?php endforeach ?>
                    <tr>
                      <td colspan="5" class="text-right align-middle font-weight-bold">
                        Total Harga :
                      </td>
                      <td colspan="4" class="text-right align-middle font-weight-bold pr-5">
                        Rp <?= number_format($sumtotal) ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-right align-middle font-weight-bold">
                        Dsikon All :
                      </td>
                      <?php if ($kdbeli->diskon_ban_all > 100) { ?>
                        <td colspan="4" class="text-right align-middle font-weight-bold pr-5">
                          Rp <?= number_format($kdbeli->diskon_ban_all) ?>
                        </td>
                      <?php } else { ?>
                        <td colspan="4" class="text-right align-middle font-weight-bold pr-5">
                          <?= $kdbeli->diskon_ban_all ?> %
                        </td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td colspan="5" class="text-right align-middle font-weight-bold">
                        PPN :
                      </td>
                      <td colspan="4" class="text-right align-middle font-weight-bold pr-5">
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
                          <td colspan="8" class="font-weight-bold align-middle text-danger">
                            --RETUR--
                          </td>
                        </tr>
                        <tr>
                          <td class="align-middle font-weight-bold text-danger text-center"><?= $no ?>.</td>
                          <td class="align-middle font-weight-bold text-danger text-center"><?= $retur['noseri_ban_retur'] ?>, <?= $retur['nama_merk'] ?>, <?= $retur['ukuran_ban_retur'] ?></td>
                          <td class="align-middle font-weight-bold text-danger text-center"><?= $retur['jml_beli_ban_retur'] ?> Pcs</td>
                          <td class="align-middle font-weight-bold text-danger text-right">Rp. <?= number_format($retur['harga_ban_retur']) ?></td>
                          <?php if ($retur['status_ban_beli_retur'] == '0') { ?>
                            <td class="align-middle font-weight-bold text-danger text-center">Ori</td>
                          <?php } else { ?>
                            <td class="align-middle font-weight-bold text-danger text-center">Vulkanisir</td>
                          <?php } ?>
                          <?php
                          $c = strlen($retur['diskon_retur']);
                          if ($c <= '2') { ?>
                            <td class="align-middle font-weight-bold text-danger text-right"><?= $retur['diskon_retur'] ?> %</td>
                          <?php } else { ?>
                            <td class="align-middle font-weight-bold text-danger text-right">Rp <?= number_format($retur['diskon_retur']) ?></td>
                          <?php } ?>
                          <?php
                          $hrg = $retur['harga_ban_retur'];
                          $jml = $retur['jml_beli_ban_retur'];
                          $sub = $hrg * $jml;
                          ?>
                          <td class="align-middle font-weight-bold text-danger text-right">Rp. <?= number_format($sub) ?></td>
                          <td class="align-middle font-weight-bold text-danger text-center"><?= ucwords($retur['ket_ban_retur']) ?></td>
                        </tr>
                        <?php $no++; ?>

                        <tr>
                          <td colspan="5" class="align-middle font-weight-bold text-danger text-right">
                            Total Retur :
                          </td>
                          <?php
                          $jmlretur        = $retur['jml_beli_ban_retur'];
                          $hargapcsretur   = $retur['harga_ban_retur'];
                          $sumretur        = $jmlretur * $hargapcsretur;
                          ?>
                          <td colspan="3" class="align-middle font-weight-bold text-danger text-right pr-5">
                            Rp <?= number_format($sumretur) ?>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" class="align-middle font-weight-bold text-danger text-right">
                            Total Bayar :
                          </td>
                          <?php
                          $totalHarga = $total['total_harga_ban'];
                          $jml        = $total['jml_beli_ban_retur'];
                          $hargaPcs   = $total['harga_ban_retur'];
                          $sumHarga   = $totalHarga - ($jml * $hargaPcs);
                          ?>
                          <td colspan="3" class="align-middle font-weight-bold text-danger text-right pr-5">
                            Rp <?= number_format($sumHarga) ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    <?php } else { ?>
                      <tr>
                        <td colspan="5" class="align-middle font-weight-bold text-danger text-right">
                          Total Bayar :
                        </td>
                        <td colspan="3" class="align-middle font-weight-bold text-danger text-right pr-5">
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