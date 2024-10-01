<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_model extends CI_Model
{
  // for datatables serverside
  public function getData()
  {
    $user = $this->session->userdata('user_role');

    $this->datatables->select('stok_part.id_part, stok_part.jenis_part, stok_part.sat, stok_part.part_baru, stok_part.part_bekas, (stok_part.part_baru + stok_part.part_bekas) as jml, stok_part.rak, stok_part.part_in, merk.id_merk, merk.nama_merk');
    $this->datatables->from('stok_part');
    $this->datatables->join('merk', 'merk.id_merk = stok_part.merk_id', 'left');

    if ($user == 'admin') {
      $this->datatables->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="javascript:void(0);" class="btn btn-sm btn-warning text-white btn-edit-stok" data-id="$1" data-toggle="tooltip" title="Edit">
            <i class="fas fa-pencil-alt fa-sm"></i>
          </a>
          <a href="http://localhost/he-bengkel/stok/riwayat/$1" class="btn btn-sm btn-info text-white" data-toggle="tooltip" title="History">
            <i class="fas fa-history fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-delete-stok" data-id="$1" data-toggle="tooltip" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
        'id_part, jenis_part, nama_merk, sat, part_baru, part_bekas, jml, rak, part_in'
      );
    } else {
      $this->datatables->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="http://localhost/he-bengkel/stok/riwayat/$1" class="btn btn-sm btn-info text-white" data-toggle="tooltip" title="History">
            <i class="fas fa-history fa-sm"></i>
          </a>
        </div>',
        'id_part, jenis_part, nama_merk, sat, part_baru, part_bekas, jml, rak, part_in'
      );
    }

    return $this->datatables->generate();
  }
  // end for datatables serverside


  public function getId($id)
  {
    $this->db->select('*');
    $this->db->from('stok_part');
    $this->db->where('id_part', $id);

    return $this->db->get()->row();
  }

  // for print stok
  public function getStok()
  {
    $this->db->select('a.id_part, a.merk_id, a.jenis_part, a.sat, a.part_baru, a.part_bekas, a.rak, a.part_in, a.part_edit, b.id_merk, b.nama_merk')
      ->from('stok_part a')
      ->join('merk b', 'b.id_merk = a.merk_id', 'left');

    $query = $this->db->get()->result();

    return $query;
  }
  // end for print stok

  public function getChartStok()
  {
    $this->db->select('*');
    $this->db->from('stok_part');
    $this->db->join('merk', 'merk.id_merk = stok_part.merk_id', 'left');
    $this->db->limit(10);
    $query = $this->db->get();
    return $query->result_array();
  }


  // for paginate
  public function getRowsHistory($id)
  {
    return $this->db->get_where('history_part', ['part_history_id' => $id])->num_rows();
  }

  public function getHistory($id, $limit, $start)
  {
    $this->db->select('a.id_part, a.jenis_part, b.id_history_part, b.kd_history_part, b.part_history_id, b.ket_history_part, b.ket_trans_part, b.tgl_part_history');
    $this->db->from('stok_part a');
    $this->db->join('history_part b', 'b.part_history_id = a.id_part');
    $this->db->where('a.id_part', $id);
    $this->db->order_by('b.tgl_part_history', 'desc');
    $this->db->limit($limit, $start);

    $query = $this->db->get()->result();

    return $query;
  }
  // end for paginate


  public function getFilter($awal, $akhir)
  {
    $this->db->select('stok_part.id_part, stok_part.merk_id, stok_part.jenis_part, stok_part.sat, stok_part.part_baru, stok_part.part_bekas, stok_part.rak, stok_part.part_in, stok_part.part_edit, merk.id_merk, merk.nama_merk');
    $this->db->from('stok_part');
    $this->db->where('date(stok_part.part_in) >=', $awal);
    $this->db->where('date(stok_part.part_in) <=', $akhir);
    $this->db->join('merk', 'merk.id_merk = stok_part.merk_id', 'left');
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

  // for select2 and search
  public function getDataStok()
  {
    $this->db->select('stok_part.id_part, stok_part.jenis_part, stok_part.sat, stok_part.part_baru, stok_part.part_bekas, merk.id_merk, merk.nama_merk');
    $this->db->from('stok_part');
    $this->db->join('merk', 'merk.id_merk = stok_part.merk_id', 'left');
    $this->db->order_by('jenis_part', 'asc');
    $res = $this->db->get()->result();

    return $res;
  }

  public function getSearchDataStok($keyword)
  {
    $this->db->select('stok_part.id_part, stok_part.jenis_part, stok_part.sat, stok_part.part_baru, stok_part.part_bekas, merk.id_merk, merk.nama_merk');
    $this->db->from('stok_part');
    $this->db->join('merk', 'merk.id_merk = stok_part.merk_id', 'left');
    $this->db->like('jenis_part', $keyword);
    $res = $this->db->get()->result();

    return $res;
  }
  // end for select2 and search

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
    $this->db->select('*');
    $this->db->from('stok_part');
    $this->db->join('merk', 'merk.id_merk = stok_part.merk_id', 'left');
    $this->db->where(['id_part' => $id]);
    $query = $this->db->get();
    return $query->row();
  }
}
