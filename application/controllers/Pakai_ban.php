<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

use Mpdf\Mpdf;

class Pakai_ban extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Ban_model', 'Ban');
    $this->load->model('Merk_model', 'Merk');
    $this->load->model('Truck_model', 'Truck');
    $this->load->model('PakaiBan_model', 'Pakaiban');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = 'Data Pemakaian Ban';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/pakai/index', $data);
  }

  public function getPakai()
  {
    header('Content-Type: application/json');

    echo $this->Pakaiban->getData();
  }

  public function addData()
  {
    $data['title']  = 'Form Tambah Data Pemakaian';
    $data['kd']     = $this->Pakaiban->cekKdPakai();

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/pakai/add', $data);
  }

  public function proses()
  {
    $jmlpakai   = count($this->input->post('banid_hidden'));

    $kd         = $this->input->post('kd');
    $truckid    = $this->input->post('truckid');
    $platno     = $this->input->post('platno');
    $montir     = $this->input->post('montir');
    $tot        = $this->input->post('totalban_hidden');
    $banid      = $this->input->post('banid_hidden');
    $noseri     = $this->input->post('noseri_hidden');
    $merkid     = $this->input->post('merkid_hidden');
    $stat       = $this->input->post('stat_hidden');
    $jml        = $this->input->post('jml_hidden');
    $ket        = $this->input->post('ket_hidden');
    $date         = date('Y-m-d H:i:s', strtotime($this->input->post('tgl') . ' ' . date('H:i:s')));
    $user       = $this->session->userdata('id_user');
    $name       = $this->session->userdata('nama_user');

    $datapakai = [
      'kd_pakai_ban'      => $kd,
      'truck_ban_id'      => $truckid,
      'total_pakai_ban'   => $tot,
      'nama_montir_ban'   => $montir,
      'tgl_pakai_ban'     => $date,
      'user_id'           => $user,
    ];

    $detailpakai = [];

    for ($i = 0; $i < $jmlpakai; $i++) {
      array_push($detailpakai, ['ban_id'      => $banid[$i]]);
      $detailpakai[$i]['kd_pakai_ban']        = $kd;
      $detailpakai[$i]['merk_ban_id']         = $merkid[$i];
      $detailpakai[$i]['status_ban_pakai']    = $stat[$i];
      $detailpakai[$i]['jml_pakai_ban']       = $jml[$i];
      $detailpakai[$i]['status_pakai_ban']    = 'Di Pakai';
      $detailpakai[$i]['ket_pakai_ban']       = $ket[$i];
    }

    $history = [];

    for ($k = 0; $k < $jmlpakai; $k++) {
      array_push($history,  ['kd_history_ban' => $kd]);
      $history[$k]['no_seri_history']         = $noseri[$k];
      $history[$k]['ket_history']             =  "Dipakai " . $platno;
      $history[$k]['ket_trans']               = $ket[$k] . ", Montir : " . $montir;
      $history[$k]['tgl_add_history']         = date('Y-m-d H:i:s');
      $history[$k]['user_history']            = $name;
    }

    $updateban = [];

    for ($j = 0; $j < $jmlpakai; $j++) {
      $updateban[] = array(
        'id_ban'            => $banid[$j],
        'status_ban'        => "Dipakai " . $platno,
        'date_ban_update'   => $date
      );
    }

    $this->Pakaiban->addData($datapakai, $detailpakai, $updateban);
    $this->Pakaiban->addHistory($history);

    $this->session->set_flashdata('success', 'Berhasil melakukan transaksi pemakaian Ban');

    redirect('pakai_ban');
  }

  public function detail($kd)
  {
    $data['title']      = 'Detail Pemakaian';
    $data['kdpakai']    = $this->Pakaiban->getKdPakai($kd);
    $data['detail']     = $this->Pakaiban->getDetailPakai($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/pakai/detail', $data);
    $this->load->view('template/footer');
  }

  public function detailAll()
  {
    $data['title']    = 'Detail Data Ban Keluar';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/pakai/detail-all', $data);
  }

  public function getDetailAll()
  {
    header('Content-Type: application/json');

    echo $this->Pakaiban->getAllPakai();
  }

  public function printAll()
  {
    $truck  = $this->input->post('truck');
    $bulan  = $this->input->post('bulan');

    $query  = $this->Pakaiban->getAllDataPakai($truck, $bulan);
 
    $data['all'] = $query;
    $data['bln'] = date('F/Y', strtotime($bulan));

    $content  = $this->load->view('trans/ban/pakai/print-all', $data, true);

    $mpdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'orientation' => 'P'
    ]);

    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }

  public function kembaliGudang($id)
  {
    $query = $this->Pakaiban->getPakaiKembali($id);

    $idban        = $query->ban_id;
    $iddetail     = $query->id_detail_pakai_ban;
    $kdpakai      = $query->kd_pakai_ban;
    $seriban      = $query->no_seri;
    $status       = 'Gudang';
    $statuspakai  = 'Di kembalikan ke gudang';

    $whereban     = array(
      'id_ban'    => $idban,
    );

    $databan        = array(
      'status_ban'  => $status
    );

    $wherepakai   = array(
      'id_detail_pakai_ban'   => $iddetail,
    );

    $datapakai    = array(
      'status_pakai_ban'  => $statuspakai,
    );

    $datahistori  = array(
      'kd_history_ban'  => $kdpakai,
      'no_seri_history' => $seriban,
      'ket_history'     => $statuspakai,
      'ket_trans'       => $statuspakai . " Oleh : " . $this->session->userdata('username'),
      'user_history'    => $this->session->userdata('username'),
      'tgl_add_history' => date('Y-m-d H:i:s')
    );

    $this->Pakaiban->kembaliGudang($databan, $whereban, $datahistori, $datapakai, $wherepakai);
    $this->session->set_flashdata('kembaligudang', 'Ban berhasil dikembalikan ke gudang');
    redirect('pakai_ban');
  }

  public function delete()
  {
    $kd     = $this->input->post('kdpakai');

    $banid  = $this->Pakaiban->getBanPakaiId($kd);

    $updateban = [];

    foreach ($banid as $res) {
      $updateban[] = array(
        'id_ban'      => $res['ban_id'],
        'status_ban'  => "Gudang",
      );
    }

    $this->Pakaiban->delete($kd);
    $data = $this->Pakaiban->updateStatus($updateban);

    echo json_encode($data);
  }
}
