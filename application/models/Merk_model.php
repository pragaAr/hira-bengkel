<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Merk_model extends CI_Model
{
  public function getData($role)
  {
    $this->datatables->select('id_merk, nama_merk')
      ->from('merk');

    $this->datatables->add_column(
      'view',
      '<div class="btn-group" role="group">
          <a href="javascript:void(0);" class="btn btn-sm border border-light btn-warning text-white btn-edit-merk" data-id="$1" title="Edit">
            <i class="fas fa-pencil-alt fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm border border-light btn-danger text-white btn-delete-merk" data-id="$1" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
      'id_merk, nama_merk'
    );

    return $this->datatables->generate();
  }

  public function getId($id)
  {
    $this->db->select('*')
      ->from('merk')
      ->where('id_merk', $id);

    return $this->db->get()->row();
  }

  public function selectMerk()
  {
    $this->db->select('id_merk, nama_merk')
      ->from('merk');

    $res = $this->db->get()->result();

    return $res;
  }

  public function selectSearchMerk($keyword)
  {
    $this->db->select('id_merk, nama_merk')
      ->from('merk')
      ->like('nama_merk', $keyword);

    $res = $this->db->get()->result();

    return $res;
  }

  public function addMerk($data)
  {
    return $this->db->insert('merk', $data);
  }

  public function addNewData($datamerk)
  {
    $this->db->insert('merk', $datamerk);

    return $this->db->insert_id();
  }

  public function editMerk($data, $where)
  {
    return $this->db->update('merk', $data, $where);
  }

  public function deleteMerk($id)
  {
    return $this->db->delete('merk', ['id_merk' => $id]);
  }

  public function dataMerk($id)
  {
    $this->db->select('*')
      ->from('merk')
      ->where(['id_merk' => $id]);

    $query = $this->db->get();

    return $query->row();
  }
}
