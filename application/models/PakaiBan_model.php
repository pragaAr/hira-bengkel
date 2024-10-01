<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class PakaiBan_model extends CI_Model
{

  public function cekKdPakai()
  {
    $date = date('mdYHis');
    $tr   = "tbk-";
    $kd   = $tr .  $date;

    return $kd;
  }

  public function getData()
  {
    $this->datatables->select('a.id_pakai_ban, a.kd_pakai_ban, a.truck_ban_id, a.nama_montir_ban, a.total_pakai_ban, a.tgl_pakai_ban, b.id_truck, b.plat_no_truck, b.merk_truck, b.jenis_truck')
      ->from('pakai_ban a')
      ->join('truck b', 'b.id_truck = a.truck_ban_id', 'left')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="http://localhost/he-bengkel/pakai_ban/detail/$2" class="btn btn-sm btn-success text-white" data-toggle="tooltip" title="Detail">
            <i class="fas fa-eye fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-delete" data-kd="$2" data-toggle="tooltip" title="Delete">
            <i class="fas fa-trash fa-sm"></i>
        </a>
        </div>',
        'id_pakai_ban, kd_pakai_ban, plat_no_truck, nama_montir_ban, merk_truck, jenis_truck, total_pakai_ban, tgl_pakai_ban'
      );

    return $this->datatables->generate();
  }

  public function getAllPakai()
  {
    $this->datatables->select('a.id_detail_pakai_ban, a.kd_pakai_ban, a.status_ban_pakai, a.jml_pakai_ban, a.status_pakai_ban, a.ket_pakai_ban, b.no_seri, b.ukuran_ban, c.nama_merk, d.tgl_pakai_ban, e.plat_no_truck as truck')
      ->from('detail_pakai_ban a')
      ->join('ban b', 'b.id_ban = a.ban_id', 'left')
      ->join('merk c', 'c.id_merk = a.merk_ban_id', 'left')
      ->join('pakai_ban d', 'd.kd_pakai_ban = a.kd_pakai_ban')
      ->join('truck e', 'e.id_truck = d.truck_ban_id', 'left')
      ->where('a.status_pakai_ban !=', 'Di kembalikan ke gudang')

      // --for searching needed
      ->add_column(
        'view',
        'id_detail_pakai_ban, kd_pakai_ban, truck, jml_pakai_ban, no_seri, ukuran_ban, status_pakai_ban, nama_merk, ket_pakai_ban, tgl_pakai_ban, status_ban_pakai'
      );
    // --for searching needed

    return $this->datatables->generate();
  }

  public function getDetailAllPakai($id)
  {
    $this->db->select('a.id_detail_pakai_ban, a.kd_pakai_ban, a.status_ban_pakai, a.jml_pakai_ban, a.status_pakai_ban, a.ket_pakai_ban, b.id_ban, b.no_seri, c.id_merk, c.nama_merk, d.total_pakai_ban, d.tgl_pakai_ban, e.id_truck, e.plat_no_truck as truck')
      ->from('detail_pakai_ban a')
      ->join('ban b', 'b.id_ban = a.ban_id', 'left')
      ->join('merk c', 'c.id_merk = a.merk_ban_id', 'left')
      ->join('pakai_ban d', 'd.kd_pakai_ban = a.kd_pakai_ban')
      ->join('truck e', 'e.id_truck = d.truck_ban_id')
      ->where('a.id_detail_pakai_ban', $id);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getAllDataPakai($truck, $bulan)
  {
    $y = date('Y', strtotime($bulan));
    $m = date('m', strtotime($bulan));

    $this->db->select('a.id_detail_pakai_ban , a.kd_pakai_ban, a.status_ban_pakai, a.jml_pakai_ban, a.status_pakai_ban, a.ket_pakai_ban, b.no_seri, b.ukuran_ban, c.nama_merk, d.tgl_pakai_ban, e.plat_no_truck as truck')
      ->from('detail_pakai_ban a')
      ->join('ban b', 'b.id_ban = a.ban_id', 'left')
      ->join('merk c', 'c.id_merk = a.merk_ban_id', 'left')
      ->join('pakai_ban d', 'd.kd_pakai_ban = a.kd_pakai_ban')
      ->join('truck e', 'e.id_truck = d.truck_ban_id')
      ->where('YEAR(d.tgl_pakai_ban) =', $y)
      ->where('MONTH(d.tgl_pakai_ban) =', $m);

      if($truck){
        $this->db->where('d.truck_ban_id', $truck);
      }

    $query = $this->db->get()->result();
    return $query;
  }

  public function getFilter($awal, $akhir)
  {
    $this->db->select('*');
    $this->db->from('pakai_ban');
    $this->db->where('date(pakai_ban.tgl_pakai_ban) >=', $awal);
    $this->db->where('date(pakai_ban.tgl_pakai_ban) <=', $akhir);
    $this->db->join('truck', 'truck.id_truck = pakai_ban.truck_ban_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getFilterTruck($platno, $dari, $sampai)
  {
    $this->db->select('*');
    $this->db->from('pakai_ban');
    $this->db->where('date(pakai_ban.tgl_pakai_ban) >=', $dari);
    $this->db->where('date(pakai_ban.tgl_pakai_ban) <=', $sampai);
    $this->db->join('truck', 'truck.id_truck = pakai_ban.truck_ban_id');
    $this->db->where('plat_no_truck', $platno);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getFilterTruckDate($platno, $tglpakai)
  {
    $this->db->select('*');
    $this->db->from('pakai_ban');
    $this->db->where('date(pakai_ban.tgl_pakai_ban) =', $tglpakai);
    $this->db->join('truck', 'truck.id_truck = pakai_ban.truck_ban_id');
    $this->db->where('plat_no_truck', $platno);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getKdPakai($kd)
  {
    $this->db->select('a.id_pakai_ban, a.kd_pakai_ban, a.truck_ban_id, a.nama_montir_ban, a.total_pakai_ban, a.tgl_pakai_ban, a.user_id, b.id_truck, b.plat_no_truck, b.merk_truck, b.jenis_truck, c.id_user, c.username')
      ->from('pakai_ban a')
      ->join('truck b', 'b.id_truck = a.truck_ban_id')
      ->join('user c', 'c.id_user = a.user_id', 'left')
      ->where('a.kd_pakai_ban', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDetailPakai($kd)
  {
    $this->db->select('a.id_detail_pakai_ban, a.ban_id, a.merk_ban_id, a.status_pakai_ban, a.status_ban_pakai, a.ket_pakai_ban, a.jml_pakai_ban, b.id_ban, b.no_seri, b.ukuran_ban, b.merk_ban_id, c.id_merk, c.nama_merk')
      ->from('detail_pakai_ban a')
      ->join('ban b', 'b.id_ban = a.ban_id', 'left')
      ->join('merk c', 'c.id_merk = a.merk_ban_id', 'left')
      ->where('a.kd_pakai_ban', $kd);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getBanPakaiId($kd)
  {
    $this->db->select('ban_id')
      ->from('detail_pakai_ban')
      ->where('kd_pakai_ban', $kd);

    $query = $this->db->get()->result_array();

    return $query;
  }

  public function getIdDetailPakai($id)
  {
    $this->db->select('*');
    $this->db->from('detail_pakai_ban');
    $this->db->join('ban', 'ban.id_ban = detail_pakai_ban.ban_id', 'left');
    $this->db->join('merk', 'merk.id_merk = detail_pakai_ban.merk_ban_id', 'left');
    $this->db->join('pakai_ban', 'pakai_ban.kd_pakai_ban = detail_pakai_ban.kd_pakai_ban');
    $this->db->where(['detail_pakai_ban.id_detail_pakai_ban' => $id]);
    $query = $this->db->get();
    return $query->row();
  }

  public function getJmlPakaiId($id)
  {
    $this->db->select('*')
      ->from('detail_pakai_ban')
      ->where('detail_pakai_ban.id_detail_pakai_ban', $id);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getTotPakaiKd($kd)
  {
    $this->db->select('*')
      ->from('pakai_ban')
      ->where('pakai_ban.kd_pakai_ban', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getPakaiKembali($id)
  {
    $this->db->select('*');
    $this->db->from('detail_pakai_ban');
    $this->db->join('ban', 'ban.id_ban = detail_pakai_ban.ban_id');
    $this->db->join('pakai_ban', 'pakai_ban.kd_pakai_ban = detail_pakai_ban.kd_pakai_ban');
    $this->db->where('id_detail_pakai_ban', $id);
    $query = $this->db->get()->row();
    return $query;
  }

  public function addData($datapakai, $detailpakai, $updateban)
  {
    $this->db->insert('pakai_ban', $datapakai);

    $this->db->insert_batch('detail_pakai_ban', $detailpakai);

    $this->db->update_batch('ban', $updateban, 'id_ban');
  }

  public function addHistory($historypakai)
  {
    $this->db->insert_batch('history_ban', $historypakai);
  }

  public function getIdDetail($id)
  {
    return $this->db->get('detail_pakai_ban', ['id_detail_pakai_ban' => $id])->row_array();
  }

  public function kembaliGudang($databan, $whereban, $datahistori, $datapakai, $wherepakai)
  {
    $this->db->update('ban', $databan, $whereban);
    $this->db->update('detail_pakai_ban', $datapakai, $wherepakai);
    $this->db->insert('history_ban', $datahistori);
  }

  public function delete($kd)
  {
    $this->db->delete('pakai_ban', ['kd_pakai_ban' => $kd]);
    $this->db->delete('detail_pakai_ban', ['kd_pakai_ban' => $kd]);
    $this->db->delete('history_ban', ['kd_history_ban' => $kd]);
  }

  public function updateStatus($databan)
  {
    $this->db->update_batch('ban', $databan, 'id_ban');
  }
}
