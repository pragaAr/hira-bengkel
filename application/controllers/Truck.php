<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Truck extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Truck_model', 'Truck');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']  = 'Data Truck';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('main/truck', $data);
  }

  public function getTruck()
  {
    header('Content-Type: application/json');

    echo $this->Truck->getData();
  }

  public function getId()
  {
    $id   = $this->input->post('idtruck');
    $data = $this->Truck->getId($id);

    echo json_encode($data);
  }

  public function getListTruck()
  {
    $keyword = $this->input->get('q');

    if (!$keyword) {
      $data = $this->Truck->getDataTruck();

      $response = [];
      foreach ($data as $truck) {
        $response[] = [
          'id'          => $truck->id_truck,
          'text'        => ucwords($truck->plat_no_truck),
          'merktruck'   => ucwords($truck->merk_truck),
        ];
      }
    } else {
      $data = $this->Truck->getSearchDataTruck($keyword);

      $response = [];
      foreach ($data as $truck) {
        $response[] = [
          'id'          => $truck->id_truck,
          'text'        => ucwords($truck->plat_no_truck),
          'merktruck'   => ucwords($truck->merk_truck),
        ];
      }
    }

    echo json_encode($response);
  }

  public function create()
  {
    $platno   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('platno'))));
    $merk     = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('merk'))));
    $jenis    = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('jenis'))));

    $data = array(
      'plat_no_truck' => strtolower($platno),
      'merk_truck'    => strtolower($merk),
      'jenis_truck'   => strtolower($jenis),
      'truck_in'      => date('Y-m-d H:i:s'),
      'user_id'       => $this->session->userdata('id_user')
    );

    $data = $this->Truck->addTruck($data);

    echo json_encode($data);
  }

  public function update()
  {
    $id       = $this->input->post('id');
    $platno   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('platno'))));
    $merk     = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('merk'))));
    $jenis    = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('jenis'))));

    $data = array(
      'plat_no_truck' => strtolower($platno),
      'merk_truck'    => strtolower($merk),
      'jenis_truck'   => strtolower($jenis),
    );

    $where = array(
      'id_truck'   => $id
    );

    $data = $this->Truck->editTruck($data, $where);

    echo json_encode($data);
  }

  public function delete()
  {
    $id   = $this->input->post('idtruck');
    $data = $this->Truck->deleteTruck($id);

    echo json_encode($data);
  }

  public function riwayat($id)
  {
    $data['title']          = "Riwayat Truck";
    $data['truck']          = $this->Truck_model->getTruckId($id);
    $data['historyPart']    = $this->Truck_model->getHistoryPart($id);
    $data['historyBan']     = $this->Truck_model->getHistoryBan($id);

    $this->load->view('template/header');
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('main/truck/history', $data);
  }

  public function searchPart()
  {
    $id       = $this->input->post('id_truck');
    $keyword  = $this->input->post('jenis_part');
    $data     = $this->Truck_model->getSearchPart($id, $keyword);
    echo json_encode($data);
  }

  public function searchBan()
  {
    $id       = $this->input->post('id_truck');
    $keyword  = $this->input->post('no_seri');
    $data     = $this->Truck_model->getSearchBan($id, $keyword);
    echo json_encode($data);
  }

  public function getTruckId()
  {
    $id = $this->input->post('id_truck');
    $data = $this->Truck_model->getTruckId($id);

    echo json_encode($data);
  }
}
