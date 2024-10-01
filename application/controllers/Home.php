<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Beli_model', 'Beli');
    $this->load->model('Beliban_model', 'Beliban');
    $this->load->model('Percab_model', 'Percab');

    if (empty($this->session->userdata('username'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Daftar atau Login dahulu !');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title'] = 'Dashboard';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('main/home');
  }

  public function getBelanjaPart()
  {
    $input  = $this->input->get('month');
    $data   = $this->Beli->sumBeli($input);

    echo json_encode($data);
  }

  public function getPartTunai()
  {
    $input  = $this->input->get('month');
    $data   = $this->Beli->sumTunai($input);

    echo json_encode($data);
  }

  public function getPartTempo()
  {
    $input  = $this->input->get('month');
    $data   = $this->Beli->sumTempo($input);

    echo json_encode($data);
  }

  public function getBelanjaBan()
  {
    $input  = $this->input->get('month');
    $data   = $this->Beliban->sumBeli($input);

    echo json_encode($data);
  }

  public function getBanTunai()
  {
    $input  = $this->input->get('month');
    $data   = $this->Beliban->sumTunai($input);

    echo json_encode($data);
  }

  public function getBanTempo()
  {
    $input  = $this->input->get('month');
    $data   = $this->Beliban->sumTempo($input);

    echo json_encode($data);
  }

  public function getPercab()
  {
    $input  = $this->input->get('month');
    $data   = $this->Percab->sumTotal($input);

    echo json_encode($data);
  }

  public function getBelanjaPartTahunan()
  {
    $input  = $this->input->get('year');
    $data   = $this->Beli->getYearlySalesTotals($input);

    echo json_encode($data);
  }

  public function getBelanjaBanTahunan()
  {
    $input  = $this->input->get('year');
    $data   = $this->Beliban->getYearlySalesTotals($input);

    echo json_encode($data);
  }

  public function listBelanjaPartTunai()
  {
    $input  = $this->input->get('month');
    $data   = $this->Beli->listTunai($input);

    echo json_encode($data);
  }

  public function listBelanjaPartTempo()
  {
    $input  = $this->input->get('month');
    $data   = $this->Beli->listTempo($input);

    echo json_encode($data);
  }
}
