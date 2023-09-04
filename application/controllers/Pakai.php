<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

use Mpdf\Mpdf;

class Pakai extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Stok_model', 'Stok');
    $this->load->model('Merk_model', 'Merk');
    $this->load->model('Truck_model', 'Truck');
    $this->load->model('Pakai_model', 'Pakai');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']      = 'Data Pemakaian Sparepart';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/pakai/index', $data);
  }

  public function getPakai()
  {
    header('Content-Type: application/json');

    echo $this->Pakai->getData();
  }

  public function addData()
  {
    $data['title']  = 'Form Tambah Data Pakai Part';

    $data['kd']     = $this->Pakai->cekKdPakai();

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/pakai/add', $data);
  }

  public function cart()
  {
    $this->load->view('trans/part/pakai/cart');
  }

  public function proses()
  {
    $jmlpakai     = count($this->input->post('partid_hidden'));

    $kd           = $this->input->post('kd');
    $truckid      = $this->input->post('truckid');
    $platno       = $this->input->post('platno');
    $partid       = $this->input->post('partid_hidden');
    $merkid       = $this->input->post('merkid_hidden');
    $sat          = $this->input->post('sat_hidden');
    $statuspart   = $this->input->post('statuspart_hidden');
    $jml          = $this->input->post('jml_hidden');
    $ket          = $this->input->post('ket_hidden');
    $totpart      = $this->input->post('totalpart_hidden');
    $montir       = $this->input->post('montir');
    $user         = $this->session->userdata('id_user');
    $date         = date('Y-m-d H:i:s');

    $datapakai = [
      'kd_pakai'        => $kd,
      'truck_id'        => $truckid,
      'total_pakai'     => $totpart,
      'user_id'         => $user,
      'nama_montir'     => $montir,
      'tgl_pakai'       => $date,
    ];

    $datadetail = [];

    for ($i = 0; $i < $jmlpakai; $i++) {
      array_push($datadetail, ['part_id'    => $partid[$i]]);
      $datadetail[$i]['kd_pakai']           = $kd;
      $datadetail[$i]['merk_id']            = $merkid[$i];
      $datadetail[$i]['status_part_pakai']  = $statuspart[$i];
      $datadetail[$i]['jml_pakai']          = $jml[$i];
      $datadetail[$i]['status_pakai']       = 'Di Pakai';
      $datadetail[$i]['ket_pakai']          = $ket[$i];
    }

    $historyPakai = [];

    for ($j = 0; $j < $jmlpakai; $j++) {
      array_push($historyPakai, ['part_history_id'   => $partid[$j]]);
      $historyPakai[$j]['kd_history_part']      = $kd;
      $historyPakai[$j]['ket_history_part']     = "Dipakai " . $platno . ", " . $jml[$j] . " " . $sat[$j] . ", " . $statuspart[$j];
      $historyPakai[$j]['ket_trans_part']       = $ket[$j] . ", " . "Montir : " . $montir;
      $historyPakai[$j]['tgl_part_history']     = $date;
    }

    $this->Pakai->addData($datapakai, $datadetail);
    $this->Pakai->addHistory($historyPakai);

    $this->session->set_flashdata('success', 'Berhasil melakukan transaksi pemakaian Sparepart');

    redirect('pakai');
  }

  public function detail($kd)
  {
    $data['title']      = 'Detail Pemakaian';
    $data['kdpakai']    = $this->Pakai->getKdPakai($kd);
    $data['detail']     = $this->Pakai->getDetailPakai($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/pakai/detail', $data);
  }

  public function detailAll()
  {
    $data['title']    = 'Detail Data Stok Keluar';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/pakai/detail-all', $data);
  }

  public function getDetailAll()
  {
    header('Content-Type: application/json');

    echo $this->Pakai->getAllPakai();
  }

  public function printAll()
  {
    $bulan  = $this->input->post('bulan');

    $query  = $this->Pakai->getAllDataPakai($bulan);

    $data['all'] = $query;
    $data['bln'] = date('F/Y', strtotime($bulan));

    $content  = $this->load->view('trans/part/pakai/print-all', $data, true);

    $mpdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'orientation' => 'L'
    ]);

    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }

  public function delete()
  {
    $kd   = $this->input->post('kdpakai');
    $data = $this->Pakai->delete($kd);

    echo json_encode($data);
  }
}
