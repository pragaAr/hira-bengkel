<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

use Mpdf\Mpdf;

class Ban extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Ban_model', 'Ban');
    $this->load->model('Movement_model', 'Movement');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data = [
      'title' => 'Stok Ban'
    ];

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('main/stok/ban/index', $data);
    $this->load->view('template/footer');
  }

  public function getBan()
  {
    header('Content-Type: application/json');

    echo $this->Ban->getData();
  }

  public function getDataBanVulk()
  {
    $key  = $this->input->get('q');

    $data = !$key ? $this->Ban->selectBan() : $this->Ban->selectSearchBan($key);

    $res  = [];

    foreach ($data as $ban) {
      $res[] = [
        'id' => $ban->id_ban,
        'text' => strtoupper($ban->no_seri),
        'merk' => strtoupper($ban->nama_merk),
        'size' => strtoupper($ban->ukuran_ban),
      ];
    }

    echo json_encode($res);
  }

  public function getId()
  {
    $id = $this->input->post('noseri');

    $query = $this->Ban->getId($id);

    echo json_encode($query);
  }

  public function getListBan()
  {
    $key  = $this->input->get('q');

    $data = !$key ? $this->Ban->getDataBan() : $this->Ban->getSearchDataBan($key);

    $res  = [];

    foreach ($data as $ban) {
      $res[] = [
        'id'      => $ban->id_ban,
        'text'    => ucwords($ban->no_seri) . ' - ' . ucwords($ban->nama_merk),
        'noseri'  => ucwords($ban->no_seri),
        'merkban' => ucwords($ban->nama_merk),
        'merkid'  => ucwords($ban->id_merk),
        'stat'    => ucwords($ban->vulk),
        'ukuran'  => ucwords($ban->ukuran_ban),
      ];
    }

    echo json_encode($res);
  }

  public function riwayat($id)
  {
    $data = [
      'title'   => "Riwayat Ban",
      'ban'     => $this->Ban->getId($id),
      'history' => $this->Ban->getHistory($id),
    ];

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('main/stok/ban/history', $data);
    $this->load->view('template/footer');
  }

  public function ubahKondisi()
  {
    $data = [
      'no_seri'   => $this->input->post('seri'),
      'merk'      => $this->input->post('merk'),
      'ukuran'    => $this->input->post('ukuran'),
      'movement'  => $this->input->post('aksi'),
      'tgl_move'  => date('Y-m-d H:i:s'),
      'user_id'   => $this->session->userdata('id_user')
    ];

    $noseri = [
      'no_seri' => $this->input->post('seri')
    ];

    $query = $this->Movement->addMove($data, $noseri);

    echo json_encode($query);
  }

  public function print()
  {
    $data = [
      'ban' => $this->Ban->getBan()
    ];

    $content = $this->load->view('main/stok/ban/print', $data, true);

    $mpdf = new Mpdf();

    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }
}
