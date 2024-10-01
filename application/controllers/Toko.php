<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Toko extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Toko_model', 'Toko');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']  = 'Data Toko';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('main/toko', $data);
  }

  public function getToko()
  {
    header('Content-Type: application/json');

    echo $this->Toko->getData();
  }

  public function getId()
  {
    $id   = $this->input->post('idtoko');
    $data = $this->Toko->getId($id);

    echo json_encode($data);
  }

  public function getListToko()
  {
    $keyword = $this->input->get('q');

    if (!$keyword) {
      $data = $this->Toko->getDataToko();

      $response = [];
      foreach ($data as $toko) {
        $response[] = [
          'id' => $toko->id_toko,
          'text' => ucwords($toko->nama_toko)
        ];
      }
    } else {
      $data = $this->Toko->getSearchDataToko($keyword);

      $response = [];
      foreach ($data as $toko) {
        $response[] = [
          'id' => $toko->id_toko,
          'text' => ucwords($toko->nama_toko),
        ];
      }
    }

    echo json_encode($response);
  }

  public function create()
  {
    $nama   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('nama'))));
    $telp   = htmlspecialchars(trim(preg_replace('/[^0-9]/', '', $this->input->post('telp'))));

    $data = array(
      'nama_toko'     => strtolower($nama),
      'no_telp_toko'  => strtolower($telp),
      'toko_in'       => date('Y-m-d H:i:s'),
      'user_id'       => $this->session->userdata('id_user')
    );

    $data = $this->Toko->addToko($data);

    echo json_encode($data);
  }

  public function addSelect()
  {
    $nama   = trim($this->input->post('namatoko'));
    $telp   = trim($this->input->post('telptoko'));

    $datatoko = array(
      'nama_toko'     => strtolower($nama),
      'no_telp_toko'  => strtolower($telp),
      'toko_in'       => date('Y-m-d H:i:s'),
      'user_id'       => $this->session->userdata('id_user'),
    );

    $this->Toko->addNewData($datatoko);

    $tokoid = $this->db->insert_id();

    $response = [
      'id'    => $tokoid,
      'text'  => ucwords($nama)
    ];

    echo json_encode($response);
  }

  public function update()
  {
    $id     = $this->input->post('id');
    $nama   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('nama'))));
    $telp   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('telp'))));

    $data = array(
      'nama_toko'     => strtolower($nama),
      'no_telp_toko'  => strtolower($telp),
    );

    $where = array(
      'id_toko'   => $id
    );

    $data = $this->Toko->editToko($data, $where);

    echo json_encode($data);
  }

  public function delete()
  {
    $id   = $this->input->post('idtoko');
    $data = $this->Toko->deleteToko($id);

    echo json_encode($data);
  }
}
