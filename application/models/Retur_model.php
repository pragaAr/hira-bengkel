<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Retur_model extends CI_Model
{

  public function cekKdRetur()
  {
    $date = date('mdYHis');
    $tr   = "rtr-";
    $kd = $tr .  $date;

    return $kd;
  }

  public function getData()
  {
    $this->datatables->select('a.id_retur, a.kd_retur, a.kd_beli, a.jml_retur, a.ket_retur, a.tgl_retur, a.status_part_retur, b.id_toko, b.nama_toko')
      ->from('retur_part a')
      ->join('toko b', 'b.id_toko = a.toko_id');

    return $this->datatables->generate();
  }

  public function getRetur()
  {
    $this->db->select('*');
    $this->db->from('retur_part');
    $this->db->join('toko', 'toko.id_toko = retur_part.toko_id');
    $this->db->join('beli_part', 'beli_part.kd_beli = retur_part.kd_beli', 'left');
    $query = $this->db->get();

    return $query->result_array();
  }

  public function getFilter($awal, $akhir)
  {
    $this->db->select('*');
    $this->db->from('retur_part');
    $this->db->where('date(retur_part.tgl_retur) >=', $awal);
    $this->db->where('date(retur_part.tgl_retur) <=', $akhir);
    $this->db->join('toko', 'toko.id_toko = retur_part.toko_id');
    $this->db->join('beli_part', 'beli_part.kd_beli = retur_part.kd_beli', 'left');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function returPart($insertdataretur, $history, $datadetailretur)
  {
    $this->db->insert('retur_part', $insertdataretur);
    $this->db->insert('detail_retur_part', $datadetailretur);
    $this->db->insert('history_part', $history);
  }

  public function getPartMasukRetur($kd)
  {
    $this->db->select('a.id_detail_retur, a.kd_beli, a.kd_retur, a.part_id_retur, a.merk_id_retur, a.status_part_beli_retur, a.jml_beli_retur, a.harga_pcs_retur, a.diskon_retur, b.id_part, b.jenis_part, b.sat, c.id_merk, c.nama_merk, d.kd_retur, d.ket_retur');
    $this->db->from('detail_retur_part a');
    $this->db->join('stok_part b', 'b.id_part = a.part_id_retur');
    $this->db->join('merk c', 'c.id_merk = a.merk_id_retur', 'left');
    $this->db->join('retur_part d', 'd.kd_retur = a.kd_retur', 'left');
    $this->db->where('a.kd_beli', $kd);

    $query = $this->db->get()->result();

    return $query;
  }
}
