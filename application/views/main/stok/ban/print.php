<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Stok Ban</title>

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

    .text-left {
      text-align: left;
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
      <p>DATA STOK BAN</p>
    </div>

    <div class="mt-1">
      <table class="table-data">
        <thead>
          <tr>
            <th class="th-data">No</th>
            <th class="th-data">Seri</th>
            <th class="th-data">Merk</th>
            <th class="th-data">Uk</th>
            <th class="th-data">Kondisi</th>
            <th class="th-data">Status</th>
            <th class="th-data">In</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($ban as $data) : ?>
            <tr>
              <td class="td-data text-center">
                <?= $no++; ?>.
              </td>
              <td class="td-data text-left">
                <?= strtoupper($data->no_seri) ?>
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
                <?= $data->ukuran_ban ?>
              </td>
              <?php if ($data->vulk == 0) { ?>
                <td class="td-data text-center">
                  ORIGINAL
                </td>
              <?php } else { ?>
                <td class="td-data text-center">
                  VULKANISIR
                </td>
              <?php } ?>

              <td class="td-data">
                <?= ucwords($data->status_ban) ?>
              </td>

              <td class="td-data">
                <?= date('d/m/Y', strtotime($data->date_ban_add)) ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

    </div>
  </div>

</body>

</html>