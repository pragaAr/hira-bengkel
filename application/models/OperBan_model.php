<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OperBan_model extends CI_Model
{

  public function cekKdOper()
  {
    $date = date('mdYHis');
    $tr   = "opr-";
    $kd   = $tr .  $date;

    return $kd;
  }

  public function getData()
  {
    $this->datatables->select('
                              a.id_oper_ban, a.kd_oper_ban, a.kd_pakai_ban, a.jml_ban_oper, 
                              a.nama_montir_oper as montir, a.status_oper_ban, a.tgl_oper_ban, 
                              b.plat_no_truck as truckasal, b.merk_truck as merkasal, 
                              c.plat_no_truck as trucktujuan, c.merk_truck as merktujuan, 
                              d.no_seri, d.ukuran_ban, e.nama_merk
                              ')
      ->from('oper_ban a')
      ->join('truck b', 'b.id_truck = a.truck_asal_id')
      ->join('truck c', 'c.id_truck = a.truck_oper_id')
      ->join('ban d', 'd.id_ban = a.oper_ban_id', 'left')
      ->join('merk e', 'e.id_merk = a.merk_ban_id', 'left')

      ->add_column(
        'view',
        '<div class="btn-group" role="group"> 
     
      </div>',
        'id_oper_ban, kd_oper_ban, kd_pakai_ban, montir, jml_ban_oper, status_oper_ban, tgl_oper_ban, truckasal, merkasal, trucktujuan, merktujuan, no_seri, ukuran_ban, nama_merk'
      );

    $results = $this->datatables->generate();

    $data = json_decode($results, true);

    foreach ($data['data'] as &$row) {

      if ($row['jml_ban_oper'] != 0) {

        $row['view'] = '<div class="btn-group" role="group">
                            <a href="javascript:void(0);" class="btn btn-sm border border-light btn-info text-white btn-kembali" title="Kembalikan" data-kd="' . $row['kd_oper_ban'] . '">
                              <i class="fas fa-angle-double-right fa-sm"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm border border-light btn-warning text-white btn-operan" title="Oper Lagi" data-kd="' . $row['kd_oper_ban'] . '">
                              <i class="fas fa-retweet fa-sm"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm border border-light btn-danger text-white btn-kembali-gudang" title="Kembalikan ke gudang" data-id="' . $row['id_oper_ban'] . '">
                              <i class="fas fa-home fa-sm"></i>
                            </a>
                           
                          </div>';
      } else {
        $row['view'] = '<div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm border border-light btn-secondary text-white" disabled>
                              <i class="fas fa-comment-dots fa-sm"></i>
                            </button>
                          </div>';
      }
    }

    $results = json_encode($data);

    echo $results;
  }

  public function getDetailOperKd($kd)
  {
    $this->db->select('
                      a.id_oper_ban, a.kd_oper_ban, a.kd_pakai_ban, 
                      a.truck_oper_id as asalid, a.merk_ban_id, a.detail_pakai_ban_id, 
                      a.jml_ban_oper, a.nama_montir_oper, 
                      a.ket_oper_ban, a.status_oper_ban, a.tgl_oper_ban, a.tgl_kembali_oper_ban, 
                      b.plat_no_truck as asal, b.merk_truck as merkasal, b.jenis_truck as jenisasal, 
                      c.plat_no_truck as tujuan, c.merk_truck merktujuan, c.jenis_truck jenistujuan, 
                      d.id_ban, d.no_seri, d.ukuran_ban, e.nama_merk merk, f.id_user
                      ')
      ->from('oper_ban a')
      ->join('truck b', 'b.id_truck = a.truck_asal_id')
      ->join('truck c', 'c.id_truck = a.truck_oper_id')
      ->join('ban d', 'd.id_ban = a.oper_ban_id', 'left')
      ->join('merk e', 'e.id_merk = a.merk_ban_id', 'left')
      ->join('user f', 'f.id_user = a.user_id', 'left')
      ->join('detail_pakai_ban g', 'g.id_detail_pakai_ban = a.detail_pakai_ban_id', 'left')
      ->where('a.kd_oper_ban', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getOperkd($kd)
  {
    $this->db->select('*')
      ->from('oper_ban')
      ->join('ban', 'ban.id_ban = oper_ban.oper_ban_id', 'left')
      ->join('merk', 'merk.id_merk = oper_ban.merk_ban_id', 'left')
      ->join('truck', 'truck.id_truck = oper_ban.truck_oper_id', 'left')
      ->join('detail_pakai_ban', 'detail_pakai_ban.id_detail_pakai_ban = oper_ban.detail_pakai_ban_id', 'left')
      ->where(['oper_ban.kd_oper_ban' => $kd]);

    $query = $this->db->get();

    return $query->row_array();
  }

  public function getOperanId($id)
  {
    $this->db->select('*')
      ->from('oper_ban')
      ->join('ban', 'ban.id_ban = oper_ban.oper_ban_id', 'left')
      ->join('merk', 'merk.id_merk = oper_ban.merk_ban_id', 'left')
      ->join('truck', 'truck.id_truck = oper_ban.truck_oper_id', 'left')
      ->join('detail_pakai_ban', 'detail_pakai_ban.id_detail_pakai_ban = oper_ban.detail_pakai_ban_id', 'left')
      ->where(['oper_ban.id_oper_ban' => $id]);

    $query = $this->db->get();

    return $query->row();
  }

  public function getOperId($id)
  {
    $this->db->select('
                      b.id_ban, b.no_seri, b.ukuran_ban, 
                      c.plat_no_truck truck_asal_id, c.merk_truck merk_truck_asal, c.jenis_truck jenis_truck_asal, 
                      d.plat_no_truck truck_oper_id, d.merk_truck merk_truck_oper, d.jenis_truck jenis_truck_oper, 
                      a.id_oper_ban, a.kd_oper_ban, 
                      h.kd_pakai_ban, a.detail_pakai_ban_id, 
                      e.no_seri oper_ban_id, 
                      f.nama_merk merk_id, a.jml_ban_oper, a.nama_montir_oper, a.ket_oper_ban, 
                      a.status_oper_ban, a.tgl_oper_ban, a.tgl_kembali_oper_ban, 
                      g.id_user user_id
                      ')
      ->from('oper_ban a')
      ->where(['a.id_oper_ban' => $id])
      ->join('ban b', 'b.id_ban = a.oper_ban_id')
      ->join('truck c', 'c.id_truck = a.truck_asal_id')
      ->join('truck d', 'd.id_truck = a.truck_oper_id')
      ->join('ban e', 'e.id_ban = a.oper_ban_id', 'left')
      ->join('merk f', 'f.id_merk = a.merk_ban_id', 'left')
      ->join('user g', 'g.id_user = a.user_id', 'left')
      ->join('detail_pakai_ban h', 'h.id_detail_pakai_ban = a.detail_pakai_ban_id', 'left');

    $query = $this->db->get();

    return $query->row_array();
  }

  public function getDataOperId($id)
  {
    $this->db->select('*')
      ->from('oper_ban')
      ->join('ban', 'ban.id_ban = oper_ban.oper_ban_id')
      ->where('id_oper_ban', $id);

    $query = $this->db->get();

    return $query->row();
  }

  public function getDataOperKdPakai($id)
  {
    $this->db->select('kd_pakai_ban')
      ->from('oper_ban')
      ->where(['id_oper_ban' => $id]);

    $query = $this->db->get();

    return $query->row();
  }

  public function getFilter($awal, $akhir)
  {
    $this->db->select('
                      b.plat_no_truck truck_asal_id, b.merk_truck merk_truck_asal, b.jenis_truck jenis_truck_asal, 
                      c.plat_no_truck truck_oper_id, c.merk_truck merk_truck_oper, c.jenis_truck jenis_truck_oper, 
                      a.id_oper_ban, kd_oper_ban, a.detail_pakai_ban_id, g.kd_pakai_ban, 
                      d.jenis_part oper_ban_id, d.sat sat_oper, 
                      e.nama_merk merk_id, a.jml_ban_oper, a.nama_montir_oper, a.ket_oper_ban, 
                      a.status_oper_ban, a.tgl_oper_ban, a.tgl_kembali_oper_ban, 
                      f.id_user user_id')
      ->from('oper_ban a')
      ->where('date(a.tgl_oper_ban) >=', $awal)
      ->where('date(a.tgl_oper_ban) <=', $akhir)
      ->join('truck b', 'b.id_truck=a.truck_asal_id')
      ->join('truck c', 'c.id_truck=a.truck_oper_id')
      ->join('ban d', 'd.id_ban = a.oper_ban_id', 'left')
      ->join('merk e', 'e.id_merk = a.merk_ban_id', 'left')
      ->join('user f', 'f.id_user = a.user_id', 'left')
      ->join('detail_pakai_ban g', 'g.id_detail_pakai_ban = a.detail_pakai_ban_id', 'left');

    $query = $this->db->get();

    return $query->result_array();
  }

  public function getFilterTruckDate($id, $tgl)
  {
    $this->db->select('
                      b.plat_no_truck truck_asal_id, b.merk_truck merk_truck_asal, b.jenis_truck jenis_truck_asal, 
                      c.plat_no_truck truck_oper_id, c.merk_truck merk_truck_oper, c.jenis_truck jenis_truck_oper, 
                      a.id_oper_ban, a.kd_oper_ban, 
                      g.kd_pakai_ban, a.detail_pakai_ban_id, 
                      d.jenis_part oper_ban_id, d.sat sat_oper, 
                      e.nama_merk merk_id, a.jml_ban_oper, a.nama_montir_oper, a.ket_oper_ban, a.status_oper_ban, 
                      a.tgl_oper_ban, a.tgl_kembali_oper_ban, 
                      f.id_user user_id
                      ')
      ->from('oper_ban a')
      ->where('date(a.tgl_oper_ban) >=', $tgl)
      ->where('a.truck_asal_id=', $id)
      ->join('truck b', 'b.id_truck=a.truck_asal_id')
      ->join('truck c', 'c.id_truck=a.truck_oper_id')
      ->join('ban d', 'd.id_ban = a.oper_ban_id', 'left')
      ->join('merk e', 'e.id_merk = a.merk_ban_id', 'left')
      ->join('user f', 'f.id_user = a.user_id', 'left')
      ->join('detail_pakai_ban g', 'g.id_detail_pakai_ban = a.detail_pakai_ban_id', 'left');

    $query = $this->db->get();

    return $query->result_array();
  }

  public function getFilterTruck($platno)
  {
    $this->db->select('*')
      ->from('oper_ban')
      ->join('ban', 'ban.id_ban = oper_ban.oper_ban_id', 'left')
      ->join('merk', 'merk.id_merk = oper_ban.merk_ban_id', 'left')
      ->join('truck', 'truck.id_truck = oper_ban.truck_asal_id', 'left')
      ->where('plat_no_truck =', $platno);

    $query = $this->db->get();

    return $query->result_array();
  }

  public function getTruck()
  {
    $this->db->select('*')
      ->from('oper_ban')
      ->join('truck', 'truck.id_truck = oper_ban.truck_oper_id', 'left');

    $query = $this->db->get();

    return $query->row_array();
  }

  public function getTruckId($id)
  {
    $this->db->select('plat_no_truck')
      ->from('truck')
      ->where(['truck.id_truck' => $id]);

    $query = $this->db->get();

    return $query->row_array();
  }

  public function addOper($dataStok, $noseri, $dataoper, $dataHistory)
  {
    $this->db->update('ban', $dataStok, $noseri);

    $this->db->insert('oper_ban', $dataoper);

    $this->db->insert('history_ban', $dataHistory);
  }

  public function addHistory($dataHistory)
  {
    $this->db->insert('history_ban', $dataHistory);
  }

  public function updatePakai($totpakai, $kdpakai)
  {
    $this->db->update('pakai_ban', $totpakai, $kdpakai);
  }

  public function updateDetailPakai($jml, $where)
  {
    $this->db->update('detail_pakai_ban', $jml, $where);
  }

  public function updateOper($datakembalipakai, $datakembalidetail, $dataoper, $dataidoper, $datakdpinjam, $datakddetail, $datahistori, $dataStok, $noseri)
  {
    $this->db->update('oper_ban', $dataoper, $dataidoper);

    $this->db->update('pakai_ban', $datakembalipakai, $datakdpinjam);

    $this->db->update('detail_pakai_ban', $datakembalidetail, $datakddetail);

    $this->db->insert('history_ban', $datahistori);

    $this->db->update('ban', $dataStok, $noseri);
  }

  public function updateOperan($datakembalioper, $dataidkembalioper, $dthistori, $dataupdateoper, $kodeoper, $dtstok, $dtnoseri)
  {
    $this->db->update('oper_ban', $datakembalioper, $dataidkembalioper);

    $this->db->insert('history_ban', $dthistori);

    $this->db->update('oper_ban', $dataupdateoper, $kodeoper);

    $this->db->update('ban', $dtstok, $dtnoseri);
  }

  // public function updateDataOldOperan($dataupdateoper, $kodeoper, $dtstok, $dtnoseri)
  // {
  //   $this->db->update('oper_ban', $dataupdateoper, $kodeoper);
  //   $this->db->update('ban', $dtstok, $dtnoseri);
  // }

  public function updatePakaiOper($total, $kdpakai)
  {
    $this->db->update('pakai_ban', $total, $kdpakai);
  }

  public function addOperan($dataoperanlagi)
  {
    $this->db->insert('oper_ban', $dataoperanlagi);
  }

  public function updateOldOper($updateolddataoper, $idoperold)
  {
    $this->db->update('oper_ban', $updateolddataoper, $idoperold);
  }

  public function kembaligudang($statusban, $whereban, $dataoper, $whereoperban)
  {
    $this->db->update('ban', $statusban, $whereban);

    $this->db->update('oper_ban', $dataoper, $whereoperban);
  }

  public function deleteOper($id)
  {
    return $this->db->delete('oper_ban', ['id_oper_ban' => $id]);
  }
}
