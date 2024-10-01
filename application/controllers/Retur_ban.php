<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retur_ban extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('ReturBan_model', 'Retur');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = 'Data Retur Ban';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/retur/index', $data);
  }

  public function getRetur()
  {
    header('Content-Type: application/json');

    echo $this->Retur->getData();
  }
}
