<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Surat Jalan Vulk</title>

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
        <td style="width:35%">
          <?= strtoupper($head->nama_toko) ?>
        </td>
        <td style="width:45%; font-weight:bold; letter-spacing:1px; font-size:large;">
          <u>SURAT JALAN VULKANISIR<u>
        </td>
        <td style="width:10%; font-size:12px; font-family:Arial, Helvetica, sans-serif;">
          Kd Vulk <br>
          Tanggal Vulk<br>
          Pembayaran
        </td>
        <td>
          :<br>
          :<br>
          :
        </td>
        <td style="width:10%; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding-left:10px;">
          <?= strtoupper($head->kd_vulk) ?><br>
          <?= date('d-m-Y', strtotime($head->tgl_vulk)) ?>
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
            <th class="th-data">No Seri</th>
            <th class="th-data">Merk</th>
            <th class="th-data">Ukuran</th>
            <th class="th-data">Qty</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($dtvulk as $all) : ?>
            <tr>
              <td class="td-data text-center">
                <?= $no++ ?>.
              </td>
              <td class="td-data text-center">
                <?= strtoupper($all->no_seri_vulk) ?>
              </td>
              <td class="td-data text-center">
                <?= strtoupper($all->merk_vulk) ?>
              </td>
              <td class="td-data text-center">
                <?= $all->ukuran_ban_vulk ?>
              </td>
              <td class="td-data text-center">
                <?= $all->jml_vulk ?> Pcs
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

      <table style=" width:100%; margin-top:40px; font-size:12px;">
        <thead>
          <tr>
            <th class="text-center">Dibuat Oleh,</th>
            <th class="text-center">Dibawa Oleh,</th>
            <th class="text-center">Diperiksa Oleh,</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center" style="padding-top:60px">Bag. Pembelian</td>
            <td class="text-center" style="padding-top:60px"><?= strtoupper($head->nama_toko) ?></td>
            <td class="text-center" style="padding-top:60px">Bag. Keamanan</td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

</body>

</html>