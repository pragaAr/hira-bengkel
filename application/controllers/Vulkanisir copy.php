<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');


use Mpdf\Mpdf;

class Vulkanisir extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('Vulkanisir_model', 'Vulk');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']  = 'Data Vulkanisir';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/vulk/index', $data);
  }

  public function getVulkanisir()
  {
    header('Content-Type: application/json');

    echo $this->Vulk->getData();
  }

  public function addData()
  {
    $data['title']  = 'Form Tambah Data Vulkanisir';
    $data['kd']     = $this->Vulk->cekKd();

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/vulk/add', $data);
  }

  public function proses()
  {
    $jmlvulk  = count($this->input->post('banid_hidden'));

    $kdvulk   = $this->input->post('kd');
    $tokoid   = $this->input->post('tokoid');
    $toko     = $this->input->post('toko');
    $total    = $this->input->post('totalban_hidden');
    $date     = date('Y-m-d H:i:s', strtotime($this->input->post('tgl') . ' ' . date('H:i:s')));
    $banid    = $this->input->post('banid_hidden');
    $size     = $this->input->post('size_hidden');
    $noseri   = $this->input->post('noseri_hidden');
    $jml      = $this->input->post('jml_hidden');
    $merk     = $this->input->post('merk_hidden');
    $ket      = $this->input->post('ket_hidden');

    $data_vulk = [
      'kd_vulk'           => $kdvulk,
      'tempat_vulk'       => $tokoid,
      'jml_total_vulk'    => $total,
      'tgl_vulk'          => $date,
    ];

    $detail_vulk = [];

    for ($i = 0; $i < $jmlvulk; $i++) {
      array_push($detail_vulk, ['no_seri_vulk'  => $noseri[$i]]);
      $detail_vulk[$i]['kd_vulk']             = $kdvulk;
      $detail_vulk[$i]['merk_vulk']           = $merk[$i];
      $detail_vulk[$i]['jml_vulk']            = $jml[$i];
      $detail_vulk[$i]['ukuran_ban_vulk']     = $size[$i];
      $detail_vulk[$i]['status']              = 0;
      $detail_vulk[$i]['no_nota']             = '';
      $detail_vulk[$i]['tgl_update']          = '0000-00-00 00:00:00';
    }

    $historyVulk = [];

    for ($k = 0; $k < $jmlvulk; $k++) {
      array_push($historyVulk,  ['kd_history_ban' => $kdvulk]);
      $historyVulk[$k]['no_seri_history']   = $noseri[$k];
      $historyVulk[$k]['ket_history']       =  "Divulkanisir di " . $toko;
      $historyVulk[$k]['ket_trans']         = $ket[$k];
      $historyVulk[$k]['tgl_add_history']   = $date;
      $historyVulk[$k]['user_history']      = $this->session->userdata('username');
    }

    $update_ban = [];

    for ($j = 0; $j < $jmlvulk; $j++) {
      array_push($update_ban, ['id_ban'   => $banid[$j]]);
      $update_ban[$j]['status_ban']       = "Divulkanisir di " . $toko;
      $update_ban[$j]['date_ban_update']  = $date;
    }

    $this->Vulk->addData($data_vulk, $detail_vulk, $update_ban);
    $this->Vulk->addHistory($historyVulk);

    $this->session->set_flashdata('success', 'Ban berhasil divulkanisir');

    redirect('vulkanisir');
  }

  public function selesai()
  {
    $data['title']    = 'Form Selesai Vulkanisir';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/vulk/selesai', $data);
  }

  public function getDataByTempat()
  {
    $id   = $this->input->post('tempat');
    $data = $this->Vulk->getVulkByTempat($id);

    echo json_encode($data);
  }

  public function getDataBan()
  {
    $seri   = $this->input->post('seri');
    $data   = $this->Vulk->getBanBySeri($seri);

    echo json_encode($data);
  }

  public function prosesselesai()
  {
    $jml        = count($this->input->post('seri_hidden'));

    $seri       = $this->input->post('seri_hidden');
    $merk       = $this->input->post('merk_hidden');
    $size       = $this->input->post('size_hidden');
    $jmlban     = $this->input->post('jml_hidden');
    $ongkos     = $this->input->post('biaya_hidden');
    $kdvulk     = $this->input->post('kdvulk');
    $tokoid     = $this->input->post('tempat');
    $toko       = $this->input->post('toko');
    $biaya      = preg_replace("/[^0-9\.]/", "", $this->input->post('total_hidden'));
    $pay        = $this->input->post('pay');
    $nota       = $this->input->post('nota');
    $user       = $this->session->userdata('id_user');
    $date       = date('Y-m-d H:i:s', strtotime($this->input->post('tglselesai') . ' ' . date('H:i:s')));
    $currjmlvulk  = $this->input->post('jmlvulk_hidden');

    $vulkDone = array(
      'no_nota'           => $nota,
      'kd_vulk'           => $kdvulk,
      'tempat_vulk'       => $tokoid,
      'biaya'             => $biaya,
      'pembayaran'        => $pay,
      'jml_vulk_selesai'  => $jml,
      'tgl_selesai'       => $date,
      'user_id'           => $user,
    );

    $vulkDoneItems = [];

    for ($i = 0; $i < $jml; $i++) {
      array_push($vulkDoneItems, ['kd_vulk' => $kdvulk]);
      $vulkDoneItems[$i]['no_seri']         = $seri[$i];
      $vulkDoneItems[$i]['merk']            = $merk[$i];
      $vulkDoneItems[$i]['jml']             = $jmlban[$i];
      $vulkDoneItems[$i]['ukuran']          = $size[$i];
      $vulkDoneItems[$i]['ongkos']          = $ongkos[$i];
    }

    $updateDetailStatus = [];

    for ($j = 0; $j < $jml; $j++) {
      array_push($updateDetailStatus, ['no_seri_vulk' => $seri[$j]]);
      $updateDetailStatus[$j]['kd_vulk']             = $kdvulk[$j];
      $updateDetailStatus[$j]['merk_vulk']           = $merk[$j];
      $updateDetailStatus[$j]['jml_vulk']            = $jmlban[$j];
      $updateDetailStatus[$j]['ukuran_ban_vulk']     = $size[$j];
      $updateDetailStatus[$j]['status']              = 1;
      $updateDetailStatus[$j]['no_nota']             = $nota;
      $updateDetailStatus[$j]['tgl_update']          = $date;
    }

    $historyVulk = [];

    for ($k = 0; $k < $jml; $k++) {
      array_push($historyVulk,  ['kd_history_ban' => $kdvulk]);
      $historyVulk[$k]['no_seri_history']   = $seri[$k];
      $historyVulk[$k]['ket_history']       = "Selesai Vulkanisir dari " . $toko;
      $historyVulk[$k]['ket_trans']         = "Vulkanisir Selesai";
      $historyVulk[$k]['tgl_add_history']   = $date;
      $historyVulk[$k]['user_history']      = $user;
    }

    $updateStatusBan = [];

    for ($l = 0; $l < $jml; $l++) {
      array_push($updateStatusBan, ['no_seri' => $seri[$l]]);
      $updateStatusBan[$l]['vulk']             = 1;
      $updateStatusBan[$l]['status_ban']       = "Gudang";
      $updateStatusBan[$l]['sudah_vulk']       = intval($currjmlvulk) + 1;
      $updateStatusBan[$l]['date_ban_update']  = $date;
    }

    $this->Vulk->addDataDone($vulkDone, $vulkDoneItems);
    $this->Vulk->updateDetailStatus($updateDetailStatus);
    $this->Vulk->updateStatusBan($updateStatusBan);
    $this->Vulk->addHistoryVulkDone($historyVulk);

    $this->session->set_flashdata('success', 'Vulkanisir berhasil diupdate');

    redirect('vulkanisir');
  }

  public function allDetailVulk()
  {
    $data['title']    = 'Detail Vulkanisir';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/vulk/detail-all', $data);
  }

  public function getAllDetail()
  {
    header('Content-Type: application/json');

    echo $this->Vulk->getDetailAllVulk();
  }

  public function allDetailVulkDone()
  {
    $data['title']    = 'Detail Vulkanisir Selesai';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('trans/ban/vulk/detail-all-done', $data);
  }

  public function getAllDetailDone()
  {
    header('Content-Type: application/json');

    echo $this->Vulk->getDetailAllVulkDone();
  }

  public function detail()
  {
    $kd     = $this->input->post('kd');
    $head   = $this->Vulk->getVulkKd($kd);
    $detail = $this->Vulk->getDetailByKd($kd);

    $response = array(
      'kdvulk'  => strtoupper($head->kd_vulk),
      'tglvulk' => date('d/m/Y', strtotime($head->tgl_vulk)),
      'tempat'  => strtoupper($head->nama_toko),
      'detail'  => $detail
    );

    echo json_encode($response);
  }

  public function getNota()
  {
    $keyword = $this->input->get('q');

    if (!$keyword) {

      $data = $this->Vulk->selectNota();

      $response = [];
      foreach ($data as $nota) {
        $response[] = [
          'id' => $nota->id_vulk_done,
          'text' => strtoupper($nota->no_nota),
        ];
      }

      echo json_encode($response);
    } else {
      $data = $this->Vulk->selectSearcNota($keyword);

      $response = [];
      foreach ($data as $nota) {
        $response[] = [
          'id' => $nota->id_vulk_done,
          'text' => strtoupper($nota->no_nota),
        ];
      }

      echo json_encode($response);
    }
  }

  public function printDo()
  {
    $nota     = $this->input->post('nota');

    $data['head']     = $this->Vulk->getKdByNota($nota);
    $data['detail']   = $this->Vulk->getDataByNota($nota);
    $do = strtoupper($nota);

    $content  = $this->load->view('trans/ban/vulk/print-selesai', $data, true);

    $mpdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'orientation' => 'L'
    ]);

    $mpdf->SetHTMLFooter("<p class='page-number-footer'>...Nota: $do | Halaman {PAGENO} dari {nb}...</p>");
    $mpdf->AddPage();
    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }

  public function suratJalanKeluar($kd)
  {
    $data['head']     = $this->Vulk->getVulkKd($kd);
    $data['dtvulk']   = $this->Vulk->getDataSuratJalan($kd);

    $do = strtoupper($kd);

    $content  = $this->load->view('trans/ban/vulk/print-sj', $data, true);

    $mpdf = new Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'orientation' => 'L'
    ]);

    $mpdf->SetHTMLFooter("<p class='page-number-footer'>...Kd: $do | Halaman {PAGENO} dari {nb}...</p>");
    $mpdf->AddPage();
    $mpdf->WriteHTML($content);

    $mpdf->Output();
  }

  public function delete()
  {
    $kd   = $this->input->post('kd');

    $seri = $this->Vulk->getBanVulkSeri($kd);

    $updateban = [];

    foreach ($seri as $res) {
      $updateban[] = array(
        'no_seri'     => $res['no_seri_vulk'],
        'status_ban'  => "Gudang",
        'sudah_vulk'  => intval($res['sudah_vulk']) - 1,
      );
    }

    $this->Vulk->delete($kd);
    $data = $this->Vulk->updateStatus($updateban);

    echo json_encode($data);
  }
}
