<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Repair_model extends CI_Model
{
  public function cekKdRepair()
  {
    $date = date('mdYHis');
    $tr   = "rep-";
    $kd   = $tr .  $date;

    return $kd;
  }

  public function getData()
  {
    $this->datatables->select('
                              a.id_repair, a.kd_repair, a.total_repair, a.tgl_repair, 
                              b.nama_toko
                              ')
      ->from('repair_part a')
      ->join('toko b', 'b.id_toko = a.toko_id')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="http://localhost/he-bengkel/repair/detail/$2" class="btn btn-sm border border-light btn-success text-white" title="Detail">
            <i class="fas fa-eye fa-sm"></i>
          </a>
          <a href="http://localhost/he-bengkel/repair/print/$2" target="_blank" class="btn btn-sm border border-light btn-info text-white" title="Print">
            <i class="fas fa-print fa-sm"></i>
          </a>
        </div>',
        'id_repair, kd_repair, total_repair, tgl_repair, nama_toko'
      );

    return $this->datatables->generate();
  }

  public function getRepairKd($kd)
  {
    $this->db->select('
                      a.id_repair, a.kd_repair, a.total_repair, a.tgl_repair, 
                      b.nama_toko, c.nama_user
                      ')
      ->from('repair_part a')
      ->join('toko b', 'b.id_toko = a.toko_id')
      ->join('user c', 'c.id_user = a.user_id', 'left')
      ->where('a.kd_repair', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDetailRepair($kd)
  {
    $this->db->select('
                      a.kd_repair, a.status_part_repair, 
                      a.jml_repair, a.status_repair, a.ket_repair, 
                      c.jenis_part, c.sat, 
                      d.nama_merk
                      ')
      ->from('detail_repair a')
      ->join('repair_part b', 'b.kd_repair = a.kd_repair')
      ->join('stok_part c', 'c.id_part = a.part_id')
      ->join('merk d', 'd.id_merk = a.merk_id', 'left')
      ->where('a.kd_repair', $kd);

    $query = $this->db->get()->result();

    return $query;
  }

  public function addData($datarepair, $detailrepair)
  {
    $this->db->insert('repair_part', $datarepair);

    $this->db->insert_batch('detail_repair', $detailrepair);
  }

  public function addHistory($historyrepair)
  {
    $this->db->insert_batch('history_part', $historyrepair);
  }

  public function getSuratJalan($kd)
  {
    $this->db->select('
                      a.status_part_repair, a.status_repair, 
                      a.jml_repair, a.ket_repair, 
                      b.jenis_part, b.sat, 
                      c.nama_merk
                      ')
      ->from('detail_repair a')
      ->join('stok_part b', 'b.id_part = a.part_id')
      ->join('merk c', 'c.id_merk = a.merk_id', 'left')
      ->where('a.kd_repair', $kd);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getHeaderRepair($kd)
  {
    $this->db->select('tgl_repair, nama_toko')
      ->from('repair_part')
      ->join('toko', 'toko.id_toko = repair_part.toko_id')
      ->where('repair_part.kd_repair', $kd);

    $query = $this->db->get()->row();

    return $query;
  }
}
