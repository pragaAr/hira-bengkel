<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Pakai_model extends CI_Model
{
  // for generate kd
  public function cekKdPakai()
  {
    $date = date('mdYHis');
    $tr   = "trk-";
    $kd   = $tr .  $date;

    return $kd;
  }
  // end for generate kd

  // for datatables
  public function getData()
  {
    $this->datatables->select('a.id_pakai, a.kd_pakai, a.nama_montir, a.total_pakai, a.tgl_pakai, b.plat_no_truck, b.merk_truck, b.jenis_truck')
      ->from('pakai_part a')
      ->join('truck b', 'b.id_truck = a.truck_id')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="http://localhost/he-bengkel/pakai/detail/$2" class="btn btn-sm btn-success text-white" data-toggle="tooltip" title="Detail">
            <i class="fas fa-eye fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-delete" data-kd="$2" data-toggle="tooltip" title="Delete">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
        'id_pakai, kd_pakai, plat_no_truck, merk_truck, jenis_truck, total_pakai, tgl_pakai'
      );

    return $this->datatables->generate();
  }
  // end for datatables

  // for detail all pakai datatables
  public function getAllPakai()
  {
    $this->datatables->select('a.id_detail_pakai, a.kd_pakai, a.status_part_pakai, a.jml_pakai, a.status_pakai, a.ket_pakai, b.jenis_part, b.sat, c.nama_merk, d.tgl_pakai, e.plat_no_truck as truck')
      ->from('detail_pakai a')
      ->join('stok_part b', 'b.id_part = a.part_id', 'left')
      ->join('merk c', 'c.id_merk = a.merk_id', 'left')
      ->join('pakai_part d', 'd.kd_pakai = a.kd_pakai')
      ->join('truck e', 'e.id_truck = d.truck_id')

      // --for searching needed
      ->add_column(
        'view',
        'id_detail_pakai, kd_pakai, kd_pakai, truck, jml_pakai, jenis_part, sat, nama_merk, status_pakai, ket_pakai, tgl_pakai'
      );
    // --for searching needed

    return $this->datatables->generate();
  }
  // end for detail all pakai datatables

  public function getAllDataPakai($truck, $bulan)
  {
    $y = date('Y', strtotime($bulan));
    $m = date('m', strtotime($bulan));

    $this->db->select('a.id_detail_pakai, a.kd_pakai, a.status_part_pakai, a.jml_pakai, a.status_pakai, a.ket_pakai, b.jenis_part, b.sat, c.nama_merk, d.tgl_pakai, e.plat_no_truck as truck')
      ->from('detail_pakai a')
      ->join('stok_part b', 'b.id_part = a.part_id', 'left')
      ->join('merk c', 'c.id_merk = a.merk_id', 'left')
      ->join('pakai_part d', 'd.kd_pakai = a.kd_pakai')
      ->join('truck e', 'e.id_truck = d.truck_id')
      ->where('YEAR(d.tgl_pakai) =', $y)
      ->where('MONTH(d.tgl_pakai) =', $m);

      if($truck){
        $this->db->where('d.truck_id', $truck);
      }

    $query = $this->db->get()->result();
    return $query;
  }

  public function getDetailAllPakai($id)
  {
    $this->db->select('a.id_detail_pakai, a.kd_pakai, a.status_part_pakai, a.jml_pakai, a.status_pakai, a.ket_pakai, b.id_part, b.jenis_part, b.sat, c.id_merk, c.nama_merk, d.total_pakai, d.tgl_pakai, e.id_truck, e.plat_no_truck as truck')
      ->from('detail_pakai a')
      ->join('stok_part b', 'b.id_part = a.part_id', 'left')
      ->join('merk c', 'c.id_merk = a.merk_id', 'left')
      ->join('pakai_part d', 'd.kd_pakai = a.kd_pakai')
      ->join('truck e', 'e.id_truck = d.truck_id')
      ->where('a.id_detail_pakai', $id);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getFilter($awal, $akhir)
  {
    $this->db->select('*');
    $this->db->from('pakai_part');
    $this->db->where('date(pakai_part.tgl_pakai) >=', $awal);
    $this->db->where('date(pakai_part.tgl_pakai) <=', $akhir);
    $this->db->join('truck', 'truck.id_truck = pakai_part.truck_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getFilterTruck($platno, $dari, $sampai)
  {
    $this->db->select('*');
    $this->db->from('pakai_part');
    $this->db->where('date(pakai_part.tgl_pakai) >=', $dari);
    $this->db->where('date(pakai_part.tgl_pakai) <=', $sampai);
    $this->db->join('truck', 'truck.id_truck = pakai_part.truck_id');
    $this->db->where('plat_no_truck', $platno);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getFilterTruckDate($platno, $tglpakai)
  {
    $this->db->select('*');
    $this->db->from('pakai_part');
    $this->db->where('date(pakai_part.tgl_pakai) =', $tglpakai);
    $this->db->join('truck', 'truck.id_truck = pakai_part.truck_id');
    $this->db->where('plat_no_truck', $platno);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getKdPakai($kd)
  {
    $this->db->select('*');
    $this->db->from('pakai_part');
    $this->db->join('truck', 'truck.id_truck = pakai_part.truck_id', 'left');
    $this->db->join('user', 'user.id_user = pakai_part.user_id', 'left');
    $this->db->where('pakai_part.kd_pakai', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDetailPakai($kd)
  {
    $this->db->select('*');
    $this->db->from('detail_pakai');
    $this->db->join('stok_part', 'stok_part.id_part = detail_pakai.part_id', 'left');
    $this->db->join('merk', 'merk.id_merk = detail_pakai.merk_id', 'left');
    $this->db->where('detail_pakai.kd_pakai', $kd);
    $query = $this->db->get()->result();

    return $query;
  }

  public function getIdDetailPakai($id)
  {
    $this->db->select('*');
    $this->db->from('detail_pakai');
    $this->db->join('stok_part', 'stok_part.id_part = detail_pakai.part_id', 'left');
    $this->db->join('merk', 'merk.id_merk = detail_pakai.merk_id', 'left');
    $this->db->join('pakai_part', 'pakai_part.kd_pakai = detail_pakai.kd_pakai');
    $this->db->where(['detail_pakai.id_detail_pakai' => $id]);
    $query = $this->db->get();
    return $query->row();
  }

  public function getJmlPakaiId($id)
  {
    $this->db->select('*')
      ->from('detail_pakai')
      ->where('detail_pakai.id_detail_pakai', $id);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getTotPakaiId($id)
  {
    $this->db->select('*')
      ->from('pakai_part')
      ->where('pakai_part.kd_pakai', $id);

    $query = $this->db->get()->row();

    return $query;
  }

  public function addData($datapakai, $detailpakai)
  {
    $this->db->insert('pakai_part', $datapakai);
    $this->db->insert_batch('detail_pakai', $detailpakai);
  }

  public function addHistory($historyPakai)
  {
    $this->db->insert_batch('history_part', $historyPakai);
  }

  public function getIdDetail($id)
  {
    return $this->db->get('detail_pakai', ['id_detail_pakai' => $id])->row_array();
  }

  public function delete($kd)
  {
    $this->db->delete('pakai_part', ['kd_pakai' => $kd]);
    $this->db->delete('detail_pakai', ['kd_pakai' => $kd]);
    $this->db->delete('history_part', ['kd_history_part' => $kd]);
  }
}
