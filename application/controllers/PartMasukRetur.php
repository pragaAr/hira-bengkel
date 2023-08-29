<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PartMasukRetur extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('Stok_model');
    $this->load->model('Merk_model');
    $this->load->model('Toko_model');
    $this->load->model('Beli_model');
    $this->load->model('Retur_model');

    if (empty($this->session->userdata('username'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Daftar atau Login dahulu !');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = 'Form Data Part Masuk Retur';
    $data['retur']    = $this->Retur_model->getPartMasukRetur();

    $this->load->view('template/header');
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('transaksi/part-masuk-retur', $data);
    $this->load->view('template/footer');
  }
}
