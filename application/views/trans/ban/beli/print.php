<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print D.O</title>

  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
    }

    p {
      font-size: 12px;
    }

    .container {
      margin-right: 10px;
      margin-left: 10px;
    }

    .img-column {
      width: 15%;
      float: left;
      box-sizing: border-box;
      padding: 5px;
    }

    img {
      width: 116px;
      height: 74px;
    }

    .company-name {
      font-size: 20px;
      line-height: 1.5;
    }

    .clear {
      clear: both;
    }

    .text-capitalize {
      text-transform: capitalize;
    }

    .text-uppercase {
      text-transform: uppercase;
    }

    .text-right {
      text-align: right;
    }

    .text-center {
      text-align: center;
    }

    .text-danger {
      color: red;
    }

    .font-bold {
      font-weight: bold;
    }

    .mt-1 {
      margin-top: 10px;
    }

    .table-data {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #000;
    }

    .th-data {
      border: 1px solid #000;
      font-size: 12px;
      text-align: center;
      padding: 5px;
    }

    .td-data {
      border: 1px solid #000;
      font-size: 11px;
      padding: 3px 2px;
      line-height: 1.5;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="img-column">
      <img src="<?= base_url('public/img/logo-hira.png') ?>">
    </div>

    <div class="identity-column">
      <h2 class="company-name">
        PT. HIRA ADYA NARANATA
      </h2>
      <p style="padding-top:-15px; font-size:12px;">
        Komplek Pangkalan Truk Genuk AA 57-58<br>
        Jl. Raya Kaligawe KM. 5,6 Semarang<br>
        Telp. 024 - 6584125 Fax. 024 - 6591334
      </p>
    </div>

    <div class="clear"></div>
    <hr>

    <table style="margin-bottom:20px;">
      <tr>
        <td style="width:35%"><?= strtoupper($beli->nama_toko) ?></td>
        <td style="width:40%; font-weight:bold; letter-spacing:1px; font-size:large; font-family: 'Times New Roman', Times, serif;"><u>ORDER PEMBELIAN<u></td>
        <td style="width:10%; font-size:12px; font-family:Arial, Helvetica, sans-serif;">
          Nomor D.O <br>
          Tanggal Nota<br>
          Tempo
        </td>
        <td>
          :<br>
          :<br>
          :
        </td>
        <td style="width:20%; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding-left:10px;">
          <?= strtoupper($beli->kd_beli_ban) ?><br>
          <?= date('d-m-Y', strtotime($beli->tgl_beli_ban)) ?>
          <br>
          1 Bulan
        </td>
      </tr>
    </table>

    <div class="mt-1">
      <table class="table-data">
        <thead>
          <tr>
            <th class="th-data" style="width:3%;">No</th>
            <th class="th-data">No Seri<br>Merk / Ukuran</th>
            <th class="th-data">Qty</th>
            <th class="th-data">Harga</th>
            <th class="th-data">Status</th>
            <th class="th-data">Diskon</th>
            <th class="th-data">Jumlah</th>
            <th class="th-data">Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($all as $all) : ?>
            <tr>
              <td class="td-data text-center">
                <?= $no++ ?>.
              </td>
              <td class="td-data text-center">
                <?= $all['no_seri_ban'] ?>,
                <?= $all['nama_merk'] ?>,
                <?= $all['ukuran_ban_beli'] ?>
              </td>
              <td class="td-data text-center">
                <?= $all['jml_beli_ban'] ?> Pcs
              </td>
              <td class="td-data text-right" style="padding-right:10px;">
                Rp. <?= number_format($all['harga_ban']) ?>
              </td>

              <?php if ($all['status_ban_beli'] === '0') { ?>
                <td class="td-data text-center">Ori</td>
              <?php } else { ?>
                <td class="td-data text-center">Vulkanisir</td>
              <?php } ?>

              <?php
              $b = strlen($all['diskon_ban']);
              if ($b <= '2') { ?>
                <td class="td-data text-right" style="padding-right:10px;">
                  <?= $all['diskon_ban'] ?> %
                </td>
              <?php } else { ?>
                <td class="td-data text-right" style="padding-right:10px;">
                  Rp. <?= number_format($all['diskon_ban']) ?>
                </td>
              <?php } ?>
              <td class="td-data text-right" style="padding-right:10px;">
                Rp. <?= number_format($all['sub_total_ban']) ?>
              </td>
              <td class="td-data text-center">
                <?= ucwords($all['ket_beli_ban']) ?>
              </td>
            </tr>
          <?php endforeach ?>
          <tr>
            <td class="td-data" colspan="4" rowspan="3" style="font-size:12px; padding-left:20px; padding-bottom:10px;">
              Setiap penagihan harus melampirkan form order asli dari kami.<br>
              Penggantian part, perubahan harga harus dikonfirmasikan terlebih dahulu.
            </td>
            <td colspan="2" class="td-data text-right font-bold" style="padding-right:10px;">
              Total Harga :
            </td>
            <td colspan="2" class="td-data text-right font-bold" style="padding-right:10px;">
              Rp <?= number_format($sumtotal) ?>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="td-data text-right font-bold" style="padding-right:10px;">
              Dsikon All :
            </td>
            <?php if ($beli->diskon_ban_all > 100) { ?>
              <td colspan="2" class="td-data text-right font-bold" style="padding-right:10px;">
                Rp <?= number_format($beli->diskon_ban_all) ?>
              </td>
            <?php } else { ?>
              <td colspan="2" class="td-data text-right font-bold" style="padding-right:10px;">
                <?= $beli->diskon_ban_all ?> %
              </td>
            <?php } ?>
          </tr>
          <tr>
            <td colspan="2" class="td-data text-right font-bold" style="padding-right:10px;">
              PPN :
            </td>
            <td colspan="2" class="td-data text-right font-bold" style="padding-right:10px;">
              Rp <?= number_format($beli->ppn_ban) ?>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <?php $i = 1;
          if ($retur) {
            foreach ($retur as $retur) : ?>
              <tr>
                <td colspan="8" class="td-data font-bold text-danger" style="padding-left:10px;">
                  --RETUR--
                </td>
              </tr>
              <tr>
                <td class="td-data font-bold text-danger text-center">
                  <?= $i ?>.
                </td>
                <td class="td-data font-bold text-danger text-center">
                  <?= $retur['noseri_ban_retur'] ?>, <?= $retur['nama_merk'] ?>, <?= $retur['ukuran_ban_retur'] ?>
                </td>
                <td class="td-data font-bold text-danger text-center">
                  <?= $retur['jml_beli_ban_retur'] ?> Pcs
                </td>
                <td class="td-data font-bold text-danger text-right" style="padding-right:10px;">
                  Rp. <?= number_format($retur['harga_ban_retur']) ?>
                </td>
                <?php if ($retur['status_ban_beli_retur'] == '0') { ?>
                  <td class="td-data font-bold text-danger text-center">
                    Ori
                  </td>
                <?php } else { ?>
                  <td class="td-data font-bold text-danger text-center">
                    Vulkanisir
                  </td>
                <?php } ?>
                <?php
                $c = strlen($retur['diskon_retur']);
                if ($c <= '2') { ?>
                  <td class="td-data font-bold text-danger text-right" style="padding-right:10px;">
                    <?= $retur['diskon_retur'] ?> %
                  </td>
                <?php } else { ?>
                  <td class="td-data font-bold text-danger text-right" style="padding-right:10px;">
                    Rp <?= number_format($retur['diskon_retur']) ?>
                  </td>
                <?php } ?>
                <?php
                $hrg = $retur['harga_ban_retur'];
                $jml = $retur['jml_beli_ban_retur'];
                $sub = $hrg * $jml;
                ?>
                <td class="td-data font-bold text-danger text-right" style="padding-right:10px;">
                  Rp. <?= number_format($sub) ?>
                </td>
                <td class="td-data font-bold text-danger text-center">
                  <?= ucwords($retur['ket_ban_retur']) ?>
                </td>
              </tr>
              <?php $i++; ?>
              <tr>
                <td colspan="6" class="td-data font-bold text-danger text-right" style="padding-right:10px;">
                  Total Retur :
                </td>
                <?php
                $jmlretur       = $retur['jml_beli_ban_retur'];
                $hargapcsretur  = $retur['harga_ban_retur'];
                $sumretur       = $jmlretur * $hargapcsretur;
                ?>
                <td colspan="2" class="td-data font-bold text-danger text-right" style="padding-right:10px;">
                  Rp <?= number_format($sumretur) ?>
                </td>
              </tr>
              <tr>
                <td colspan="6" class="td-data font-bold text-danger text-right" style="padding-right:10px;">
                  Total Bayar :
                </td>
                <?php
                $totharga = $total['total_harga_ban'];
                $jmlban        = $total['jml_beli_ban_retur'];
                $hrgban   = $total['harga_ban_retur'];
                $sumharga   = $totharga - ($jmlban * $hrgban);
                ?>
                <td colspan="2" class="td-data font-bold text-danger text-right" style="padding-right:10px;">
                  Rp <?= number_format($sumharga) ?>
                </td>
              </tr>
            <?php endforeach ?>
          <?php } ?>
        </tfoot>

      </table>

      <table style=" width:100%; margin-top:40px; font-size:12px;">
        <thead>
          <tr>
            <th class="text-center">Dibuat Oleh,</th>
            <th class="text-center">Diketahui Oleh,</th>
            <th class="text-center">Disetujui Oleh,</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center" style="padding-top:60px">Bag. Pembelian</td>
            <td class="text-center" style="padding-top:60px">Manager Operasional</td>
            <td class="text-center" style="padding-top:60px">Manager Keuangan</td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

</body>

</html>