<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

use Mpdf\Mpdf;

class Beli extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Beli_model', 'Beli');
    $this->load->model('Retur_model', 'Retur');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = 'Data Stok Masuk';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/beli/index', $data);
  }

  public function getBeli()
  {
    header('Content-Type: application/json');

    echo $this->Beli->getData();
  }

  public function addData()
  {
    $data['title']  = 'Form Tambah Data Stok Masuk';
    $data['kd']     = $this->Beli->cekDo();

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/beli/add', $data);
  }

  public function proses()
  {
    $user       = $this->session->userdata('id_user');
    $kd         = $this->input->post('kd_beli');
    $toko       = $this->input->post('toko_belipart');
    $namatoko   = $this->input->post('toko');
    $nota       = $this->input->post('nota_belipart');
    $totpart    = $this->input->post('totalpart_hidden');
    $statbayar  = $this->input->post('status_bayar');
    $diskon     = preg_replace("/[^0-9\.]/", "", $this->input->post('diskon_belipart'));
    $ppn        = preg_replace("/[^0-9\.]/", "", $this->input->post('ppn_belipart'));
    $harga      = preg_replace("/[^0-9\.]/", "", $this->input->post('hrgpcs_hidden'));
    $disk       = preg_replace("/[^0-9\.]/", "", $this->input->post('diskon_hidden'));
    $totharga   = preg_replace("/[^0-9\.]/", "", $this->input->post('total_hidden'));
    $subtotal   = preg_replace("/[^0-9\.]/", "", $this->input->post('subtotal_hidden'));
    $tgl        = date('Y-m-d H:i:s');
    $partid     = $this->input->post('partid_hidden');
    $merk       = $this->input->post('merkid_hidden');
    $stat       = $this->input->post('statuspart_hidden');
    $ket        = $this->input->post('keterangan_hidden');
    $jml        = $this->input->post('jmlbeli_hidden');
    $sat        = $this->input->post('sat_hidden');

    $jml_beli   = count($partid);

    $data_beli = [
      'kd_beli'         => $kd,
      'toko_id'         => $toko,
      'no_nota'         => $nota,
      'user_id'         => $user,
      'total_beli'      => $totpart,
      'diskon_all'      => $diskon,
      'ppn'             => $ppn,
      'total_harga'     => $totharga,
      'tgl_beli '       => $tgl,
      'status_bayar'    => $statbayar,
      'tgl_pelunasan'   => $statbayar == "lunas" ? $tgl : '0000-00-00 00:00:00',
      'retur'           => 0
    ];

    $detail_beli = [];

    for ($i = 0; $i < $jml_beli; $i++) {
      array_push($detail_beli, ['part_id'    => $partid[$i]]);
      $detail_beli[$i]['kd_beli']            = $kd;
      $detail_beli[$i]['merk_id']            = $merk[$i];
      $detail_beli[$i]['status_part_beli']   = $stat[$i];
      $detail_beli[$i]['jml_beli']           = $jml[$i];
      $detail_beli[$i]['harga_pcs']          = $harga[$i];
      $detail_beli[$i]['diskon']             = $disk[$i];
      $detail_beli[$i]['sub_total']          = $subtotal[$i];
      $detail_beli[$i]['ket_beli']           = $ket[$i];
    }

    $historyBeli = [];

    for ($j = 0; $j < $jml_beli; $j++) {
      array_push($historyBeli, ['part_history_id'   => $partid[$j]]);
      $historyBeli[$j]['kd_history_part']      = $kd;
      $historyBeli[$j]['ket_history_part']     = "Beli di " . $namatoko . " " . $jml[$j] . " " . $sat[$j] . " " . $stat[$j];
      $historyBeli[$j]['ket_trans_part']       = $ket[$j];
      $historyBeli[$j]['tgl_part_history']     = $tgl;
    }

    $this->Beli->addData($data_beli, $detail_beli);

    $this->Beli->addHistory($historyBeli);

    $this->session->set_flashdata('success', 'Berhasil melakukan transaksi pembelian Sparepart');

    redirect('beli');
  }

  public function getPart()
  {
    $data = $this->Stok_model->jenisPart($_POST['id_part']);

    echo json_encode($data);
  }

  public function cart()
  {
    $this->load->view('trans/part/beli/cart');
  }

  public function detail($kd)
  {
    $data['title']        = 'Detail Stok Masuk';
    $data['kdbeli']       = $this->Beli->getKdBeli($kd);
    $data['total']        = $this->Beli->getTotalBayar($kd);
    $data['detail']       = $this->Beli->getDetailBeli($kd);
    $data['sumtotal']     = $this->Beli->getSumId($kd);
    $data['retur']        = $this->Retur->getPartMasukRetur($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/beli/detail', $data);
    $this->load->view('template/footer');
  }

  public function detailAll()
  {
    $data['title']    = 'Detail Semua Stok Masuk';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/beli/detail-all', $data);
  }

  public function getDetailAll()
  {
    header('Content-Type: application/json');

    echo $this->Beli->getAllBeli();
  }

  public function getDetailAllById()
  {
    $id = $this->input->post('id');

    $data = $this->Beli->getDetailById($id);

    echo json_encode($data);
  }

  public function pelunasan()
  {
    $kd = $this->input->post('kd');

    $statusdata = array(
      'status_bayar'  => 'Lunas',
      'tgl_pelunasan' => date('Y-m-d H:i:s')
    );

    $where = array(
      'kd_beli'   => $kd,
    );

    $data = $this->Beli->Pelunasan($statusdata, $where);

    echo json_encode($data);
  }

  public function retur()
  {
    $id             = $this->input->post('id');
    $kd             = $this->input->post('kd');
    $toko           = $this->input->post('toko');
    $idtoko         = $this->input->post('tokoid');
    $idmerk         = $this->input->post('merkid');
    $idpart         = $this->input->post('partid');
    $dskrtr         = preg_replace("/[^0-9\.]/", "", $this->input->post('diskon'));
    $ketretur       = $this->input->post('ket');
    $jml            = $this->input->post('jmlretur');
    $sat            = $this->input->post('sat');
    $hargapcs       = preg_replace("/[^0-9\.]/", "", $this->input->post('hrgpcs'));
    $statusretur    = $this->input->post('stat');
    $date           = date('Y-m-d H:i:s');
    $user           = $this->session->userdata('id_user');

    $kdretur        = $this->Retur->cekKdRetur();

    $datadetailretur = array(
      'detail_beli_id'           => $id,
      'kd_beli'                  => $kd,
      'kd_retur'                 => $kdretur,
      'part_id_retur'            => $idpart,
      'merk_id_retur'            => $idmerk,
      'status_part_beli_retur'   => $statusretur,
      'jml_beli_retur'           => $jml,
      'harga_pcs_retur'          => $hargapcs,
      'diskon_retur'             => $dskrtr,
    );

    $databeli = array(
      'retur'       => 1,
      'user_id'     => $user
    );

    $insertdataretur = array(
      'kd_retur'     => $kdretur,
      'kd_beli'      => $kd,
      'toko_id'      => $idtoko,
      'jml_retur'    => $jml,
      'ket_retur'    => $ketretur,
      'tgl_retur'    => $date,
      'user_id'      => $user
    );

    $history = array(
      'kd_history_part'     => $kdretur,
      'part_history_id'     => $idpart,
      'ket_history_part'    => "Retur ke " . $toko . " " . $jml . " " . $sat,
      'ket_trans_part'      => $ketretur,
      'tgl_part_history'    => $date,
    );

    $data = $this->Beli->retur($kd,  $databeli);
    $data = $this->Retur->returPart($insertdataretur, $history, $datadetailretur);

    echo json_encode($data);
  }

  public function print($kd)
  {
    $data['beli']     = $this->Beli->getKdBeli($kd);
    $data['all']      = $this->Beli->getDetailBeli($kd);
    $data['total']    = $this->Beli->getTotalBayar($kd);
    $data['sumtotal'] = $this->Beli->getSumId($kd);
    $data['retur']    = $this->Retur->getPartMasukRetur($kd);

    $content  = $this->load->view('trans/part/beli/print', $data, true);

    $mpdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'orientation' => 'L'
    ]);

    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }

  public function printAll()
  {
    $bulan  = $this->input->post('bulan');

    $query  = $this->Beli->getAllDataBeli($bulan);

    $data['all'] = $query;
    $data['bln'] = date('F/Y', strtotime($bulan));

    $content  = $this->load->view('trans/part/beli/print-all', $data, true);

    $mpdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'orientation' => 'L'
    ]);

    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }
}
