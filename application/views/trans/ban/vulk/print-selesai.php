<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Vulk</title>

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

    .page-number-footer {
      text-align: right;
      font-style: italic;
      font-size: 11px;
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
        <td style="width:45%; font-weight:bold; letter-spacing:1px; font-size:large; font-family: 'Times New Roman', Times, serif;">
          <u>VULKANISIR SELESAI<u>
        </td>
        <td style="width:10%; font-size:12px; font-family:Arial, Helvetica, sans-serif;">
          Tanggal Nota<br>
          Pembayaran
        </td>
        <td>
          :<br>
          :
        </td>
        <td style="width:10%; font-size:12px; font-family:Arial, Helvetica, sans-serif; padding-left:10px;">
          <?= date('d-m-Y', strtotime($head->tgl_selesai)) ?>
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
            <th class="th-data">No Nota</th>
            <th class="th-data">No Seri<br>Merk / Ukuran</th>
            <th class="th-data">Qty</th>
            <th class="th-data">Tgl Vulk</th>
            <th class="th-data">Biaya</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($detail as $all) : ?>
            <tr>
              <td class="td-data text-center">
                <?= $no++ ?>.
              </td>
              <td class="td-data text-center">
                <?= strtoupper($all->no_nota) ?>
              </td>
              <td class="td-data text-center">
                <?= $all->no_seri ?>,
                <?= $all->merk ?>,
                <?= $all->ukuran ?>
              </td>
              <td class="td-data text-center">
                <?= $all->jml ?> Pcs
              </td>
              <td class="td-data text-center">
                <?= date('d-m-y', strtotime($all->tgl_vulk)) ?>
              </td>

              <?php if($all->ongkos == '') { ?>
                <td class="td-data text-center">
                -
              </td>
              <?php } else { ?>
                <td class="td-data text-right" style="padding-right:10px;">
                Rp. <?= number_format($all->ongkos) ?>
              </td>
              <?php } ?>
              
            </tr>
          <?php endforeach ?>
          <tr>
            <td class="td-data" colspan="3" rowspan="3" style="font-size:12px; padding-left:20px; padding-bottom:10px;">
              Setiap penagihan harus melampirkan form order asli dari kami.<br>
              Penggantian part, perubahan harga harus dikonfirmasikan terlebih dahulu.
            </td>
            <td class="td-data text-right font-bold" style="padding-right:10px;">
              Total Biaya :
            </td>
            <td colspan="2" class="td-data text-right font-bold" style="padding-right:10px;">
              Rp. <?= number_format($head->biaya) ?>
            </td>
          </tr>
        </tbody>
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