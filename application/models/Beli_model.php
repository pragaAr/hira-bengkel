<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beli_model extends CI_Model
{
  public function cekDo()
  {
    $date = date('mdYHis');
    $tr   = "trm-";
    $kd   = $tr .  $date;

    return $kd;
  }

  public function getData()
  {
    $this->datatables->select('
                              a.id_beli, a.kd_beli, a.no_nota, 
                              a.total_beli, a.diskon_all, a.ppn, a.total_harga, 
                              a.tgl_beli, a.status_bayar, a.tgl_pelunasan, a.retur, 
                              b.id_toko, b.nama_toko
                              ')
      ->from('beli_part a')
      ->join('toko b', 'b.id_toko = a.toko_id', 'left')
      ->add_column(
        'view',
        '<div class="btn-group" role="group"> 
        <a href="http://localhost/he-bengkel/beli/detail/$2" class="btn btn-sm border border-light btn-success text-white" title="Detail">
          <i class="fas fa-eye fa-sm"></i>
        </a>
        <a href="javascript:void(0);" class="btn btn-sm border border-light btn-danger text-white btn-delete" data-kd="$2" title="Delete">
            <i class="fas fa-trash fa-sm"></i>
        </a>
      </div>',
        'id_beli, kd_beli, no_nota, nama_toko, total_beli, diskon_all, ppn, total_harga, status_bayar, retur, tgl_beli'
      );

    return $this->datatables->generate();
  }

  public function getAllBeli()
  {
    $this->datatables->select('
                              a.id_detail_beli, a.kd_beli, a.merk_id, 
                              a.status_part_beli, a.jml_beli, a.harga_pcs, 
                              a.sub_total, a.ket_beli, 
                              b.jenis_part, b.sat, c.nama_merk, 
                              d.kd_beli, d.no_nota, d.tgl_beli, 
                              e.nama_toko
                              ')
      ->from('detail_beli a')
      ->join('stok_part b', 'b.id_part = a.part_id', 'left')
      ->join('merk c', 'c.id_merk = b.merk_id', 'left')
      ->join('beli_part d', 'd.kd_beli = a.kd_beli')
      ->join('toko e', 'e.id_toko = d.toko_id', 'left')
      ->where('a.kd_beli = d.kd_beli')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
         <a href="javascript:void(0);" class="btn btn-sm border border-light btn-danger text-white btn-retur-part" data-id="$1" title="Retur Part">
            <i class="fas fa-exchange-alt fa-sm"></i>
          </a>
      </div>',
        'id_detail_beli, kd_beli, no_nota, nama_toko, jenis_part, nama_merk, status_part_beli, jml_beli, harga_pcs, sub_total, ket_beli, tgl_beli'
      );

    return $this->datatables->generate();
  }

  public function getAllDataBeli($toko = '', $bulan)
  {
    $y = date('Y', strtotime($bulan));
    $m = date('m', strtotime($bulan));

    $this->db->select('
                      a.id_detail_beli, a.kd_beli, a.merk_id, 
                      a.status_part_beli, a.jml_beli, a.harga_pcs, 
                      a.diskon, a.sub_total, a.ket_beli, 
                      b.jenis_part, b.sat, c.nama_merk, 
                      d.kd_beli, d.no_nota, d.tgl_beli, 
                      e.nama_toko
                      ')
      ->from('detail_beli a')
      ->join('stok_part b', 'b.id_part = a.part_id', 'left')
      ->join('merk c', 'c.id_merk = b.merk_id', 'left')
      ->join('beli_part d', 'd.kd_beli = a.kd_beli')
      ->join('toko e', 'e.id_toko = d.toko_id', 'left')
      ->where('a.kd_beli = d.kd_beli')
      ->where('YEAR(d.tgl_beli) =', $y)
      ->where('MONTH(d.tgl_beli) =', $m);

    if (!empty($toko)) {
      $this->db->where('d.toko_id', $toko);
    }

    $query = $this->db->get()->result();

    return $query;
  }

  public function getKdBeli($kd)
  {
    $this->db->select('
                      a.id_beli, a.kd_beli, a.toko_id, a.no_nota, 
                      a.total_beli, a.diskon_all, a.ppn, 
                      a.total_harga, a.tgl_beli, a.status_bayar, 
                      b.id_toko, b.nama_toko, c.id_user, c.nama_user
                      ')
      ->from('beli_part a')
      ->join('toko b', 'b.id_toko = a.toko_id')
      ->join('user c', 'c.id_user = a.user_id', 'left')
      ->where('a.kd_beli', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDetailBeli($kd)
  {
    $this->db->select('
                      a.id_detail_beli, a.kd_beli, a.part_id, 
                      a.merk_id, a.status_part_beli, a.jml_beli, 
                      a.harga_pcs, a.diskon, a.sub_total, a.ket_beli, 
                      b.id_part, b.merk_id, b.jenis_part, b.sat, 
                      c.id_merk, c.nama_merk
                      ')
      ->from('detail_beli a')
      ->join('stok_part b', 'b.id_part = a.part_id', 'left')
      ->join('merk c', 'c.id_merk = a.merk_id', 'left')
      ->where('a.kd_beli', $kd);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getDetailById($id)
  {
    $this->db->select('
                      a.id_detail_beli, a.kd_beli, a.part_id, 
                      a.merk_id, a.status_part_beli, a.jml_beli, 
                      a.harga_pcs, a.diskon, a.sub_total, 
                      c.jenis_part, c.sat, 
                      d.nama_merk, 
                      e.id_toko, e.nama_toko
                      ')
      ->from('detail_beli a')
      ->join('beli_part b', 'b.kd_beli = a.kd_beli', 'left')
      ->join('stok_part c', 'c.id_part = a.part_id', 'left')
      ->join('merk d', 'd.id_merk = a.merk_id', 'left')
      ->join('toko e', 'e.id_toko = b.toko_id', 'left')
      ->where('a.id_detail_beli', $id);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getFilter($awal, $akhir)
  {
    $this->db->select('
                      a.id_beli, a.kd_beli, a.toko_id, a.no_nota, 
                      a.total_beli, a.diskon_all, a.ppn, a.total_harga, 
                      a.tgl_beli, a.status_bayar, a.tgl_pelunasan, a.retur, 
                      b.id_toko, b.nama_toko
                      ')
      ->from('beli_part a')
      ->join('toko b', 'b.id_toko = a.toko_id')
      ->where('date(a.tgl_beli) >=', $awal)
      ->where('date(a.tgl_beli) <=', $akhir);

    $query = $this->db->get();

    return $query->result_array();
  }

  public function getFilterToko($datatoko, $dari, $sampai)
  {
    $this->db->select('
                      a.id_beli, a.kd_beli, a.toko_id, a.no_nota, 
                      a.total_beli, a.diskon_all, a.ppn, 
                      a.total_harga, a.tgl_beli, a.status_bayar, 
                      a.tgl_pelunasan, a.retur, 
                      b.id_toko, b.nama_toko
                      ')
      ->from('beli_part a')
      ->join('toko b', 'b.id_toko = a.toko_id')
      ->where('date(a.tgl_beli) >=', $dari)
      ->where('date(a.tgl_beli) <=', $sampai)
      ->where(['b.nama_toko' => $datatoko]);

    $query = $this->db->get();

    return $query->result_array();
  }

  public function getFilterTokoPrint($dari, $sampai, $nama_toko)
  {
    $this->db->select('
                      a.id_beli, a.kd_beli, a.toko_id, a.no_nota, 
                      a.total_beli, a.diskon_all, a.ppn, a.total_harga, 
                      a.tgl_beli, a.status_bayar, a.tgl_pelunasan, a.retur, 
                      b.id_toko, b.nama_toko
                      ')
      ->from('beli_part a')
      ->join('toko b', 'b.id_toko = a.toko_id')
      ->where('date(a.tgl_beli) >=', $dari)
      ->where('date(a.tgl_beli) <=', $sampai)
      ->where(['b.nama_toko' => $nama_toko]);

    $query = $this->db->get();

    return $query->result_array();
  }

  public function getTotalBayar($kd)
  {
    $this->db->select('
                      a.kd_beli, a.total_harga, 
                      b.kd_beli, b.jml_beli_retur, b.harga_pcs_retur
                      ')
      ->from('beli_part a')
      ->join('detail_retur_part b', 'b.kd_beli = a.kd_beli')
      ->where('a.kd_beli', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function addData($data_beli, $detail_beli)
  {
    $this->db->insert('beli_part', $data_beli);

    $this->db->insert_batch('detail_beli', $detail_beli);
  }

  public function getSum()
  {
    $query = $this->db->query("SELECT * FROM beli_part where MONTH(tgl_beli)=MONTH(NOW())")->result_array();

    $total = 0;

    $allbeli = $query;

    foreach ($allbeli as $all) {
      $a = $all['total_harga'];
      $total += $a;
    }

    return $total;
  }

  public function filterSum($month, $year)
  {
    $this->db->select('*')
      ->from('beli_part')
      ->where('MONTH(beli_part.tgl_beli)', $month)
      ->where('YEAR(beli_part.tgl_beli)', $year);

    $query = $this->db->get()->result_array();

    $total = 0;

    $filterDate = $query;

    foreach ($filterDate as $all) {
      $a = $all['total_harga'];
      $total += $a;
    }

    return $total;
  }

  public function listTunai($input)
  {
    $year   = date('Y', strtotime($input));
    $month  = date('m', strtotime($input));

    $this->db->select('
                      a.kd_beli, a.total_beli, a.total_harga, a.tgl_beli, 
                      b.nama_toko
                      ')
      ->from('beli_part a')
      ->join('toko b', 'b.id_toko = a.toko_id', 'left')
      ->where('MONTH(a.tgl_beli)', $month)
      ->where('YEAR(a.tgl_beli)', $year)
      ->where('a.status_bayar', 'lunas');

    $query = $this->db->get()->result();

    return $query;
  }

  public function listTempo($input)
  {
    $year   = date('Y', strtotime($input));
    $month  = date('m', strtotime($input));

    $this->db->select('
                      a.kd_beli, a.total_beli, a.total_harga, a.tgl_beli, 
                      b.nama_toko
                      ')
      ->from('beli_part a')
      ->join('toko b', 'b.id_toko = a.toko_id', 'left')
      ->where('MONTH(a.tgl_beli)', $month)
      ->where('YEAR(a.tgl_beli)', $year)
      ->where('a.status_bayar', 'tempo');

    $query = $this->db->get()->result();

    return $query;
  }

  public function sumBeli($input)
  {
    $year   = date('Y', strtotime($input));
    $month  = date('m', strtotime($input));

    $this->db->select('SUM(total_harga) as total, SUM(total_beli) as items')
      ->from('beli_part')
      ->where('MONTH(tgl_beli)', $month)
      ->where('YEAR(tgl_beli)', $year);

    $query = $this->db->get()->row();

    return $query;
  }

  public function sumTunai($input)
  {
    $year   = date('Y', strtotime($input));
    $month  = date('m', strtotime($input));

    $this->db->select('SUM(total_harga) as total')
      ->from('beli_part')
      ->where('MONTH(tgl_beli)', $month)
      ->where('YEAR(tgl_beli)', $year)
      ->where('status_bayar', 'lunas')
      ->where('status_bayar', 'Lunas');

    $query = $this->db->get()->row();

    return $query;
  }

  public function sumTempo($input)
  {
    $year   = date('Y', strtotime($input));
    $month  = date('m', strtotime($input));

    $this->db->select('SUM(total_harga) as total')
      ->from('beli_part')
      ->where('MONTH(tgl_beli)', $month)
      ->where('YEAR(tgl_beli)', $year)
      ->where('status_bayar', 'Tempo')
      ->where('status_bayar', 'tempo');

    $query = $this->db->get()->row();

    return $query;
  }

  public function getYearlySalesTotals($input)
  {
    $this->db->select('MONTH(tgl_beli) as month, SUM(total_harga) as total')
      ->from('beli_part')
      ->where('YEAR(tgl_beli)', $input)
      ->group_by('MONTH(tgl_beli)')
      ->order_by('MONTH(tgl_beli)', 'ASC');

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

  public function getSumId($kd)
  {
    $query = $this->db->get_where('detail_beli', ['kd_beli' => $kd])->result();

    $total = 0;

    $allbeli = $query;

    foreach ($allbeli as $all) {
      $a = $all->sub_total;
      $total += $a;
    }

    return $total;
  }

  public function pelunasan($status, $where)
  {
    $this->db->update('beli_part', $status, $where);
  }

  public function addNewStok()
  {
    $jenis_part   = $this->input->post('new_jenis_part');
    $merk_id      = $this->input->post('new_merk_id');
    $sat          = $this->input->post('new_sat');
    $part_baru    = $this->input->post('new_part_baru');
    $part_bekas   = $this->input->post('new_part_bekas');
    $part_in      = date('Y-m-d H:i:s');
    $part_edit    = "0000-00-00 00:00:00";
    $user_id      = $this->session->userdata('id_user');

    $data = [
      'jenis_part'  => $jenis_part,
      'merk_id'     => $merk_id,
      'sat'         => $sat,
      'part_baru'   => $part_baru,
      'part_bekas'  => $part_bekas,
      'part_in'     => $part_in,
      'part_edit'   => $part_edit,
      'user_id'     => $user_id,
    ];

    $this->db->insert('stok_part', $data);
  }

  public function addHistory($historyBeli)
  {
    $this->db->insert_batch('history_part', $historyBeli);
  }

  public function retur($kd, $databeli)
  {
    $where = [
      'kd_beli' => $kd
    ];

    $this->db->update('beli_part', $databeli, $where);
  }

  public function delete($kd)
  {
    $this->db->delete('beli_part', ['kd_beli' => $kd]);

    $this->db->delete('detail_beli', ['kd_beli' => $kd]);

    $this->db->delete('history_part', ['kd_history_part' => $kd]);
  }
}
