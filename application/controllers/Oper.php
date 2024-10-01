<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Oper extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Oper_model', 'Oper');
    $this->load->model('Pakai_model', 'Pakai');
    $this->load->model('Stok_model', 'Stok');
    $this->load->model('Truck_model', 'Truck');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = 'Data Operan Sparepart';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/oper/index', $data);
  }

  public function getOper()
  {
    header('Content-Type: application/json');

    echo $this->Oper->getData();
  }

  public function allDataPakai()
  {
    $data['title']    = 'Detail Pemakaian Sparepart';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/oper/detail-pakai', $data);
  }

  public function getPakaiAll()
  {
    header('Content-Type: application/json');

    echo $this->Pakai->getAllPakai();
  }

  public function getDetailPakaiForOper()
  {
    $id   = $this->input->post('id');
    $data = $this->Pakai->getDetailAllPakai($id);

    echo json_encode($data);
  }

  public function getDetailOperAgain()
  {
    $kd   = $this->input->post('kd');
    $data = $this->Oper->getOperkd($kd);

    echo json_encode($data);
  }

  public function operPart()
  {
    $kdpakai    = $this->input->post('kdpakai');
    $detailid   = $this->input->post('detailpakai_id');
    $totpakai   = $this->input->post('totpakai');
    $rowpakai   = $this->input->post('jml');
    $jml        = $this->input->post('jmloper');
    $asalid     = $this->input->post('asalid');
    $asal       = $this->input->post('asal');
    $tujuanid   = $this->input->post('tujuanid');
    $tujuan     = $this->input->post('tujuan');
    $partid     = $this->input->post('partid');
    $sat        = $this->input->post('sat');
    $merkid     = $this->input->post('merkid');
    $montir     = $this->input->post('montir');
    $ket        = $this->input->post('ket');
    $date       = date('Y-m-d H:i:s');
    $user       = $this->session->userdata('id_user');
    $min_total  = $totpakai - $jml;
    $min_pakai  = $rowpakai - $jml;

    $kdoper = $this->Oper->cekKdOper();

    $dataoper = array(
      'kd_oper'           => $kdoper,
      'kd_pakai'          => $kdpakai,
      'detail_pakai_id'   => $detailid,
      'part_id'           => $partid,
      'merk_id'           => $merkid,
      'truck_asal_id'     => $asalid,
      'truck_oper_id'     => $tujuanid,
      'jml_oper'          => $jml,
      'nama_montir_oper'  => $montir,
      'ket_oper'          => $ket,
      'status_oper'       => 'Belum dikembalikan',
      'tgl_oper'          => $date,
      'tgl_kembali_oper'  => '0000-00-00 00:00:00',
      'user_id'           => $user
    );

    $datahistory = array(
      'kd_history_part'     => $kdoper,
      'part_history_id'     => $partid,
      'ket_history_part'    => "Dipakai " . $asal . " " . $rowpakai . " " . $sat . ", Dioper ke " . $tujuan . " " . $jml . " " . $sat,
      'ket_trans_part'      => $ket . ", Montir : " . $montir,
      'tgl_part_history'    => $date,
    );

    $wherekdpakai   = array(
      'kd_pakai' => $kdpakai
    );

    $totpakai = array(
      'total_pakai'   => $min_total
    );

    $pakai = array(
      'jml_pakai'     => $min_pakai,
      'status_pakai'  => $min_pakai == 0 ? 'Di Oper Semua' : 'Di Pakai'
    );

    $where = array(
      'id_detail_pakai'  => $detailid
    );

    $this->Oper->addOper($dataoper, $datahistory);
    $this->Oper->updatePakai($totpakai, $wherekdpakai);
    $this->Oper->updateDetailPakai($pakai, $where);

    $this->session->set_flashdata('success', 'Sparepart berhasil di oper!');

    redirect('oper');
  }

  public function detail($kd)
  {
    $data['title']  = 'Detail Operan';
    $data['kd']     = $kd;
    $data['oper']   = $this->Oper->getDetailOperkd($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/part/oper/detail', $data);
    $this->load->view('template/footer');
  }

  public function operLagi()
  {
    $kdpakai    = $this->input->post('kdpakai');
    $detailid   = $this->input->post('detailid');
    $rowpakai   = $this->input->post('jml');
    $jml        = $this->input->post('jmloper');
    $asalid     = $this->input->post('asalid');
    $asal       = $this->input->post('asal');
    $tujuanid   = $this->input->post('tujuanid');
    $tujuan     = $this->input->post('tujuan');
    $partid     = $this->input->post('partid');
    $sat        = $this->input->post('sat');
    $merkid     = $this->input->post('merkid');
    $montir     = $this->input->post('montir');
    $ket        = $this->input->post('ket');
    $date       = date('Y-m-d H:i:s');
    $user       = $this->session->userdata('id_user');
    $min_pakai  = $rowpakai - $jml;

    $kdoper     = $this->Oper->cekKdOper();

    $dataoper = array(
      'kd_oper'           => $kdoper,
      'kd_pakai'          => $kdpakai,
      'detail_pakai_id'   => $detailid,
      'part_id'           => $partid,
      'merk_id'           => $merkid,
      'truck_asal_id'     => $asalid,
      'truck_oper_id'     => $tujuanid,
      'jml_oper'          => $jml,
      'nama_montir_oper'  => $montir,
      'ket_oper'          => $ket,
      'status_oper'       => "Di Oper dari " . $asal,
      'tgl_oper'          => $date,
      'tgl_kembali_oper'  => '0000-00-00 00:00:00',
      'user_id'           => $user
    );

    $updateoldoper = array(
      'jml_oper'      => $min_pakai,
      'status_oper'   => "Di oper ke " . $tujuan,
      'user_id'       => $user
    );

    $kdoperold = array(
      'kd_oper'   => $kdpakai
    );

    $historyoper = array(
      'kd_history_part'     => $kdoper,
      'part_history_id'     => $partid,
      'ket_history_part'    => "Di Oper dari " . $asal,
      'ket_trans_part'      => "Di oper ke " . $tujuan . ", " . "Montir : " . $montir,
      'tgl_part_history'    => $date,
    );

    $data = $this->Oper->addOperan($dataoper, $historyoper, $updateoldoper, $kdoperold);

    echo json_encode($data);
  }

  public function pengembalian()
  {
    $kd         = $this->input->post('kd');

    $datakd     = $this->Oper->getDetailOperKd($kd);

    $iddetail   = $datakd->detail_pakai_id;
    $idoper     = $datakd->id_oper;
    $part       = $datakd->id_part;
    $truckasal  = $datakd->asal;
    $truckoper  = $datakd->tujuan;
    $kdpakai    = $datakd->kd_pakai;
    $kdoper     = $datakd->kd_oper;
    $jmloper    = $datakd->jml_oper;
    $date       = date('Y-m-d H:i:s');

    $cekkdpakai = preg_match("/trk/i", $kdpakai);

    if ($cekkdpakai == 1) {

      $querydetail  = $this->Pakai->getJmlPakaiId($iddetail);
      $querypakai   = $this->Pakai->getTotPakaiId($kdpakai);

      $operjml      = $jmloper - $jmloper;
      $totpakai     = $querypakai->total_pakai + $jmloper;
      $jmlpakai     = $querydetail->jml_pakai + $jmloper;

      $datakembalipakai = array(
        'total_pakai' => $totpakai,
        'tgl_pakai'   => $date
      );

      $datakembalidetail = array(
        'jml_pakai'     => $jmlpakai,
        'status_pakai'  => 'Di pakai',
      );

      $dataoper = array(
        'jml_oper'          => $operjml,
        'status_oper'       => "Dikembalikan",
        'tgl_kembali_oper'  => $date
      );

      $dataidoper  = array(
        'id_oper' => $idoper
      );

      $datakdpinjam = array(
        'kd_pakai' => $kdpakai
      );

      $datakddetail = array(
        'id_detail_pakai' => $iddetail
      );

      $history = array(
        'kd_history_part'   => $kdoper,
        'part_history_id'   => $part,
        'ket_history_part'  => "Dari " . $truckasal . " " . "Dioper ke " . $truckoper,
        'ket_trans_part'    => "Dikembalikan ke " . $truckasal,
        'tgl_part_history'  => $date,
      );

      $data = $this->Oper->updateOper($datakembalipakai, $datakembalidetail, $dataoper, $dataidoper, $datakdpinjam, $datakddetail, $history);
    } elseif ($cekkdpakai == 0) {

      $datakembalioper = array(
        'jml_oper'    => $jmloper,
        'status_oper' => "Belum dikembalikan"
      );

      $dataidkembalioper = array(
        'kd_oper' => $kdpakai
      );

      $dataupdateoper = array(
        'jml_oper'    => 0,
        'status_oper' => "Dikembalikan"
      );

      $kodeoper = array(
        'kd_oper'   => $kd
      );

      $history = array(
        'kd_history_part'   => $kdoper,
        'part_history_id'   => $part,
        'ket_history_part'  => "Dari " . $truckasal . " " . "Dioper ke " . $truckoper,
        'ket_trans_part'    => "Dikembalikan ke " . $truckasal,
        'tgl_part_history'  => $date,
      );

      $data = $this->Oper->updateOperan($datakembalioper, $dataidkembalioper, $dataupdateoper, $kodeoper, $history);
    }

    echo json_encode($data);
  }
}
