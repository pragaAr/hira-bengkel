<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_MODEL
{
  public function cekUserName($uname)
  {
    $this->db->select('username')
      ->from('user')
      ->where('username', $uname);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getData()
  {
    $this->datatables->select('id_user, nama_user, no_telp_user, username, user_role')
      ->from('user')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="javascript:void(0);" class="btn btn-sm btn-warning text-white border border-light btn-edit-user" data-id="$1" title="Edit">
            <i class="fas fa-pencil-alt fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white border border-light btn-delete-user" data-id="$1" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
        'id_user, nama_user, no_telp_user, username, user_role'
      );

    return $this->datatables->generate();
  }

  public function getId($id)
  {
    $this->db->select('*')
      ->from('user')
      ->where('id_user', $id);

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
