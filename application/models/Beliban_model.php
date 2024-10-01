<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Beliban_model extends CI_Model
{
  public function cekDo()
  {
    $date = date('mdYHis');
    $tr   = "tbn-";
    $kd   = $tr .  $date;

    return $kd;
  }

  public function checkSeri($seri)
  {
    $this->db->select('no_seri')
      ->from('ban')
      ->where('ban.no_seri', $seri);

    $query = $this->db->get()->result();

    return $query;
  }

  // for datatables
  public function getData()
  {
    $this->datatables->select('a.id_beli_ban, a.kd_beli_ban, a.no_nota_ban, a.total_beli_ban, a.total_harga_ban, a.tgl_beli_ban, a.status_bayar_ban, a.retur, b.id_toko, b.nama_toko')
      ->from('beli_ban a')
      ->join('toko b', 'b.id_toko = a.toko_ban_id', 'left')
      ->add_column(
        'view',
        '<div class="btn-group" role="group"> 
        <a href="http://localhost/he-bengkel/beli_ban/detail/$2" class="btn btn-sm btn-success text-white" data-toggle="tooltip" title="Detail">
          <i class="fas fa-eye fa-sm"></i>
        </a>
        <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-delete" data-kd="$2" data-toggle="tooltip" title="Delete">
        <i class="fas fa-trash fa-sm"></i>
      </a>
      </div>',
        'id_beli_ban, kd_beli_ban, no_nota_ban, nama_toko, total_beli_ban, total_harga_ban, status_bayar_ban, retur, tgl_beli_ban'
      );

    return $this->datatables->generate();
  }
  // end for datatables

  public function getAllBeli()
  {
    $this->datatables->select('a.id_detail_beli_ban, a.kd_beli_ban, a.status_ban_beli, a.no_seri_ban, a.ukuran_ban_beli, a.jml_beli_ban, a.harga_ban, a.diskon_ban, a.sub_total_ban, a.ket_beli_ban, b.nama_merk, c.tgl_beli_ban, d.nama_toko')
      ->from('detail_beli_ban a')
      ->join('merk b', 'b.id_merk = a.merk_ban_id', 'left')
      ->join('beli_ban c', 'c.kd_beli_ban = a.kd_beli_ban')
      ->join('toko d', 'd.id_toko = c.toko_ban_id', 'left')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
        <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-retur" data-id="$1" data-toggle="tooltip" title="Retur Ban">
          <i class="fas fa-exchange-alt fa-sm"></i>
        </a>
      </div>',
        'id_detail_beli_ban, kd_beli_ban, nama_toko, status_ban_beli, no_seri_ban, nama_merk, ukuran_ban_beli, jml_beli_ban, harga_ban, diskon_ban, sub_total_ban, tgl_beli_ban, ket_beli_ban'
      );

    return $this->datatables->generate();
  }

  public function getDetailById($id)
  {
    $this->db->select('a.id_detail_beli_ban, a.kd_beli_ban, a.status_ban_beli, a.no_seri_ban, a.ukuran_ban_beli, a.jml_beli_ban, a.harga_ban, a.diskon_ban, a.sub_total_ban, a.ket_beli_ban, b.nama_merk, c.tgl_beli_ban, d.id_toko, d.nama_toko')
      ->from('detail_beli_ban a')
      ->join('merk b', 'b.id_merk = a.merk_ban_id', 'left')
      ->join('beli_ban c', 'c.kd_beli_ban = a.kd_beli_ban')
      ->join('toko d', 'd.id_toko = c.toko_ban_id', 'left')
      ->where('a.id_detail_beli_ban', $id);

    $query = $this->db->get()->row();
    return $query;
  }

  public function getKdBeliBan($kd)
  {
    $this->db->select('*')
      ->from('beli_ban')
      ->join('toko', 'toko.id_toko = beli_ban.toko_ban_id')
      ->join('user', 'user.id_user = beli_ban.user_id', 'left')
      ->where('beli_ban.kd_beli_ban', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDetailBeliBan($kd)
  {
    $this->db->select('*');
    $this->db->from('detail_beli_ban');
    $this->db->join('merk', 'merk.id_merk = detail_beli_ban.merk_ban_id', 'left');
    $this->db->where(['detail_beli_ban.kd_beli_ban' => $kd]);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getDataDetailId($id)
  {
    $this->db->select('*');
    $this->db->from('detail_beli_ban');
    $this->db->join('beli_ban', 'beli_ban.kd_beli_ban = detail_beli_ban.kd_beli_ban');
    $this->db->join('merk', 'merk.id_merk = detail_beli_ban.merk_ban_id', 'left');
    $this->db->where(['detail_beli_ban.kd_beli_ban' => $id]);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getJmlSubTotal($kd)
  {
    $this->db->select('jml_beli_ban, sub_total_ban');
    $this->db->from('detail_beli_ban');
    $this->db->where(['detail_beli_ban.kd_beli_ban' => $kd]);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getAllBeliBan()
  {
    $this->db->select('*');
    $this->db->from('detail_beli_ban');
    $this->db->join('ban', 'ban.no_seri = detail_beli_ban.no_seri_ban');
    $this->db->join('merk', 'merk.id_merk = detail_beli_ban.merk_ban_id', 'left');
    $this->db->from('beli_ban');
    $this->db->join('toko', 'toko.id_toko = beli_ban.toko_ban_id', 'left');
    $this->db->where('detail_beli_ban.kd_beli_ban = beli_ban.kd_beli_ban');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getTotalBayar($kd)
  {
    $this->db->select('beli_ban.kd_beli_ban, beli_ban.total_harga_ban, detail_retur_ban.kd_beli_ban, detail_retur_ban.jml_beli_ban_retur, detail_retur_ban.harga_ban_retur');
    $this->db->from('beli_ban');
    $this->db->join('detail_retur_ban', 'detail_retur_ban.kd_beli_ban = beli_ban.kd_beli_ban');
    $this->db->where(['beli_ban.kd_beli_ban' => $kd]);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function addBeli($databeli, $detailbeli, $stok, $history)
  {
    $this->db->insert('beli_ban', $databeli);

    $this->db->insert_batch('ban', $stok);

    $this->db->insert_batch('detail_beli_ban', $detailbeli);

    $this->db->insert_batch('history_ban', $history);
  }

  public function getSumId($kd)
  {
    $query = $this->db->get_where('detail_beli_ban', ['kd_beli_ban' => $kd])->result_array();

    $total = 0;
    $allbeli = $query;
    foreach ($allbeli as $all) {
      $a = $all['sub_total_ban'];
      $total += $a;
    }
    return $total;
  }

  public function sumBeli($input)
  {
    $year   = date('Y', strtotime($input));
    $month  = date('m', strtotime($input));

    $this->db->select('SUM(total_harga_ban) as total, SUM(total_beli_ban) as items')
      ->from('beli_ban')
      ->where('MONTH(tgl_beli_ban)', $month)
      ->where('YEAR(tgl_beli_ban)', $year);

    $query = $this->db->get()->row();

    return $query;
  }

  public function sumTunai($input)
  {
    $year   = date('Y', strtotime($input));
    $month  = date('m', strtotime($input));

    $this->db->select('SUM(total_harga_ban) as total')
      ->from('beli_ban')
      ->where('MONTH(tgl_beli_ban)', $month)
      ->where('YEAR(tgl_beli_ban)', $year)
      ->where('status_bayar_ban', 'lunas')
      ->where('status_bayar_ban', 'Lunas');

    $query = $this->db->get()->row();

    return $query;
  }

  public function sumTempo($input)
  {
    $year   = date('Y', strtotime($input));
    $month  = date('m', strtotime($input));

    $this->db->select('SUM(total_harga_ban) as total')
      ->from('beli_ban')
      ->where('MONTH(tgl_beli_ban)', $month)
      ->where('YEAR(tgl_beli_ban)', $year)
      ->where('status_bayar_ban', 'Tempo')
      ->where('status_bayar_ban', 'tempo');

    $query = $this->db->get()->row();

    return $query;
  }

  public function getYearlySalesTotals($input)
  {
    $this->db->select('MONTH(tgl_beli_ban) as month, SUM(total_harga_ban) as total')
      ->from('beli_ban')
      ->where('YEAR(tgl_beli_ban)', $input)
      ->group_by('MONTH(tgl_beli_ban)')
      ->order_by('MONTH(tgl_beli_ban)', 'ASC');

    $query = $this->db->get()->result();

    $completeData = [];
    for ($i = 1; $i <= 12; $i++) {
      $found = false;
      foreach ($query as $result) {
        if ($result->month == $i) {
          $completeData[] = $result;
          $found = true;
          break;
        }
      }
      if (!$found) {
        $completeData[] = (object) ['month' => $i, 'total' => 0];
      }
    }

    return $completeData;
  }

  public function pelunasan($status, $where)
  {
    return $this->db->update('beli_ban', $status, $where);
  }

  public function retur($datadetailretur, $kd,  $databeli)
  {
    $kdbeli = array(
      'kd_beli_ban' => $kd
    );

    $this->db->update('beli_ban', $databeli, $kdbeli);

    $this->db->insert('detail_retur_ban', $datadetailretur);
  }

  public function getSeriBan($kd)
  {
    $this->db->select('a.kd_beli_ban, a.no_seri_ban, b.no_seri')
      ->from('detail_beli_ban a')
      ->where('a.kd_beli_ban', $kd)
      ->join('ban b', 'b.no_seri = a.no_seri_ban');

    $query = $this->db->get()->result_array();

    return $query;
  }

  public function delete($kd)
  {
    $this->db->delete('beli_ban', ['kd_beli_ban' => $kd]);

    $this->db->delete('detail_beli_ban', ['kd_beli_ban' => $kd]);

    $this->db->delete('history_ban', ['kd_history_ban' => $kd]);
  }

  public function deleteseri($hasil)
  {
    $this->db->where_in('no_seri', $hasil);
    $this->db->delete('ban');
  }
}
