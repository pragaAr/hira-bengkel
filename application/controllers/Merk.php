<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Merk extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Merk_model', 'Merk');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']  = 'Data Merk';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('main/merk', $data);
  }

  public function getMerk()
  {
    header('Content-Type: application/json');

    echo $this->Merk->getData();
  }

  public function getId()
  {
    $id   = $this->input->post('idmerk');
    $data = $this->Merk->getId($id);

    echo json_encode($data);
  }

  public function getDataMerk()
  {
    $keyword = $this->input->get('q');

    if (!$keyword) {

      $data = $this->Merk->selectMerk();

      $response = [];
      foreach ($data as $merk) {
        $response[] = [
          'id' => $merk->id_merk,
          'text' => strtoupper($merk->nama_merk),
        ];
      }

      echo json_encode($response);
    } else {
      $data = $this->Merk->selectSearchMerk($keyword);

      $response = [];
      foreach ($data as $merk) {
        $response[] = [
          'id' => $merk->id_merk,
          'text' => strtoupper($merk->nama_merk),
        ];
      }

      echo json_encode($response);
    }
  }

  public function create()
  {
    $merk   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('merk'))));

    $data = array(
      'nama_merk'   => strtolower($merk),
      'merk_in'     => date('Y-m-d H:i:s'),
      'user_id'     => $this->session->userdata('id_user')
    );

    $data = $this->Merk->addMerk($data);

    echo json_encode($data);
  }

  public function addSelect()
  {
    $nama   = trim($this->input->post('namamerk'));

    $datamerk = array(
      'nama_merk' => strtolower($nama),
      'merk_in'   => date('Y-m-d H:i:s'),
      'user_id'   => $this->session->userdata('id_user')
    );

    $this->Merk->addNewData($datamerk);

    $merkid = $this->db->insert_id();

    $response = [
      'id'    => $merkid,
      'text'  => ucwords($nama)
    ];

    echo json_encode($response);
  }


  public function update()
  {
    $id     = $this->input->post('id');
    $merk   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('merk'))));

    $data = array(
      'nama_merk'     => strtolower($merk),
    );

    $where = array(
      'id_merk'   => $id
    );

    $data = $this->Merk->editMerk($data, $where);

    echo json_encode($data);
  }

  public function delete()
  {
    $id   = $this->input->post('idmerk');
    $data = $this->Merk->deleteMerk($id);

    echo json_encode($data);
  }
}
