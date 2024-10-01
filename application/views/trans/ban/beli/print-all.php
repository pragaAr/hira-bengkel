<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Pembelian Sparepart</title>

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
      width: 20%;
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

    <div class="text-uppercase">
      <p>detail data pembelian sparepart bulan <?= $bln ?></p>
    </div>

    <div class="mt-1">
      <table class="table-data">
        <thead>
          <tr>
            <th class="th-data" style="width:5%">No</th>
            <th class="th-data" style="width:15%">No D.O</th>
            <th class="th-data" style="width:10%">Toko</th>
            <th class="th-data" style="width:15%">Part</th>
            <th class="th-data" style="width:5%">Qty</th>
            <th class="th-data" style="width:10%">Harga</th>
            <th class="th-data" style="width:10%">Disk</th>
            <th class="th-data" style="width:10%">Total</th>
            <th class="th-data" style="width:10%">Tgl</th>
            <th class="th-data" style="width:10%">Ket</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($all as $detail) : ?>
            <tr>
              <td class="td-data text-center">
                <?= $no++ ?>.
              </td>
              <td class="td-data">
                <?= strtoupper($detail->kd_beli) ?>
              </td>
              <td class="td-data">
                <?= $detail->nama_toko ?>
              </td>
              <td class="td-data">
                <?= $detail->jenis_part ?>, <?= $detail->nama_merk ?>, <?= $detail->status_part_beli ?>
              </td>
              <td class="td-data text-center">
                <?= $detail->jml_beli ?>
              </td>
              <td class="td-data text-right">
                <?= number_format($detail->harga_pcs) ?>
              </td>

              <?php
              $b = strlen($detail->diskon);
              if ($b <= '2') { ?>
                <td class="td-data text-center">
                  <?= $detail->diskon ?>%
                </td>
              <?php } else { ?>
                <td class="td-data text-right">
                  <?= number_format($detail->diskon) ?>
                </td>
              <?php } ?>

              <td class="td-data text-right">
                <?= number_format($detail->sub_total) ?>
              </td>
              <td class="td-data text-center">
                <?= date('d-m-Y', strtotime(($detail->tgl_beli))) ?>
              </td>
              <?php if ($detail->ket_beli != '') { ?>
                <td class="td-data">
                  <?= ucwords($detail->ket_beli) ?>
                </td>
              <?php } else { ?>
                <td class="td-data text-center">
                  -
                </td>
              <?php } ?>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

    </div>
  </div>

</body>

</html>