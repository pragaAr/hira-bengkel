<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Oper_model extends CI_Model
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
                              a.id_oper, a.kd_oper, a.detail_pakai_id, 
                              a.kd_pakai, a.nama_montir_oper as montir, 
                              a.jml_oper, a.ket_oper, a.status_oper, 
                              a.tgl_oper, a.tgl_kembali_oper, 
                              b.plat_no_truck as plat_asal, b.merk_truck as merk_asal, b.jenis_truck as jenis_asal, 
                              c.plat_no_truck as plat_oper, c.merk_truck as merk_oper, c.jenis_truck as jenis_oper, 
                              d.jenis_part, d.sat, 
                              e.nama_merk
                              ')
      ->from('oper_part a')
      ->join('truck b', 'b.id_truck = a.truck_asal_id')
      ->join('truck c', 'c.id_truck = a.truck_oper_id')
      ->join('stok_part d', 'd.id_part = a.part_id', 'left')
      ->join('merk e', 'e.id_merk = a.merk_id', 'left')

      ->add_column(
        'view',
        '<div class="btn-group" role="group"> 
     
      </div>',
        'id_oper, kd_oper, kd_pakai, montir, jml_oper, ket_oper, status_oper, tgl_oper, tgl_kembali_oper, plat_asal, merk_asal, jenis_asal, plat_oper, merk_oper, jenis_oper, jenis_part, sat, nama_merk'
      );

    $results = $this->datatables->generate();

    $data = json_decode($results, true);

    foreach ($data['data'] as &$row) {

      if ($row['jml_oper'] != 0) {

        $row['view'] = '<div class="btn-group" role="group">
                            <a href="javascript:void(0);" class="btn btn-sm border border-light btn-info text-white btn-kembali" title="Kembalikan" data-kd="' . $row['kd_oper'] . '"">
                              <i class="fas fa-angle-double-right fa-sm"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm border border-light btn-warning text-white btn-operan" title="Oper Lagi" data-kd="' . $row['kd_oper'] . '"">
                              <i class="fas fa-retweet fa-sm"></i>
                            </a>
                            <a href="http://localhost/he-bengkel/oper/detail/' . $row['kd_oper'] . '" class="btn btn-sm border border-light btn-success text-white" title="Detail"">
                              <i class="fas fa-eye fa-sm"></i>
                            </a>
                          </div>';
      } else {
        $row['view'] = '<div class="btn-group" role="group">
                            <a href="http://localhost/he-bengkel/oper/detail/' . $row['kd_oper'] . '" class="btn btn-sm border border-light btn-success text-white" title="History"">
                              <i class="fas fa-eye fa-sm"></i>
                            </a>
                          </div>';
      }
    }

    $results = json_encode($data);

    echo $results;
  }

  public function getOper()
  {
    $this->db->select('
    b.plat_no_truck truck_asal_id, b.merk_truck merk_truck_asal, b.jenis_truck jenis_truck_asal, 
    c.plat_no_truck truck_oper_id, c.merk_truck merk_truck_oper, c.jenis_truck jenis_truck_oper, 
    a.id_oper, a.kd_oper, a.kd_pakai, a.detail_pakai_id, 
    a.jml_oper, a.nama_montir_oper, a.ket_oper, a.status_oper, a.tgl_oper, a.tgl_kembali_oper, 
    d.jenis_part part_id, d.sat sat_oper, 
    e.nama_merk merk_id, 
    f.id_user user_id')
      ->from('oper_part a')
      ->join('truck b', 'b.id_truck = a.truck_asal_id')
      ->join('truck c', 'c.id_truck = a.truck_oper_id')
      ->join('stok_part d', 'd.id_part = a.part_id', 'left')
      ->join('merk e', 'e.id_merk = a.merk_id', 'left')
      ->join('user f', 'f.id_user = a.user_id', 'left')
      ->order_by('a.id_oper', 'ASC');

    $query = $this->db->get();

    return $query->result_array();
  }

  public function getOperkd($kd)
  {
    $this->db->select('a.id_oper, a.kd_oper, a.kd_pakai, a.detail_pakai_id, a.jml_oper, a.nama_montir_oper, a.ket_oper, a.status_oper, a.tgl_oper, a.tgl_kembali_oper, b.id_truck asalid, b.plat_no_truck asal, b.merk_truck merkasal, d.jenis_part part, d.id_part, d.sat, e.id_merk, e.nama_merk merk')
      ->from('oper_part a')
      ->where('a.kd_oper', $kd)
      ->join('truck b', 'b.id_truck = a.truck_oper_id')
      ->join('stok_part d', 'd.id_part = a.part_id', 'left')
      ->join('merk e', 'e.id_merk = a.merk_id', 'left');

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDetailOperKd($kd)
  {
    $this->db->select('a.id_oper, a.kd_oper, a.kd_pakai, a.detail_pakai_id, a.jml_oper, a.nama_montir_oper, a.ket_oper, a.status_oper, a.tgl_oper, a.tgl_kembali_oper, b.id_truck asalid, b.plat_no_truck asal, b.merk_truck merkasal, c.id_truck tujuanid, c.plat_no_truck tujuan, c.merk_truck merktujuan, d.jenis_part part, d.id_part, d.sat, e.id_merk, e.nama_merk merk, f.nama_user')
      ->from('oper_part a')
      ->where('a.kd_oper', $kd)
      ->join('truck b', 'b.id_truck = a.truck_asal_id')
      ->join('truck c', 'c.id_truck = a.truck_oper_id')
      ->join('stok_part d', 'd.id_part = a.part_id', 'left')
      ->join('merk e', 'e.id_merk = a.merk_id', 'left')
      ->join('user f', 'f.id_user = a.user_id', 'left')
      ->join('detail_pakai g', 'g.id_detail_pakai = a.detail_pakai_id', 'left');

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDataOperId($id)
  {
    $this->db->select('*')
      ->from('oper_part')
      ->where('id_oper', $id);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDataOperKdPakai($id)
  {
    $this->db->select('kd_pakai')
      ->from('oper_part')
      ->where('id_oper', $id);

    $query = $this->db->get();

    return $query->row();
  }

  public function getFilter($awal, $akhir)
  {
    $this->db->select('t1.plat_no_truck truck_asal_id, t1.merk_truck merk_truck_asal, t1.jenis_truck jenis_truck_asal, t2.plat_no_truck truck_oper_id, t2.merk_truck merk_truck_oper, t2.jenis_truck jenis_truck_oper, id_oper, kd_oper, d1.kd_pakai, detail_pakai_id, p1.jenis_part part_id, p1.sat sat_oper, m1.nama_merk merk_id, jml_oper, nama_montir_oper, ket_oper, status_oper, tgl_oper, tgl_kembali_oper, u1.id_user user_id');
    $this->db->from('oper_part');
    $this->db->where('date(oper_part.tgl_oper) >=', $awal);
    $this->db->where('date(oper_part.tgl_oper) <=', $akhir);
    $this->db->join('truck t1', 't1.id_truck=oper_part.truck_asal_id');
    $this->db->join('truck t2', 't2.id_truck=oper_part.truck_oper_id');
    $this->db->join('stok_part p1', 'p1.id_part = oper_part.part_id', 'left');
    $this->db->join('merk m1', 'm1.id_merk = oper_part.merk_id', 'left');
    $this->db->join('user u1', 'u1.id_user = oper_part.user_id', 'left');
    $this->db->join('detail_pakai d1', 'd1.id_detail_pakai = oper_part.detail_pakai_id', 'left');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getFilterTruckDate($id, $tgl)
  {
    $this->db->select('t1.plat_no_truck truck_asal_id, t1.merk_truck merk_truck_asal, t1.jenis_truck jenis_truck_asal, t2.plat_no_truck truck_oper_id, t2.merk_truck merk_truck_oper, t2.jenis_truck jenis_truck_oper, id_oper, kd_oper, d1.kd_pakai, detail_pakai_id, p1.jenis_part part_id, p1.sat sat_oper, m1.nama_merk merk_id, jml_oper, nama_montir_oper, ket_oper, status_oper, tgl_oper, tgl_kembali_oper, u1.id_user user_id');
    $this->db->from('oper_part');
    $this->db->where('date(oper_part.tgl_oper) >=', $tgl);
    $this->db->where('oper_part.truck_asal_id=', $id);
    $this->db->join('truck t1', 't1.id_truck=oper_part.truck_asal_id');
    $this->db->join('truck t2', 't2.id_truck=oper_part.truck_oper_id');
    $this->db->join('stok_part p1', 'p1.id_part = oper_part.part_id', 'left');
    $this->db->join('merk m1', 'm1.id_merk = oper_part.merk_id', 'left');
    $this->db->join('user u1', 'u1.id_user = oper_part.user_id', 'left');
    $this->db->join('detail_pakai d1', 'd1.id_detail_pakai = oper_part.detail_pakai_id', 'left');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getFilterTruck($platno)
  {
    $this->db->select('*');
    $this->db->from('oper_part');
    $this->db->join('stok_part', 'stok_part.id_part = oper_part.part_id', 'left');
    $this->db->join('merk', 'merk.id_merk = oper_part.merk_id', 'left');
    $this->db->join('truck', 'truck.id_truck = oper_part.truck_asal_id', 'left');
    $this->db->where('plat_no_truck =', $platno);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getTruck()
  {
    $this->db->select('*');
    $this->db->from('oper_part');
    $this->db->join('truck', 'truck.id_truck = oper_part.truck_oper_id', 'left');
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

  public function addOper($dataoper, $datahistory)
  {
    $this->db->insert('oper_part', $dataoper);

    $this->db->insert('history_part', $datahistory);
  }

  public function addHistory($history)
  {
    $this->db->insert('history_part', $history);
  }

  public function updatePakai($totpakai, $wherekdpakai)
  {
    $this->db->update('pakai_part', $totpakai, $wherekdpakai);
  }

  public function updateDetailPakai($pakai, $where)
  {
    $this->db->update('detail_pakai', $pakai, $where);
  }

  public function updateOper($datakembalipakai, $datakembalidetail, $dataoper, $dataidoper, $datakdpinjam, $datakddetail, $history)
  {
    $this->db->update('oper_part', $dataoper, $dataidoper);

    $this->db->update('pakai_part', $datakembalipakai, $datakdpinjam);

    $this->db->update('detail_pakai', $datakembalidetail, $datakddetail);

    $this->db->insert('history_part', $history);
  }

  public function updateOperan($datakembalioper, $dataidkembalioper, $dataupdateoper, $kodeoper, $history)
  {
    $this->db->update('oper_part', $datakembalioper, $dataidkembalioper);

    $this->db->insert('history_part', $history);

    $this->db->update('oper_part', $dataupdateoper, $kodeoper);
  }

  public function updatePakaiOper($total, $kdpakai)
  {
    $this->db->update('pakai_part', $total, $kdpakai);
  }

  public function addOperan($dataoper, $historyoper, $updateoldoper, $kdoperold)
  {
    $this->db->insert('oper_part', $dataoper);

    $this->db->insert('history_part', $historyoper);

    $this->db->update('oper_part', $updateoldoper, $kdoperold);
  }
}
