<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class ReturBan_model extends CI_Model
{

  public function cekKdRetur()
  {
    $date = date('mdYHis');
    $tr   = "rtb-";
    $kd   = $tr .  $date;

    return $kd;
  }

  public function getData()
  {
    $this->datatables->select('a.id_retur_ban, a.kd_retur_ban, a.kd_beli_ban, a.jml_ban_retur, a.ket_ban_retur, a.tgl_ban_retur, b.id_toko, b.nama_toko')
      ->from('retur_ban a')
      ->join('toko b', 'b.id_toko = a.toko_ban_id');

    return $this->datatables->generate();
  }

  public function getFilter($awal, $akhir)
  {
    $this->db->select('*');
    $this->db->from('retur_part');
    $this->db->where('date(retur_part.tgl_retur) >=', $awal);
    $this->db->where('date(retur_part.tgl_retur) <=', $akhir);
    $this->db->join('stok_part', 'stok_part.id_part = retur_part.part_id');
    $this->db->join('merk', 'merk.id_merk = retur_part.merk_id', 'left');
    $this->db->join('toko', 'toko.id_toko = retur_part.toko_id');
    $this->db->join('beli_part', 'beli_part.kd_beli = retur_part.kd_beli', 'left');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function returBan($insertdataretur, $noseribanretur, $datahistori)
  {
    $this->db->insert('retur_ban', $insertdataretur);
    $this->db->delete('ban', $noseribanretur);
    $this->db->insert('history_ban', $datahistori);
  }

  public function getBanMasukRetur($kd)
  {
    $this->db->select('*')
      ->from('detail_retur_ban')
      // ->join('ban', 'ban.no_seri = detail_retur_ban.noseri_ban_retur')
      ->join('merk', 'merk.id_merk = detail_retur_ban.merk_id_retur')
      ->join('retur_ban', 'retur_ban.kd_retur_ban = detail_retur_ban.kd_retur_ban', 'left')
      ->where('detail_retur_ban.kd_beli_ban', $kd);

    $query = $this->db->get()->result_array();
    return $query;
  }
}
