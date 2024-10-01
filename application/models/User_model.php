<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_MODEL
{
  public function cekUserName($uname)
  {
    $this->db->select('username');
    $this->db->from('user');
    $this->db->where('username', $uname);
    $query = $this->db->get()->result();

    return $query;
  }

  public function getData()
  {
    $this->datatables->select('user.id_user, user.nama_user, user.no_telp_user, user.username, user.user_role');
    $this->datatables->from('user');
    $this->datatables->add_column(
      'view',
      '<div class="btn-group" role="group">
          <a href="javascript:void(0);" class="btn btn-sm btn-warning text-white btn-edit-user" data-id="$1" data-toggle="tooltip" title="Edit">
            <i class="fas fa-pencil-alt fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-delete-user" data-id="$1" data-toggle="tooltip" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
      'id_user, nama_user, no_telp_user, username, user_role'
    );

    return $this->datatables->generate();
  }

  public function getId($id)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('id_user', $id);

    return $this->db->get()->row();
  }

  public function addUser($data)
  {
    return $this->db->insert('user', $data);
  }

  public function editUser($data, $where)
  {
    return $this->db->update('user', $data, $where);
  }

  public function deleteUser($id)
  {
    return $this->db->delete('user', ['id_user' => $id]);
  }
}
