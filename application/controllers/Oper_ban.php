<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oper_ban extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('OperBan_model', 'Oper');
    $this->load->model('PakaiBan_model', 'Pakai');
    $this->load->model('Ban_model', 'Ban');
    $this->load->model('Truck_model', 'Truck');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = 'Form Data Operan Ban';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/oper/index', $data);
  }

  public function getOper()
  {
    header('Content-Type: application/json');

    echo $this->Oper->getData();
  }

  public function allDataPakai()
  {
    $data['title']    = 'Data Detail Pemakaian Ban';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/oper/detail-pakai', $data);
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

  public function oper()
  {
    $kdpakai      = $this->input->post('kdpakai');
    $totpakai     = $this->input->post('totpakai');
    $tujuanid     = $this->input->post('tujuanid');
    $tujuan       = $this->input->post('tujuan');
    $asalid       = $this->input->post('asalid');
    $asal         = $this->input->post('asal');
    $detailid     = $this->input->post('detailpakai_id');
    $jml          = $this->input->post('jml');
    $jmloper      = $this->input->post('jmloper');
    $montir       = $this->input->post('montir');
    $ket          = $this->input->post('ket');
    $seri         = $this->input->post('noseri');
    $banid        = $this->input->post('banid');
    $merkid       = $this->input->post('merkid');
    $date         = date('Y-m-d H:i:s');
    $user         = $this->session->userdata('id_user');

    $min_oper     = $jml - $jmloper;
    $min_total    = $totpakai - $jmloper;

    $kdoper       = $this->Oper->cekKdOper();

    $dataoper = array(
      'kd_oper_ban'           => $kdoper,
      'kd_pakai_ban'          => $kdpakai,
      'detail_pakai_ban_id'   => $detailid,
      'oper_ban_id'           => $banid,
      'merk_ban_id'           => $merkid,
      'truck_asal_id'         => $asalid,
      'truck_oper_id'         => $tujuanid,
      'jml_ban_oper'          => $jmloper,
      'nama_montir_oper'      => $montir,
      'ket_oper_ban'          => $ket,
      'status_oper_ban'       => 'Belum dikembalikan',
      'tgl_oper_ban'          => $date,
      'tgl_kembali_oper_ban'  => '0000-00-00 00:00:00',
      'user_id'               => $user
    );

    $dataHistory = array(
      'kd_history_ban'    => $kdoper,
      'no_seri_history'   => $seri,
      'ket_history'       => "Dioper ke $tujuan, Dari $asal",
      'ket_trans'         => "$ket, Montir : $montir",
      'tgl_add_history'   => $date,
    );

    $kdpakai   = array(
      'kd_pakai_ban'  => $kdpakai
    );

    $totpakai = array(
      'total_pakai_ban' => $min_total
    );

    $where = array(
      'id_detail_pakai_ban' => $detailid
    );

    $jml = array(
      'jml_pakai_ban' => $min_oper,
      'status_pakai_ban' => "Dioper ke $tujuan"
    );

    $dataStok = array(
      'status_ban'  => "Dari $asal di oper ke $tujuan",
    );

    $noseri = array(
      'no_seri' => $seri
    );

    $this->Oper->addOper($dataStok, $noseri, $dataoper, $dataHistory);
    $this->Oper->updatePakai($totpakai, $kdpakai);
    $this->Oper->updateDetailPakai($jml, $where);

    $this->session->set_flashdata('success', 'Ban berhasil di oper!');

    redirect('oper_ban');
  }

  public function detailData($id)
  {
    $data['title']   = 'Detail Operan';
    $data['oper']    = $this->OperBan_model->getOperId($id);

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('transaksi-ban/detail-oper-ban', $data);
    $this->load->view('template/footer');
  }

  public function pengembalian()
  {
    $kd         = $this->input->post('kd');
    $datakd     = $this->Oper->getDetailOperKd($kd);

    $iddetail   = $datakd->detail_pakai_ban_id;
    $idoper     = $datakd->id_oper_ban;
    $seri       = $datakd->no_seri;
    $asal       = $datakd->asal;
    $tujuan     = $datakd->tujuan;
    $kdpakai    = $datakd->kd_pakai_ban;
    $kdoper     = $datakd->kd_oper_ban;
    $jmloper    = $datakd->jml_ban_oper;
    $date       = date('Y-m-d H:i:s');

    $cekkdpakai = preg_match("/tbk/i", $kdpakai);

    if ($cekkdpakai === 1) {

      $querydetail  = $this->Pakai->getJmlPakaiId($iddetail);
      $querypakai   = $this->Pakai->getTotPakaiKd($kdpakai);

      $operjml      = $jmloper - $jmloper;
      $totpakai     = $querypakai->total_pakai_ban + $jmloper;
      $jmlpakai     = $querydetail->jml_pakai_ban + $jmloper;

      $datakembalipakai = array(
        'total_pakai_ban' => $totpakai,
        'tgl_pakai_ban'   => $date
      );

      $datakembalidetail  = array(
        'jml_pakai_ban'     => $jmlpakai,
        'status_pakai_ban'  => 'Dipakai'
      );

      $dataoper = array(
        'jml_ban_oper'          => $operjml,
        'status_oper_ban'       => "Dikembalikan",
        'tgl_kembali_oper_ban'  => $date
      );

      $dataidoper  = array(
        'id_oper_ban' => $idoper
      );

      $datakdpinjam = array(
        'kd_pakai_ban' => $kdpakai
      );

      $datakddetail = array(
        'id_detail_pakai_ban' => $iddetail
      );

      $datahistori = array(
        'kd_history_ban'    => $kdoper,
        'no_seri_history'   => $seri,
        'ket_history'       => "Dikembalikan ke $asal",
        'ket_trans'         => "Dikembalikan oleh : " . $this->session->userdata('username'),
        'tgl_add_history'   => date('Y-m-d H:i:s'),
      );

      $dataStok = array(
        'status_ban'    => "Dari $tujuan di kembalikan ke $asal",
      );

      $noseri = array(
        'no_seri'      => $seri,
      );

      $data = $this->Oper->updateOper($datakembalipakai, $datakembalidetail, $dataoper, $dataidoper, $datakdpinjam, $datakddetail, $datahistori, $dataStok, $noseri);
    } elseif ($cekkdpakai === 0) {

      $datakembalioper = array(
        'jml_ban_oper'    => $jmloper,
        'status_oper_ban' => "Belum dikembalikan"
      );

      $dataidkembalioper = array(
        'kd_oper_ban' => $kdpakai
      );

      $dataupdateoper = array(
        'jml_ban_oper'    => 0,
        'status_oper_ban' => "Dikembalikan"
      );

      $kodeoper = array(
        'kd_oper_ban'   => $kd
      );

      $dthistori = array(
        'kd_history_ban'    => $kdoper,
        'no_seri_history'   => $seri,
        'ket_history'       => "Dikembalikan ke $asal",
        'ket_trans'         => "Dikembalikan oleh : " . $this->session->userdata('username'),
        'tgl_add_history'   => $date,
      );

      $dtstok = array(
        'status_ban'  => "Dari $tujuan di kembalikan ke $asal",
      );

      $dtnoseri = array(
        'no_seri' => $seri,
      );

      $data = $this->Oper->updateOperan($datakembalioper, $dataidkembalioper, $dthistori, $dataupdateoper, $kodeoper, $dtstok, $dtnoseri);
    }

    echo json_encode($data);
  }

  public function getDetailOperAgain()
  {
    $kd   = $this->input->post('kd');
    $data = $this->Oper->getDetailOperKd($kd);

    echo json_encode($data);
  }

  public function operLagi()
  {
    $kdopernew    = $this->Oper->cekKdOper();

    $detailid     = $this->input->post('detailid');
    $kdoper       = $this->input->post('kdoper');
    $operbanid    = $this->input->post('banid');
    $merbankid    = $this->input->post('merkid');
    $truckasalid  = $this->input->post('dari');
    $jmloper      = $this->input->post('jmlban');
    $noseri       = $this->input->post('seri');

    $ketoper      = $this->input->post('ket');
    $truckoperid  = $this->input->post('tujuanid');
    $truckoper    = $this->input->post('tujuan');
    $dari         = $this->input->post('daritruck');
    $montir       = $this->input->post('montir');
    $tgloper      = date('Y-m-d H:i:s');
    $tglkembali   = "0000-00-00 00:00:00";
    $userid       = $this->session->userdata('id_user');

    $dataoperlagi = array(
      'kd_oper_ban'           => $kdopernew,
      'kd_pakai_ban'          => $kdoper,
      'detail_pakai_ban_id'   => $detailid,
      'oper_ban_id'           => $operbanid,
      'merk_ban_id'           => $merbankid,
      'truck_asal_id'         => $truckasalid,
      'truck_oper_id'         => $truckoperid,
      'jml_ban_oper'          => $jmloper,
      'nama_montir_oper'      => $montir,
      'ket_oper_ban'          => $ketoper,
      'status_oper_ban'       => "Oper dari " . $dari,
      'tgl_oper_ban'          => $tgloper,
      'tgl_kembali_oper_ban'  => $tglkembali,
      'user_id'               => $userid
    );

    $updateolddataoper = array(
      'jml_ban_oper'      => 0,
      'status_oper_ban'   => "Di oper ke " . $truckoper,
      'user_id'           => $userid
    );

    $idoperold = array(
      'kd_oper_ban'   => $kdoper
    );

    $datahistori = array(
      'kd_history_ban'    => $kdopernew,
      'no_seri_history'   => $noseri,
      'ket_history'       => "Di Oper lagi ke " . $truckoper,
      'ket_trans'         => $ketoper,
      'tgl_add_history'   => date('Y-m-d H:i:s'),
    );

    $this->Oper->addOperan($dataoperlagi);
    $this->Oper->updateOldOper($updateolddataoper, $idoperold);
    $this->Oper->addHistory($datahistori);

    $response = array(
      'status'  => 'true',
      'messages'  => 'success'
    );

    echo json_encode($response);
  }

  public function kembaliGudang()
  {
    $id   = $this->input->post('id');
    $data = $this->Oper->getDataOperId($id);

    $whereban    = array(
      'id_ban'   => $data->id_ban,
    );

    $statusban      = array(
      'status_ban'  => 'Gudang',
    );

    $whereoperban   = array(
      'id_oper_ban' => $data->id_oper_ban,
    );

    $dataoper       = array(
      'jml_ban_oper'          => '0',
      'nama_montir_oper'      => $this->session->userdata('username'),
      'status_oper_ban'       => 'Dikembalikan ke gudang',
      'tgl_kembali_oper_ban'  => date('Y-m-d H:i:s'),
    );

    $dataHistory    = array(
      'kd_history_ban'    => $data->kd_oper_ban,
      'no_seri_history'   => $data->no_seri,
      'ket_history'       => 'Dikembalikan ke gudang',
      'ket_trans'         => 'Dikembalikan ke gudang',
      'tgl_add_history'   => date('Y-m-d H:i:s'),
    );

    $this->Oper->kembaligudang($statusban, $whereban, $dataoper, $whereoperban);
    $this->Oper->addHistory($dataHistory);

    $response = array(
      'status'  => 'true',
      'messages'  => 'success'
    );

    echo json_encode($response);
  }

  public function cetak($id)
  {
    $data['pakai']    = $this->PakaiBan_model->getData();
    $data['pinjam']   = $this->OperBan_model->getOperId($id);
    $this->load->view('laporan/cetak-pinjam', $data);
  }
}
