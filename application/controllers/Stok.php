<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

use Mpdf\Mpdf;

class Stok extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Stok_model', 'Stok');
    $this->load->model('Merk_model', 'Merk');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = "Stok Sparepart";

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('main/stok/part/index', $data);
  }

  public function getStok()
  {
    header('Content-Type: application/json');

    echo $this->Stok->getData();
  }

  public function getId()
  {
    $id   = $this->input->post('idstok');
    $data = $this->Stok->getId($id);

    echo json_encode($data);
  }

  public function getListStok()
  {
    $keyword = $this->input->get('q');

    if (!$keyword) {
      $data = $this->Stok->getDataStok();

      $response = [];
      foreach ($data as $stok) {
        $response[] = [
          'id'          => $stok->id_part,
          'text'        => ucwords($stok->jenis_part) . ' - ' . ucwords($stok->nama_merk),
          'namapart'    => ucwords($stok->jenis_part),
          'merkpart'    => ucwords($stok->nama_merk),
          'merkid'      => ucwords($stok->id_merk),
          'satuanpart'  => ucwords($stok->sat),
          'baru'        => ucwords($stok->part_baru),
          'bekas'       => ucwords($stok->part_bekas)
        ];
      }
    } else {
      $data = $this->Stok->getSearchDataStok($keyword);

      $response = [];
      foreach ($data as $stok) {
        $response[] = [
          'id'          => $stok->id_part,
          'text'        => ucwords($stok->jenis_part) . ' - ' . ucwords($stok->nama_merk),
          'namapart'    => ucwords($stok->jenis_part),
          'merkpart'    => ucwords($stok->nama_merk),
          'merkid'      => ucwords($stok->id_merk),
          'satuanpart'  => ucwords($stok->sat),
          'baru'        => ucwords($stok->part_baru),
          'bekas'       => ucwords($stok->part_bekas)
        ];
      }
    }

    echo json_encode($response);
  }

  public function create()
  {
    $nama   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('nama'))));
    $merk   = htmlspecialchars(trim($this->input->post('merk')));
    $baru   = htmlspecialchars(trim($this->input->post('baru')));
    $bekas  = htmlspecialchars(trim($this->input->post('bekas')));
    $sat    = htmlspecialchars(trim(preg_replace('/[^a-zA-Z\s]/', '', $this->input->post('satuan'))));
    $rak    = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('rak'))));

    $data = array(
      'merk_id'     => strtolower($merk),
      'jenis_part'  => strtolower($nama),
      'sat'         => strtolower($sat),
      'part_baru'   => strtolower($baru),
      'part_bekas'  => strtolower($bekas),
      'rak'         => strtolower($rak),
      'part_in'     => date('Y-m-d H:i:s'),
      'user_id'     => $this->session->userdata('id_user')
    );

    $data = $this->Stok->addStok($data);

    echo json_encode($data);
  }

  public function update()
  {
    $id     = $this->input->post('id');
    $nama   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('nama'))));
    $merk   = htmlspecialchars(trim($this->input->post('merk')));
    $baru   = htmlspecialchars(trim($this->input->post('baru')));
    $bekas  = htmlspecialchars(trim($this->input->post('bekas')));
    $sat    = htmlspecialchars(trim(preg_replace('/[^a-zA-Z\s]/', '', $this->input->post('satuan'))));
    $rak    = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('rak'))));

    $data = array(
      'merk_id'     => strtolower($merk),
      'jenis_part'  => strtolower($nama),
      'sat'         => strtolower($sat),
      'part_baru'   => strtolower($baru),
      'part_bekas'  => strtolower($bekas),
      'rak'         => strtolower($rak),
      'part_edit'   => date('Y-m-d H:i:s'),
      'user_id'     => $this->session->userdata('id_user')
    );

    $where = array(
      'id_part'   => $id
    );

    $data = $this->Stok->editStok($data, $where);

    echo json_encode($data);
  }

  public function delete()
  {
    $id   = $this->input->post('idstok');
    $data = $this->Stok->deleteStok($id);

    echo json_encode($data);
  }

  public function addSelect()
  {
    $nama     = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('nama'))));
    $merknama = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('merknama'))));
    $merk     = trim($this->input->post('merk'));
    $baru     = trim($this->input->post('baru'));
    $bekas    = trim($this->input->post('bekas'));
    $satuan   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('satuan'))));
    $rak      = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('rak'))));

    $datapart = array(
      'jenis_part'  => strtolower($nama),
      'merk_id'     => $merk,
      'part_baru'   => $baru,
      'part_bekas'  => $bekas,
      'sat'         => strtolower($satuan),
      'rak'         => strtolower($rak),
      'part_in'     => date('Y-m-d H:i:s'),
      'user_id'     => $this->session->userdata('id_user'),
    );

    $this->Stok->addNewData($datapart);

    $partid = $this->db->insert_id();

    $response = [
      'id'        => $partid,
      'text'      => ucwords($nama),
      'merk'      => ucwords($merk),
      'merknama'  => ucwords($merknama),
      'satuan'    => ucwords($satuan)
    ];

    echo json_encode($response);
  }

  public function riwayat($id)
  {
    $this->load->library('pagination');

    $config['base_url']     = 'http://localhost/hira/stok/riwayat/' . $id;

    $config['total_rows']   = $this->Stok->getRowsHistory($id);
    $config['per_page']     = 10;
    $config['uri_segment']  = 4;

    $this->pagination->initialize($config);

    $start              = $this->uri->segment(4);
    $data['id']         = $id;

    $data['title']      = "Riwayat Sparepart";
    $data['stok']       = $this->Stok->getId($id);
    $data['history']    = $this->Stok->getHistory($id, $config['per_page'], $start);

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('main/stok/part/history', $data);
    $this->load->view('template/footer');
  }

  public function print()
  {
    $data['stok'] = $this->Stok->getStok();

    $content      = $this->load->view('main/stok/part/print', $data, true);

    $mpdf = new Mpdf();

    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }
}
