<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Percab extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Percab_model', 'Percab');
    $this->load->model('Truck_model', 'Truck');
  }

  public function index()
  {
    $data['title']    = 'Data Perbaikan Cabang';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/percab/index', $data);
  }

  public function getPercab()
  {
    header('Content-Type: application/json');

    echo $this->Percab->getData();
  }

  public function addData()
  {
    $data['title']  = 'Form Tambah Data Perbaikan Cabang';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/percab/add', $data);
  }

  public function cart()
  {
    $this->load->view('trans/percab/cart');
  }

  public function proses()
  {
    $jmlperbaikan = count($this->input->post('truck_hidden'));
    $nosurat      = $this->input->post('nosurat');
    $tglsurat     = $this->input->post('tglsurat');
    $cabang       = $this->input->post('cabang');
    $truck        = $this->input->post('truck_hidden');
    $bengkel      = $this->input->post('bengkel_hidden');
    $tglnota      = $this->input->post('tglnota_hidden');
    $part         = $this->input->post('part_hidden');
    $sopir        = $this->input->post('sopir_hidden');
    $ongkos       = $this->input->post('ongkos_hidden');
    $ket          = $this->input->post('ket_hidden');
    $total        = $this->input->post('total_hidden');
    $date         = date('Y-m-d H:i:s');
    $user         = $this->session->userdata('id_user');


    $data = [
      'nosurat'         => $nosurat,
      'tglsurat'        => $tglsurat,
      'cabang'          => $cabang,
      'totalpercab'     => $jmlperbaikan,
      'totalbyr'        => preg_replace("/[^0-9\.]/", "", $total),
      'percab_add '     => $date,
      'user_id'         => $user,

    ];

    $detail = [];

    for ($i = 0; $i < $jmlperbaikan; $i++) {
      array_push($detail, ['truckid'    => $truck[$i]]);
      $detail[$i]['nosurat']            = $nosurat;
      $detail[$i]['bengkel']            = $bengkel[$i];
      $detail[$i]['tglnota']            = $tglnota[$i];
      $detail[$i]['part']               = $part[$i];
      $detail[$i]['sopir']              = $sopir[$i];
      $detail[$i]['ongkos']             = preg_replace("/[^0-9\.]/", "", $ongkos)[$i];
      $detail[$i]['ketpercab']          = $ket[$i];
    }

    $this->Percab->addData($data, $detail);

    $this->session->set_flashdata('success', 'Berhasil menambahkan data perbaikan cabang');

    redirect('percab');
  }

  public function detail($no)
  {
    $data['title']    = 'Detail Perbaikan Cabang';
    $data['percab']   = $this->Percab->getDataNo($no);
    $data['detail']   = $this->Percab->detailData($no);

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/percab/detail', $data);
  }

  public function delete()
  {
    $no   = $this->input->post('no');
    $data = $this->Percab->deleteData($no);

    echo json_encode($data);
  }
}
