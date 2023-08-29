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
          <?= strtoupper($beli->kd_beli) ?><br>
          <?= date('d-m-Y', strtotime($beli->tgl_beli)) ?>
          <br>
          1 Bulan
        </td>
      </tr>
    </table>

    <div class="mt-1">
      <table class="table-data">
        <thead>
          <tr>
            <th class="th-data">No</th>
            <th class="th-data">Spesifikasi Parts<br>Nama Parts / Merk</th>
            <th class="th-data">Qty</th>
            <th class="th-data">Harga/pcs</th>
            <th class="th-data">Diskon/pcs</th>
            <th class="th-data">Jumlah Harga</th>
            <th class="th-data">Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($all as $all) : ?>
            <tr>
              <td class="td-data text-center" style="width:3%;">
                <?= $no++ ?>.
              </td>
              <td class="td-data text-center">
                <?= strtoupper($all->jenis_part) ?>,
                <?= strtoupper($all->nama_merk) ?>,
                <?= strtoupper($all->status_part_beli) ?>
              </td>
              <td class="td-data text-center" style="width:10%;">
                <?= $all->jml_beli ?>
                <?= strtoupper($all->sat) ?>
              </td>
              <td class="td-data text-right" style="width:15%; padding-right:20px;">
                Rp. <?= number_format($all->harga_pcs) ?>
              </td>
              <?php
              $b = strlen($all->diskon);
              if ($b <= '2') { ?>
                <td class="td-data text-right" style="width:10%; padding-right:20px;">
                  <?= $all->diskon ?> %
                </td>
              <?php } else { ?>
                <td class="td-data text-right" style="width:10%; padding-right:20px;">
                  Rp. <?= number_format($all->diskon) ?>
                </td>
              <?php } ?>
              <td class="td-data text-right" style="width:15%; padding-right:20px;">
                Rp. <?= number_format($all->sub_total) ?>
              </td>
              <td class="td-data text-center" style="width:20%;">
                <?= ucwords($all->ket_beli) ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot>
          <?php $no = 1;
          if ($retur) {
            foreach ($retur as $retur) : ?>
              <tr>
                <td colspan="4" rowspan="3" class="td-data" style="font-size:12px; padding-left:20px; padding-bottom:10px;">
                  Setiap penagihan harus melampirkan form order asli dari kami.<br>
                  Penggantian part, perubahan harga harus dikonfirmasikan terlebih dahulu.
                </td>
                <td style="font-weight:bold; padding-right:15px" class="td-data text-right">
                  Total Harga :
                </td>
                <td colspan="2" class="td-data text-right" style="font-weight:bold; padding-right:20px;">
                  Rp. <?= number_format($sumtotal) ?>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold; padding-right:15px" class="td-data text-right">
                  Diskon/all :
                </td>
                <?php
                $c = strlen($beli->diskon_all);
                if ($c <= '2') { ?>
                  <td colspan="2" class="td-data text-right" style="font-weight:bold; padding-right:20px;">
                    <?= $beli->diskon_all ?> %
                  </td>
                <?php } else { ?>
                  <td colspan="2" class="td-data text-right" style="font-weight:bold; padding-right:20px;">
                    Rp. <?= number_format($beli->diskon_all) ?>
                  </td>
                <?php } ?>
              </tr>
              <tr>
                <td style="font-weight:bold; padding-right:15px" class="td-data text-right">
                  PPN :
                </td>
                <td colspan="2" class="td-data text-right" style="font-weight:bold; padding-right:20px;">
                  Rp. <?= number_format($beli->ppn) ?>
                </td>
              </tr>
              <tr>
                <td colspan="7" class="td-data" style="color:red; padding-left:30px;font-weight:bold;"><em>--RETUR--</em></td>
              </tr>
              <tr>
                <td class="td-data text-center" style="color:red;"><?= $no ?>.</td>
                <td class="td-data" style="color:red;"><?= $retur->jenis_part ?>, <?= $retur->nama_merk ?>, <?= $retur->status_part_beli_retur ?></td>
                <td class="td-data text-center" style="color:red;"><?= $retur->jml_beli_retur ?> <?= $retur->sat ?></td>
                <td class="td-data text-right" style="width:10%; padding-right:20px; color:red">Rp. <?= number_format($retur->harga_pcs_retur) ?></td>
                <?php
                $c = strlen($retur->diskon_retur);
                if ($c <= '2') { ?>
                  <td class="td-data text-right" style="width:10%; padding-right:20px;color:red"><?= $retur->diskon_retur ?> %</td>
                <?php } else { ?>
                  <td class="td-data text-right" style="width:10%; padding-right:20px;color:red">Rp <?= number_format($retur->diskon_retur) ?></td>
                <?php } ?>
                <?php
                $hrg = $retur->harga_pcs_retur;
                $jml = $retur->jml_beli_retur;
                $sub = $hrg * $jml;
                ?>
                <td class="td-data text-right" style="padding-right:20px;color:red">Rp. <?= number_format($sub) ?></td>
                <td class="td-data" style="color:red;"><?= ucwords($retur->ket_retur) ?></td>
              </tr>
              <?php $no++; ?>
              <tr>
                <td colspan="4" class="td-data"></td>
                <td class="td-data text-right" style="color:red; font-weight:bold; padding-right:15px;">
                  Nominal :
                </td>
                <?php
                $jmlretur        = $retur->jml_beli_retur;
                $hargapcsretur   = $retur->harga_pcs_retur;
                $sumretur        = $jmlretur * $hargapcsretur;
                ?>
                <td colspan="2" class="td-data text-right" style="color:red; font-weight:bold; padding-right:20px;">
                  Rp. <?= number_format($sumretur) ?>
                </td>
              </tr>
              <tr>
                <td colspan="4" class="td-data"></td>
                <td class="td-data text-right" style="color:black; font-weight:bold; padding-right:15px;">
                  Total Bayar :
                </td>
                <?php
                $totalHarga = $total->total_harga;
                $jml        = $total->jml_beli_retur;
                $hargaPcs   = $total->harga_pcs_retur;
                $sumHarga   = $totalHarga - ($jml * $hargaPcs);
                ?>
                <td colspan="2" class="td-data text-right" style="color:black; font-weight:bold; padding-right:20px;">
                  Rp. <?= number_format($sumHarga) ?>
                </td>
              </tr>
            <?php endforeach ?>
          <?php } else { ?>
            <tr>
              <td class="td-data" colspan="4" rowspan="4" style="font-size:12px; padding-left:20px; padding-bottom:10px;">
                Setiap penagihan harus melampirkan form order asli dari kami.<br>
                Penggantian part, perubahan harga harus dikonfirmasikan terlebih dahulu.
              </td>
              <td class="td-data" style="text-align:right; font-weight:bold; padding-right:15px">
                Total Harga
              </td>
              <td class="td-data" colspan="2" style="text-align:right; font-weight:bold; padding-right:20px;">
                Rp. <?= number_format($sumtotal) ?>
              </td>
            </tr>
            <tr>
              <td class="td-data" style="text-align:right; font-weight:bold; padding-right:15px">
                Diskon/all
              </td>
              <?php
              $c = strlen($beli->diskon_all);
              if ($c <= '2') { ?>
                <td class="td-data" colspan="2" style="text-align:right; font-weight:bold; padding-right:20px;">
                  <?= $beli->diskon_all ?> %
                </td>
              <?php } else { ?>
                <td class="td-data" colspan="2" style="text-align:right; font-weight:bold; padding-right:20px;">
                  Rp. <?= number_format($beli->diskon_all) ?>
                </td>
              <?php } ?>
            </tr>
            <tr>
              <td class="td-data" style="text-align:right; font-weight:bold; padding-right:15px">
                PPN
              </td>
              <?php if ($beli->ppn == '') { ?>
                <td class="td-data" colspan="2" style="text-align:right; font-weight:bold; padding-right:20px;">
                  00.0
                </td>
              <?php } else { ?>
                <td class="td-data" colspan="2" style="text-align:right; font-weight:bold; padding-right:20px;">Rp <?= number_format($beli->ppn) ?></td>
              <?php } ?>
            </tr>
            <tr>
              <td class="td-data" style="text-align:right; font-weight:bold; padding-right:15px">
                Total Bayar
              </td>
              <td class="td-data" colspan="2" style="text-align:right; font-weight:bold; padding-right:20px;">
                Rp. <?= number_format($beli->total_harga) ?>
              </td>
            </tr>
          <?php } ?>
        </tfoot>
      </table>

      <table style="width:100%; margin-top:40px; font-size:12px;">
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