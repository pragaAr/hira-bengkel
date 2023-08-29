<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

use Mpdf\Mpdf;

class Beli_ban extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Ban_model', 'Ban');
    $this->load->model('Beliban_model', 'Beliban');
    $this->load->model('ReturBan_model', 'Returban');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = 'Data Ban Masuk';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/beli/index', $data);
  }

  public function getBeli()
  {
    header('Content-Type: application/json');

    echo $this->Beliban->getData();
  }

  public function add()
  {
    $data['title']  = 'Form Tambah Data Ban Masuk';
    $data['kd']     = $this->Beliban->cekDo();

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/beli/add', $data);
  }

  public function getSeri()
  {
    $seri = $this->input->post('noseri');

    $data = $this->Beliban->checkSeri($seri);

    echo json_encode($data);
  }

  public function cart()
  {
    $this->load->view('trans/ban/beli/cart');
  }

  public function proses()
  {
    $jmlbeli      = count($this->input->post('noseri_hidden'));

    $kdbeli       = $this->input->post('kdbeli');
    $nota         = $this->input->post('nota');
    $tokoid       = $this->input->post('tokoid');
    $toko         = $this->input->post('toko');
    $diskall      = $this->input->post('diskall');
    $ppn          = $this->input->post('ppn');
    $totharga     = $this->input->post('total_hidden');
    $totban       = $this->input->post('totalban_hidden');
    $bayar        = $this->input->post('statusbayar');
    $noseri       = $this->input->post('noseri_hidden');
    $merkid       = $this->input->post('merkid_hidden');
    $size         = $this->input->post('size_hidden');
    $stat         = $this->input->post('stat_hidden');
    $jml          = $this->input->post('jmlbeli_hidden');
    $hrg          = $this->input->post('hrg_hidden');
    $disk         = $this->input->post('disk_hidden');
    $totmindisk   = $this->input->post('totmindisk_hidden');
    $ket          = $this->input->post('ket_hidden');
    $user         = $this->session->userdata('id_user');
    $date         = date('Y-m-d H:i:s');

    $databeli = [
      'kd_beli_ban'       => $kdbeli,
      'toko_ban_id'       => $tokoid,
      'no_nota_ban'       => $nota,
      'user_id'           => $user,
      'total_beli_ban'    => $totban,
      'diskon_ban_all'    => preg_replace("/[^0-9\.]/", "", $diskall),
      'ppn_ban'           => preg_replace("/[^0-9\.]/", "", $ppn),
      'total_harga_ban'   => preg_replace("/[^0-9\.]/", "", $totharga),
      'tgl_beli_ban'      => $date,
      'status_bayar_ban'  => $bayar,
      'tgl_pelunasan_ban' => $bayar == "Lunas" ? $date : '0000-00-00 00:00:00',
      'retur'             => 0,
    ];

    $detailbeli = [];

    for ($i = 0; $i < $jmlbeli; $i++) {
      array_push($detailbeli, ['no_seri_ban' => $noseri[$i]]);
      $detailbeli[$i]['kd_beli_ban']       = $kdbeli;
      $detailbeli[$i]['merk_ban_id']       = $merkid[$i];
      $detailbeli[$i]['ukuran_ban_beli']   = $size[$i];
      $detailbeli[$i]['status_ban_beli']   = $stat[$i];
      $detailbeli[$i]['jml_beli_ban']      = $jml[$i];
      $detailbeli[$i]['harga_ban']         = $hrg[$i];
      $detailbeli[$i]['diskon_ban']        = preg_replace("/[^0-9\.]/", "", $disk)[$i];
      $detailbeli[$i]['sub_total_ban']     = preg_replace("/[^0-9\.]/", "", $totmindisk)[$i];
      $detailbeli[$i]['ket_beli_ban']      = $ket[$i];
      $detailbeli[$i]['tgl_retur_ban']     = "0000-00-00 00:00:00"[$i];
    }

    $stok = [];

    for ($j = 0; $j < $jmlbeli; $j++) {
      array_push($stok, ['no_seri'   => $noseri[$j]]);
      $stok[$j]['merk_ban_id']       = $merkid[$j];
      $stok[$j]['ukuran_ban']        = $size[$j];
      $stok[$j]['jml_ban']           = $jml[$j];
      $stok[$j]['vulk']              = $stat[$j];
      $stok[$j]['status_ban']        = "Gudang";
      $stok[$j]['date_ban_add']      = $date;
      $stok[$j]['date_ban_update']   = "0000-00-00 00:00:00";
      $stok[$j]['user_id']           = $user;
    }

    $history = [];
    for ($k = 0; $k < $jmlbeli; $k++) {
      array_push($history, ['kd_history_ban'  => $kdbeli]);
      $history[$k]['no_seri_history']         = $noseri[$k];
      $history[$k]['ket_history']             =  "Beli di " . $toko . ", " . $jml[$k] . "pcs, " . $size[$k];
      $history[$k]['ket_trans']               = $ket[$k];
      $history[$k]['tgl_add_history']         = $date;
      $history[$k]['user_history']            = $this->session->userdata('username');
    }

    $this->Beliban->addBeli($databeli, $detailbeli, $stok, $history);

    $this->session->set_flashdata('success', 'Data Ban berhasil ditambahkan');

    redirect('beli_ban');
  }

  public function detail($kd)
  {
    $data['title']    = 'Detail Pembelian Ban';
    $data['kdbeli']   = $this->Beliban->getKdBeliBan($kd);
    $data['total']    = $this->Beliban->getTotalBayar($kd);
    $data['detail']   = $this->Beliban->getDetailBeliBan($kd);
    $data['sumtotal'] = $this->Beliban->getSumId($kd);
    $data['retur']    = $this->Returban->getBanMasukRetur($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/beli/detail', $data);
    $this->load->view('template/footer');
  }

  public function detailAll()
  {
    $data['title']  = 'Detail Data Ban Masuk';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/beli/detail-all', $data);
  }

  public function getDetailAll()
  {
    header('Content-Type: application/json');

    echo $this->Beliban->getAllBeli();
  }

  public function getDetailAllById()
  {
    $id = $this->input->post('id');

    $data = $this->Beliban->getDetailById($id);

    echo json_encode($data);
  }


  public function pelunasan()
  {
    $kd = $this->input->post('kd');

    $status = array(
      'status_bayar_ban'  => 'Lunas',
      'tgl_pelunasan_ban' => date('Y-m-d H:i:s')
    );

    $where = array(
      'kd_beli_ban'   => $kd,
    );

    $data = $this->Beliban->pelunasan($status, $where);

    echo json_encode($data);
  }

  public function retur()
  {
    $id   = $this->input->post('id');

    $kd       = $this->input->post('kd');
    $idtoko   = $this->input->post('tokoid');
    $idmerk   = $this->input->post('merkid');
    $noseri   = $this->input->post('noseri');
    $ukuran   = $this->input->post('ukuran');
    $ket      = $this->input->post('ket');
    $jml      = $this->input->post('jmlretur');
    $harga    = preg_replace("/[^0-9\.]/", "", $this->input->post('hrgpcs'));
    $disk     = preg_replace("/[^0-9\.]/", "", $this->input->post('diskon'));
    $stat     = $this->input->post('stat');
    $user     = $this->session->userdata('id_user');
    $date     = date('Y-m-d H:i:s');

    $kdretur  = $this->Returban->cekKdRetur();

    $datadetailretur = array(
      'detail_beli_ban_id'      => $id,
      'kd_beli_ban'             => $kd,
      'kd_retur_ban'            => $kdretur,
      'noseri_ban_retur'        => $noseri,
      'ukuran_ban_retur'        => $ukuran,
      'merk_id_retur'           => $idmerk,
      'status_ban_beli_retur'   => $stat,
      'jml_beli_ban_retur'      => $jml,
      'harga_ban_retur'         => $harga,
      'diskon_retur'            => $disk,
    );

    $databeli = array(
      'retur'     => 1,
      'user_id'   => $user
    );

    $insertdataretur = array(
      'kd_retur_ban'        => $kdretur,
      'kd_beli_ban'         => $kd,
      'toko_ban_id'         => $idtoko,
      'jml_ban_retur'       => $jml,
      'ket_ban_retur'       => $ket,
      'tgl_ban_retur'       => $date,
      'user_id'             => $user
    );

    $noseribanretur = array(
      'no_seri'   => $noseri,
    );

    $datahistori  = array(
      'kd_history_ban'  => $kdretur,
      'no_seri_history' => $noseri,
      'ket_history'     => 'Retur Toko',
      'ket_trans'       => $ket,
      'user_history'    => $this->session->userdata('username'),
      'tgl_add_history' => $date
    );

    $data = $this->Beliban->retur($datadetailretur, $kd,  $databeli);
    $data = $this->Returban->returBan($insertdataretur, $noseribanretur, $datahistori);

    echo json_encode($data);
  }

  // public function delete()
  // {
  //   $kd = $this->input->post('kd');

  //   $seri = $this->Beliban->getSeriBan($kd);

  //   foreach ($seri as $res) {
  //     $hasil[] = $res['no_seri_ban'];
  //   }

  //   $data = $this->Beliban->delete($kd);
  //   $data = $this->Beliban->deleteseri($hasil);

  //   echo json_encode($data);
  // }

  public function print($kd)
  {
    $data['beli']     = $this->Beliban->getKdBeliBan($kd);
    $data['all']      = $this->Beliban->getDetailBeliBan($kd);
    $data['sumtotal'] = $this->Beliban->getSumId($kd);
    $data['total']    = $this->Beliban->getTotalBayar($kd);
    $data['retur']    = $this->Returban->getBanMasukRetur($kd);
    // echo json_encode($data['total']);
    // die;
    $content  = $this->load->view('trans/ban/beli/print', $data, true);

    $mpdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'orientation' => 'L'
    ]);

    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }
}
