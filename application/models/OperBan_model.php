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
    $this->datatables->select('a.id_oper_ban, a.kd_oper_ban, a.kd_pakai_ban, a.jml_ban_oper, a.nama_montir_oper as montir, a.status_oper_ban, a.tgl_oper_ban, b.plat_no_truck as truckasal, b.merk_truck as merkasal, c.plat_no_truck as trucktujuan, c.merk_truck as merktujuan, d.no_seri, d.ukuran_ban, e.nama_merk')
      ->from('oper_ban a')
      ->join('truck b', 'b.id_truck = a.truck_asal_id')
      ->join('truck c', 'c.id_truck = a.truck_oper_id')
      ->join('ban d', 'd.id_ban = a.oper_ban_id', 'left')
      ->join('merk e', 'e.id_merk = a.merk_ban_id', 'left')

      // --for searching needed
      ->add_column(
        'view',
        '<div class="btn-group" role="group"> 
     
      </div>',
        'id_oper_ban, kd_oper_ban, kd_pakai_ban, montir, jml_ban_oper, status_oper_ban, tgl_oper_ban, truckasal, merkasal, trucktujuan, merktujuan, no_seri, ukuran_ban, nama_merk'
      );
    // --for searching needed

    $results = $this->datatables->generate();

    $data = json_decode($results, true);

    foreach ($data['data'] as &$row) {

      if ($row['jml_ban_oper'] != 0) {

        $row['view'] = '<div class="btn-group" role="group">
                            <a href="javascript:void(0);" class="btn btn-sm btn-info text-white btn-kembali" data-toggle="tooltip" title="Kembalikan" data-kd="' . $row['kd_oper_ban'] . '">
                              <i class="fas fa-angle-double-right fa-sm"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-warning text-white btn-operan" data-toggle="tooltip" title="Oper Lagi" data-kd="' . $row['kd_oper_ban'] . '">
                              <i class="fas fa-retweet fa-sm"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-kembali-gudang" data-toggle="tooltip" title="Kembalikan ke gudang" data-id="' . $row['id_oper_ban'] . '">
                              <i class="fas fa-home fa-sm"></i>
                            </a>
                           
                          </div>';
      } else {
        $row['view'] = '<div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-secondary text-white" disabled>
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
    $this->db->select('a.id_oper_ban, a.kd_oper_ban, a.kd_pakai_ban, a.truck_oper_id as asalid, a.merk_ban_id, a.detail_pakai_ban_id, a.jml_ban_oper, a.nama_montir_oper, a.ket_oper_ban, a.status_oper_ban, a.tgl_oper_ban, a.tgl_kembali_oper_ban, b.plat_no_truck as asal, b.merk_truck as merkasal, b.jenis_truck as jenisasal, c.plat_no_truck as tujuan, c.merk_truck merktujuan, c.jenis_truck jenistujuan, d.id_ban, d.no_seri, d.ukuran_ban, e.nama_merk merk, f.id_user');
    $this->db->from('oper_ban a');
    $this->db->join('truck b', 'b.id_truck = a.truck_asal_id');
    $this->db->join('truck c', 'c.id_truck = a.truck_oper_id');
    $this->db->join('ban d', 'd.id_ban = a.oper_ban_id', 'left');
    $this->db->join('merk e', 'e.id_merk = a.merk_ban_id', 'left');
    $this->db->join('user f', 'f.id_user = a.user_id', 'left');
    $this->db->join('detail_pakai_ban g', 'g.id_detail_pakai_ban = a.detail_pakai_ban_id', 'left');
    $this->db->where('a.kd_oper_ban', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getOperkd($kd)
  {
    $this->db->select('*');
    $this->db->from('oper_ban');
    $this->db->join('ban', 'ban.id_ban = oper_ban.oper_ban_id', 'left');
    $this->db->join('merk', 'merk.id_merk = oper_ban.merk_ban_id', 'left');
    $this->db->join('truck', 'truck.id_truck = oper_ban.truck_oper_id', 'left');
    $this->db->join('detail_pakai_ban', 'detail_pakai_ban.id_detail_pakai_ban = oper_ban.detail_pakai_ban_id', 'left');
    $this->db->where(['oper_ban.kd_oper_ban' => $kd]);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function getOperanId($id)
  {
    $this->db->select('*');
    $this->db->from('oper_ban');
    $this->db->join('ban', 'ban.id_ban = oper_ban.oper_ban_id', 'left');
    $this->db->join('merk', 'merk.id_merk = oper_ban.merk_ban_id', 'left');
    $this->db->join('truck', 'truck.id_truck = oper_ban.truck_oper_id', 'left');
    $this->db->join('detail_pakai_ban', 'detail_pakai_ban.id_detail_pakai_ban = oper_ban.detail_pakai_ban_id', 'left');
    $this->db->where(['oper_ban.id_oper_ban' => $id]);
    $query = $this->db->get();
    return $query->row();
  }

  public function getOperId($id)
  {
    $this->db->select('ban.id_ban, ban.no_seri, ban.ukuran_ban, t1.plat_no_truck truck_asal_id, t1.merk_truck merk_truck_asal, t1.jenis_truck jenis_truck_asal, t2.plat_no_truck truck_oper_id, t2.merk_truck merk_truck_oper, t2.jenis_truck jenis_truck_oper, id_oper_ban, kd_oper_ban, d1.kd_pakai_ban, detail_pakai_ban_id, p1.no_seri oper_ban_id, m1.nama_merk merk_id, jml_ban_oper, nama_montir_oper, ket_oper_ban, status_oper_ban, tgl_oper_ban, tgl_kembali_oper_ban, u1.id_user user_id');
    $this->db->from('oper_ban');
    $this->db->where(['oper_ban.id_oper_ban' => $id]);
    $this->db->join('ban', 'ban.id_ban=oper_ban.oper_ban_id');
    $this->db->join('truck t1', 't1.id_truck=oper_ban.truck_asal_id');
    $this->db->join('truck t2', 't2.id_truck=oper_ban.truck_oper_id');
    $this->db->join('ban p1', 'p1.id_ban = oper_ban.oper_ban_id', 'left');
    $this->db->join('merk m1', 'm1.id_merk = oper_ban.merk_ban_id', 'left');
    $this->db->join('user u1', 'u1.id_user = oper_ban.user_id', 'left');
    $this->db->join('detail_pakai_ban d1', 'd1.id_detail_pakai_ban = oper_ban.detail_pakai_ban_id', 'left');
    $query = $this->db->get();
    return $query->row_array();
  }

  public function getDataOperId($id)
  {
    $this->db->select('*');
    $this->db->from('oper_ban');
    $this->db->join('ban', 'ban.id_ban = oper_ban.oper_ban_id');
    $this->db->where('id_oper_ban', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function getDataOperKdPakai($id)
  {
    $this->db->select('kd_pakai_ban');
    $this->db->from('oper_ban');
    $this->db->where(['id_oper_ban' => $id]);
    $query = $this->db->get();
    return $query->row();
  }

  public function getFilter($awal, $akhir)
  {
    $this->db->select('t1.plat_no_truck truck_asal_id, t1.merk_truck merk_truck_asal, t1.jenis_truck jenis_truck_asal, t2.plat_no_truck truck_oper_id, t2.merk_truck merk_truck_oper, t2.jenis_truck jenis_truck_oper, id_oper_ban, kd_oper_ban, d1.kd_pakai_ban, detail_pakai_ban_id, p1.jenis_part oper_ban_id, p1.sat sat_oper, m1.nama_merk merk_id, jml_ban_oper, nama_montir_oper, ket_oper_ban, status_oper_ban, tgl_oper_ban, tgl_kembali_oper_ban, u1.id_user user_id');
    $this->db->from('oper_ban');
    $this->db->where('date(oper_ban.tgl_oper_ban) >=', $awal);
    $this->db->where('date(oper_ban.tgl_oper_ban) <=', $akhir);
    $this->db->join('truck t1', 't1.id_truck=oper_ban.truck_asal_id');
    $this->db->join('truck t2', 't2.id_truck=oper_ban.truck_oper_id');
    $this->db->join('ban p1', 'p1.id_ban = oper_ban.oper_ban_id', 'left');
    $this->db->join('merk m1', 'm1.id_merk = oper_ban.merk_ban_id', 'left');
    $this->db->join('user u1', 'u1.id_user = oper_ban.user_id', 'left');
    $this->db->join('detail_pakai_ban d1', 'd1.id_detail_pakai_ban = oper_ban.detail_pakai_ban_id', 'left');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getFilterTruckDate($id, $tgl)
  {
    $this->db->select('t1.plat_no_truck truck_asal_id, t1.merk_truck merk_truck_asal, t1.jenis_truck jenis_truck_asal, t2.plat_no_truck truck_oper_id, t2.merk_truck merk_truck_oper, t2.jenis_truck jenis_truck_oper, id_oper_ban, kd_oper_ban, d1.kd_pakai_ban, detail_pakai_ban_id, p1.jenis_part oper_ban_id, p1.sat sat_oper, m1.nama_merk merk_id, jml_ban_oper, nama_montir_oper, ket_oper_ban, status_oper_ban, tgl_oper_ban, tgl_kembali_oper_ban, u1.id_user user_id');
    $this->db->from('oper_ban');
    $this->db->where('date(oper_ban.tgl_oper_ban) >=', $tgl);
    $this->db->where('oper_ban.truck_asal_id=', $id);
    $this->db->join('truck t1', 't1.id_truck=oper_ban.truck_asal_id');
    $this->db->join('truck t2', 't2.id_truck=oper_ban.truck_oper_id');
    $this->db->join('ban p1', 'p1.id_ban = oper_ban.oper_ban_id', 'left');
    $this->db->join('merk m1', 'm1.id_merk = oper_ban.merk_ban_id', 'left');
    $this->db->join('user u1', 'u1.id_user = oper_ban.user_id', 'left');
    $this->db->join('detail_pakai_ban d1', 'd1.id_detail_pakai_ban = oper_ban.detail_pakai_ban_id', 'left');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getFilterTruck($platno)
  {
    $this->db->select('*');
    $this->db->from('oper_ban');
    $this->db->join('ban', 'ban.id_ban = oper_ban.oper_ban_id', 'left');
    $this->db->join('merk', 'merk.id_merk = oper_ban.merk_ban_id', 'left');
    $this->db->join('truck', 'truck.id_truck = oper_ban.truck_asal_id', 'left');
    $this->db->where('plat_no_truck =', $platno);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getTruck()
  {
    $this->db->select('*');
    $this->db->from('oper_ban');
    $this->db->join('truck', 'truck.id_truck = oper_ban.truck_oper_id', 'left');
    $query = $this->db->get();
    return $query->row_array();
  }

  public function getTruckId($id)
  {
    $this->db->select('plat_no_truck');
    $this->db->from('truck');
    $this->db->where(['truck.id_truck' => $id]);
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
