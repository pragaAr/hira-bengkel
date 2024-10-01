<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Stok Sparepart</title>

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
      padding: 3px;
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

    <div class="">
      <p>DATA STOK SPAREPART</p>
    </div>

    <div class="mt-1">
      <table class="table-data">
        <thead>
          <tr>
            <th class="th-data">No</th>
            <th class="th-data">Jenis</th>
            <th class="th-data">Merk</th>
            <th class="th-data">Baru</th>
            <th class="th-data">Bekas</th>
            <th class="th-data">Qty</th>
            <th class="th-data">Rak</th>
            <th class="th-data">In</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($stok as $data) : ?>
            <tr>
              <td class="td-data text-center">
                <?= $no++; ?>.
              </td>
              <td class="td-data" style="text-align:left">
                <?= strtoupper($data->jenis_part) ?>
              </td>
              <?php if ($data->nama_merk == "") { ?>
                <td class="td-data text-center">
                  -
                </td>
              <?php } elseif ($data->nama_merk == " ") { ?>
                <td class="td-data text-center">
                  -
                </td>
              <?php } else { ?>
                <td class="td-data">
                  <?= strtoupper($data->nama_merk) ?>
                </td>
              <?php } ?>
              <td class="td-data text-center">
                <?= $data->part_baru ?>
              </td>
              <td class="td-data text-center">
                <?= $data->part_bekas ?>
              </td>
              <?php
              $a = $data->part_baru;
              $b = $data->part_bekas;
              $jml = $a + $b;
              ?>
              <td class="td-data text-center">
                <?= $jml ?> <?= $data->sat ?>
              </td>

              <?php if ($data->rak == '') { ?>
                <td class="td-data text-center">
                  -
                </td>
              <?php } else { ?>
                <td class="td-data">
                  <?= ucwords($data->rak) ?>
                </td>
              <?php } ?>

              <td class="td-data">
                <?= date('d/m/Y', strtotime($data->part_in)) ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

    </div>
  </div>

</body>

</html>