<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko_model extends CI_Model
{
  public function getData()
  {
    $this->datatables->select('toko.id_toko, toko.nama_toko, toko.no_telp_toko');
    $this->datatables->from('toko');
    $this->datatables->add_column(
      'view',
      '<div class="btn-group" role="group">
          <a href="javascript:void(0);" class="btn btn-sm btn-warning text-white btn-edit-toko" data-id="$1" data-toggle="tooltip" title="Edit">
            <i class="fas fa-pencil-alt fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-delete-toko" data-id="$1" data-toggle="tooltip" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
      'id_toko, nama_toko, no_telp_toko'
    );

    return $this->datatables->generate();
  }

  public function getId($id)
  {
    $this->db->select('*');
    $this->db->from('toko');
    $this->db->where('id_toko', $id);

    return $this->db->get()->row();
  }

  public function getDataToko() // for select2
  {
    $this->db->select('id_toko, nama_toko')
      ->from('toko')
      ->order_by('nama_toko', 'asc');

    $res = $this->db->get()->result();

    return $res;
  }

  public function getSearchDataToko($keyword) // for select2 search
  {
    $this->db->select('toko.id_toko, toko.nama_toko')
      ->from('toko')
      ->like('nama_toko', $keyword);

    $res = $this->db->get()->result();

    return $res;
  }

  public function getNamaToko($idtoko)
  {
    $this->db->select('nama_toko');
    $this->db->from('toko');
    $this->db->where(['id_toko' => $idtoko]);
    $query = $this->db->get();
    return $query->row();
  }

  public function addToko($data)
  {
    return $this->db->insert('toko', $data);
  }

  public function addNewData($datatoko)
  {
    $this->db->insert('toko', $datatoko);
    return $this->db->insert_id();
  }

  public function editToko($data, $where)
  {
    return $this->db->update('toko', $data, $where);
  }

  public function deleteToko($id)
  {
    return $this->db->delete('toko', ['id_toko' => $id]);
  }
}
