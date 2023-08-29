<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

use Mpdf\Mpdf;

class Repair extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Repair_model', 'Repair');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = 'Data Repair Sparepart';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/repair/index', $data);
  }

  public function getRepair()
  {
    header('Content-Type: application/json');

    echo $this->Repair->getData();
  }

  public function add()
  {
    $data['title']  = 'Form Tambah Data Repair';
    $data['kd']     = $this->Repair->cekKdRepair();

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/repair/add', $data);
  }

  public function cart()
  {
    $this->load->view('trans/part/repair/cart');
  }

  public function proses()
  {
    $jmlrepair  = count($this->input->post('partid_hidden'));

    $kd         = $this->input->post('kd');
    $partid     = $this->input->post('partid_hidden');
    $partname   = $this->input->post('partname_hidden');
    $sat        = $this->input->post('sat_hidden');
    $merk       = $this->input->post('merk_hidden');
    $merkid     = $this->input->post('merkid_hidden');
    $tokoid     = $this->input->post('tokoid');
    $toko       = $this->input->post('toko');
    $jml        = $this->input->post('jml_hidden');
    $total      = $this->input->post('totalpart_hidden');
    $statpart   = $this->input->post('statpart_hidden');
    $ket        = $this->input->post('ket_hidden');
    $user       = $this->session->userdata('id_user');
    $date       = date('Y-m-d H:i:s');

    $datarepair = [
      'kd_repair'       => $kd,
      'toko_id'         => $tokoid,
      'total_repair'    => $total,
      'tgl_repair'      => $date,
      'user_id'         => $user,
    ];

    $detailrepair = [];

    for ($i = 0; $i < $jmlrepair; $i++) {
      array_push($detailrepair, ['part_id'    => $partid[$i]]);
      $detailrepair[$i]['kd_repair']          = $kd;
      $detailrepair[$i]['merk_id']            = $merkid[$i];
      $detailrepair[$i]['status_part_repair'] = $statpart[$i];
      $detailrepair[$i]['jml_repair']         = $jml[$i];
      $detailrepair[$i]['status_repair']      = 'Di Repair';
      $detailrepair[$i]['ket_repair']         = $ket[$i];
    }

    $historyrepair = [];

    for ($j = 0; $j < $jmlrepair; $j++) {
      array_push($historyrepair, ['part_history_id' => $partid[$j]]);
      $historyrepair[$j]['kd_history_part']      = $kd;
      $historyrepair[$j]['ket_history_part']     = "Di Repair di " . $toko . " " . $jml[$j] . " " . $sat[$j] . " " . $statpart[$j];
      $historyrepair[$j]['ket_trans_part']       = $ket[$j];
      $historyrepair[$j]['tgl_part_history']     = $date;
    }

    $this->Repair->addData($datarepair, $detailrepair);

    $this->Repair->addHistory($historyrepair);

    $this->session->set_flashdata('success', 'Sparepart berhasil ditambahkan ke repair');

    redirect('repair');
  }

  public function detail($kd)
  {
    $data['title']  = 'Detail Repair';
    $data['rep']    = $this->Repair->getRepairKd($kd);
    $data['detail'] = $this->Repair->getDetailRepair($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/repair/detail', $data);
    $this->load->view('template/footer');
  }

  public function print($kd)
  {
    $dt       = $this->Repair->getSuratJalan($kd);
    $header   = $this->Repair->getHeaderRepair($kd);

    $data['kd']       = $kd;
    $data['dtrep']    = $dt;
    $data['header']   = $header;

    $content  = $this->load->view('trans/part/repair/print', $data, true);

    $mpdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'orientation' => 'L'
    ]);

    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }
}
