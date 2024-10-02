<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_model extends CI_Model
{
  public function getData($user)
  {
    $this->datatables->select('
                              a.id_part, a.jenis_part, a.sat, 
                              a.part_baru, a.part_bekas, 
                              (a.part_baru + a.part_bekas) as jml, 
                              a.rak, a.part_in, 
                              b.id_merk, b.nama_merk
                              ')
      ->from('stok_part a')
      ->join('merk b', 'b.id_merk = a.merk_id', 'left');

    if ($user == 'admin') {
      $this->datatables->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="javascript:void(0);" class="btn btn-sm border border-light btn-warning text-white btn-edit-stok" data-id="$1" title="Edit">
            <i class="fas fa-pencil-alt fa-sm"></i>
          </a>
          <a href="http://localhost/he-bengkel/stok/riwayat/$1" class="btn btn-sm border border-light btn-info text-white" title="History">
            <i class="fas fa-history fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm border border-light btn-danger text-white btn-delete-stok" data-id="$1" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
        'id_part, jenis_part, nama_merk, sat, part_baru, part_bekas, jml, rak, part_in'
      );
    } else {
      $this->datatables->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="http://localhost/he-bengkel/stok/riwayat/$1" class="btn btn-sm border border-light btn-info text-white" title="History">
            <i class="fas fa-history fa-sm"></i>
          </a>
        </div>',
        'id_part, jenis_part, nama_merk, sat, part_baru, part_bekas, jml, rak, part_in'
      );
    }

    return $this->datatables->generate();
  }

  public function getId($id)
  {
    $this->db->select('*')
      ->from('stok_part')
      ->where('id_part', $id);

    return $this->db->get()->row();
  }

  public function getStok()
  {
    $this->db->select('
                      a.id_part, a.merk_id, a.jenis_part, a.sat, 
                      a.part_baru, a.part_bekas, a.rak, 
                      a.part_in, a.part_edit, 
                      b.id_merk, b.nama_merk
                      ')
      ->from('stok_part a')
      ->join('merk b', 'b.id_merk = a.merk_id', 'left');

    $query = $this->db->get()->result();

    return $query;
  }

  public function getChartStok()
  {
    $this->db->select('*')
      ->from('stok_part')
      ->join('merk', 'merk.id_merk = stok_part.merk_id', 'left')
      ->limit(10);

    $query = $this->db->get();

    return $query->result_array();
  }

  public function getRowsHistory($id)
  {
    return $this->db->get_where('history_part', ['part_history_id' => $id])->num_rows();
  }

  public function getHistory($id, $limit, $start)
  {
    $this->db->select('
                      a.id_part, a.jenis_part, 
                      b.id_history_part, b.kd_history_part, 
                      b.part_history_id, b.ket_history_part, 
                      b.ket_trans_part, b.tgl_part_history
                      ')
      ->from('stok_part a')
      ->join('history_part b', 'b.part_history_id = a.id_part')
      ->where('a.id_part', $id)
      ->order_by('b.tgl_part_history', 'desc')
      ->limit($limit, $start);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getFilter($awal, $akhir)
  {
    $this->db->select('
                      a.id_part, a.merk_id, a.jenis_part, a.sat, 
                      a.part_baru, a.part_bekas, a.rak, 
                      a.part_in, a.part_edit, 
                      b.id_merk, b.nama_merk
                      ')
      ->from('stok_part a')
      ->where('date(a.part_in) >=', $awal)
      ->where('date(a.part_in) <=', $akhir)
      ->join('merk b', 'b.id_merk = a.merk_id', 'left');

    $query = $this->db->get();

    return $query->result_array();
  }

  public function chartPart()
  {
    $query = "SELECT COUNT(*) AS total, jenis_part FROM stok_part
              GROUP BY jenis_part ORDER BY jenis_part DESC";

    $result = $this->db->query($query)->result_array();

    return $result;
  }

  public function getStokBaru()
  {
    $a = $this->db->get_where('stok_part', 'part_baru = 0');

    return $a->result();
  }

  public function getStokBekas()
  {
    $a = $this->db->get_where('stok_part', 'part_bekas = 0');

    return $a->result();
  }

  public function getDataStok()
  {
    $this->db->select('
                      a.id_part, a.jenis_part, a.sat, 
                      a.part_baru, a.part_bekas, 
                      b.id_merk, b.nama_merk
                      ')
      ->from('stok_part a')
      ->join('merk b', 'b.id_merk = a.merk_id', 'left')
      ->order_by('a.jenis_part', 'asc');

    $res = $this->db->get()->result();

    return $res;
  }

  public function getSearchDataStok($keyword)
  {
    $this->db->select('
                      a.id_part, a.jenis_part, a.sat, 
                      a.part_baru, a.part_bekas, 
                      b.id_merk, b.nama_merk
                      ')
      ->from('stok_part a')
      ->join('merk b', 'b.id_merk = a.merk_id', 'left')
      ->like('a.jenis_part', $keyword);

    $res = $this->db->get()->result();

    return $res;
  }

  public function addNewData($datapart)
  {
    $this->db->insert('stok_part', $datapart);

    return $this->db->insert_id();
  }

  public function addStok($data)
  {
    return $this->db->insert('stok_part', $data);
  }

  public function editStok($data, $where)
  {
    return $this->db->update('stok_part', $data, $where);
  }

  public function deleteStok($id)
  {
    return $this->db->delete('stok_part', ['id_part' => $id]);
  }

  public function countPart()
  {
    $query = $this->db->get('stok_part')->result_array();

    $total = 0;

    $allpart = $query;

    foreach ($allpart as $all) {
      $a = $all['part_baru'];
      $b = $all['part_bekas'];
      $c = $a + $b;

      $total += $c;
    }

    return $total;
  }

  public function jenisPart($id)
  {
    $this->db->select('*')
      ->from('stok_part a')
      ->join('merk b', 'b.id_merk = a.merk_id', 'left')
      ->where(['a.id_part' => $id]);

    $query = $this->db->get();

    return $query->row();
  }
}
